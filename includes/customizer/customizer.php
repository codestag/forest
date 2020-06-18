<?php
/**
 * Forest Theme Customizer
 *
 * @package Forest
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function forest_customize_register( $wp_customize ) {
	// Tagline transport.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'forest_customize_register', 30 );

/**
 * Add Customizer scripts.
 *
 * @return void
 */
function forest_customize_controls_enqueue_scripts() {
	// Styles.
	wp_enqueue_style(
		'chosen',
		get_template_directory_uri() . '/assets/lib/chosen/chosen.min.css',
		array(),
		'1.8.3'
	);

	// Scripts.
	wp_enqueue_script(
		'chosen',
		get_template_directory_uri() . '/assets/lib/chosen/chosen.jquery.min.js',
		array( 'jquery', 'customize-controls' ),
		'1.8.3',
		true
	);

	wp_enqueue_script(
		'customizer-sections',
		get_template_directory_uri() . '/assets/js/customizer-sections.js',
		array( 'customize-controls', 'chosen', 'jquery', 'jquery-ui-sortable' ),
		STAG_THEME_VERSION,
		true
	);

	$localize = array(
		'fontOptions'               => forest_get_font_property_option_keys(),
		'chosen_no_results_default' => esc_html__( 'No results match', 'forest' ),
		'chosen_no_results_fonts'   => esc_html__( 'No matching fonts', 'forest' ),
	);

	// Localize the script.
	wp_localize_script(
		'customizer-sections',
		'forestCustomizerSettings',
		$localize
	);
}

add_action( 'customize_controls_enqueue_scripts', 'forest_customize_controls_enqueue_scripts' );

/**
 * Add sections and controls to the customizer.
 *
 * @since  1.0.0.
 *
 * @param WP_Customize_Manager $wp_customize    The Customizer instance.
 * @return void
 */
function forest_customize_add_sections( $wp_customize ) {
	// Compile the section definitions.
	$sections = forest_customize_get_definitions( $wp_customize );

	// Initial priority.
	$priority = new FOREST_Prioritizer( 1000 );

	// Register each section and add its options.
	foreach ( $sections as $section => $data ) {
		// Store the options.
		if ( isset( $data['options'] ) ) {
			$options = $data['options'];
			unset( $data['options'] );
		}

		// Determine the priority.
		if ( ! isset( $data['priority'] ) ) {
			$data['priority'] = $priority->add();
		}

		// Register section, if it doesn't already exist.
		if ( ! $wp_customize->get_section( $section ) ) {
			$wp_customize->add_section( $section, $data );
		}

		// Add options to the section.
		if ( isset( $options ) ) {
			forest_customize_add_section_options( $section, $options );
			unset( $options );
		}
	}
}

add_action( 'customize_register', 'forest_customize_add_sections' );

/**
 * Register settings and controls for a section.
 *
 * @since  1.0.0.
 *
 * @param string $section             Section ID.
 * @param  array  $args                Array of setting and control definitions.
 * @param  int    $initial_priority    The initial priority to use for controls.
 * @return int                            The last priority value assigned
 */
function forest_customize_add_section_options( $section, $args, $initial_priority = 10 ) {
	global $wp_customize;

	$settings = new FOREST_Settings();
	$priority = new FOREST_Prioritizer( $initial_priority, 10 );

	foreach ( $args as $setting_id => $option ) {
		// Add setting.
		if ( isset( $option['setting'] ) ) {
			$defaults = array(
				'default'              => $settings->get_default( $setting_id ),
				'type'                 => 'theme_mod',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'transport'            => 'refresh',
				'sanitize_callback'    => $settings->get_sanitize_callback( $setting_id ),
				'sanitize_js_callback' => '',
				'validate_callback'    => '',
			);
			$setting  = wp_parse_args( $option['setting'], $defaults );

			// Add the setting arguments inline so Theme Check can verify the presence of sanitize_callback.
			$wp_customize->add_setting(
				$setting_id, array(
					'default'              => $setting['default'],
					'type'                 => $setting['type'],
					'capability'           => $setting['capability'],
					'theme_supports'       => $setting['theme_supports'],
					'transport'            => $setting['transport'],
					'sanitize_callback'    => $setting['sanitize_callback'],
					'sanitize_js_callback' => $setting['sanitize_js_callback'],
					'validate_callback'    => $setting['validate_callback'],
				)
			);
		}

		// Add control.
		if ( isset( $option['control'] ) ) {
			$control_id = $setting_id;

			$defaults = array(
				'settings' => $setting_id,
				'section'  => $section,
				'priority' => $priority->add(),
			);

			if ( ! isset( $option['setting'] ) ) {
				unset( $defaults['settings'] );
			}

			$control = wp_parse_args( $option['control'], $defaults );

			// Check for a specialized control class.
			if ( isset( $control['control_class'] ) ) {
				$class = $control['control_class'];

				/**
				 * Filter the path for loading a Customizer control file.
				 *
				 * @since 1.0.0.
				 *
				 * @param string    $control_path    The path to the control file.
				 * @param string    $control_id      The ID of the current control.
				 * @param array     $control         The array of parameters for the current control.
				 */
				$control_path = apply_filters( 'forest_customizer_control_path', get_template_directory() . '/includes/customizer/controls', $control_id, $control );

				$control_file = trailingslashit( $control_path ) . $class . '.php';
				if ( file_exists( $control_file ) ) {
					require_once $control_file;
				}

				if ( class_exists( $class ) ) {
					unset( $control['control_type'] );

					// Dynamically generate a new class instance in a way that's compatible with PHP 5.2.
					$reflection     = new ReflectionClass( $class );
					$class_instance = $reflection->newInstanceArgs( array( $wp_customize, $control_id, $control ) );

					$wp_customize->add_control( $class_instance );
				}
			} else {
				$wp_customize->add_control( $control_id, $control );
			}
		} // End if().
	} // End foreach().

	return $priority->get();
}
/**
 * To output the tracking code
 * clone as in includes/options/general-settings.php
 */
function stag_forest_tracking_code() {
	$stag_values = get_theme_mods();
	if ( array_key_exists( 'forest_tracking_code', $stag_values ) && $stag_values['forest_tracking_code'] != '' ) {
		echo stripslashes( $stag_values['forest_tracking_code'] );
	}
}
add_action( 'wp_footer', 'stag_forest_tracking_code' );
