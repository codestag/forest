<?php
/**
 * Wrapper class for theme settings.
 *
 * @package Forest
 */

/**
 * Class Forest_Settings
 *
 * An object for defining and managing theme settings, both within and outside of the Customizer.
 *
 * @since 1.0.0.
 */
class FOREST_Settings {
	/**
	 * The array of settings and their properties.
	 *
	 * @since 1.0.0.
	 *
	 * @var array
	 */
	private $settings = array();

	/**
	 * The value returned for an undefined setting.
	 *
	 * @since 1.0.0.
	 *
	 * @var null
	 */
	private $undefined = null;

	/**
	 * Initialize the object.
	 */
	public function __construct() {
		$this->settings = $this->settings_definitions();
	}

	/**
	 * Return the array of default setting definitions.
	 *
	 * @since 1.0.0.
	 *
	 * @return array
	 */
	private function settings_definitions() {
		/**
		 * Filter to modify settings definitions.
		 *
		 * Each setting is represented by an item in the associative array.
		 * The item's array key is the setting ID. The item value is another
		 * array that contains setting parameters.
		 *
		 * 'default' is the default value of the setting when it has not been modified.
		 * 'sanitize' is the name of the callback function for sanitizing the setting value.
		 *
		 * @since 1.0.0.
		 *
		 * @param array    $settings    The array of settings definitions.
		 */
		$settings = apply_filters(
			'forest_settings_definitions', array(
				// General Settings.
				'forest_text_logo'                   => array(
					'default'  => false,
					'sanitize' => 'wp_validate_boolean',
				),
				'forest_custom_logo'                 => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_contact_email'               => array(
					'default'  => '',
					'sanitize' => 'sanitize_email',
				),
				'forest_tracking_code'               => array(
					'default'  => '',
					'sanitize' => 'forest_sanitize_text',
				),
				'forest_blog_title'                  => array(
					'default'  => 'Blog Entries',
					'sanitize' => 'forest_sanitize_text',
				),
				'forest_blog_cover_image'            => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_post_excerpt_length'         => array(
					'default'  => '55',
					'sanitize' => 'absint',
				),
				'forest_post_excerpt_text'           => array(
					'default'  => 'Read More..',
					'sanitize' => 'esc_html',
				),
				'forest_disable_seo_settings'        => array(
					'default'  => false,
					'sanitize' => 'wp_validate_boolean',
				),
				'forest_site_footer'                 => array(
					'default'  => '',
					'sanitize' => 'forest_sanitize_text',
				),
				'forest_blog_background_opacity'     => array(
					'default'  => '70',
					'sanitize' => 'absint',
				),
				'forest_theme_credit'                => array(
					'default'  => false,
					'sanitize' => 'wp_validate_boolean',
				),

				// Styling Settings.
				'style_background_color'             => array(
					'default'  => '#ffffff',
					'sanitize' => 'maybe_hash_hex_color',
				),
				'style_accent_color'                 => array(
					'default'  => '#1bbc9b',
					'sanitize' => 'maybe_hash_hex_color',
				),
				'style_portfolio_background'         => array(
					'default'  => '#41415e',
					'sanitize' => 'maybe_hash_hex_color',
				),
				'style_footer_color'                 => array(
					'default'  => '#444444',
					'sanitize' => 'maybe_hash_hex_color',
				),
				'style_blog_background_color'        => array(
					'default'  => '#41415e',
					'sanitize' => 'maybe_hash_hex_color',
				),

				// Font Settings.
				'font-body'                          => array(
					'default'  => 'Roboto',
					'sanitize' => 'esc_html',
				),
				'font-headers'                       => array(
					'default'  => 'Roboto',
					'sanitize' => 'esc_html',
				),
				'google-font-subset'                 => array(
					'default'  => '14',
					'sanitize' => 'esc_html',
				),

				// Portfolio Settings
				'forest_portfolio_cta_text'          => array(
					'default'  => '',
					'sanitize' => 'esc_html',
				),
				'forest_portfolio_cta_button_text'   => array(
					'default'  => '',
					'sanitize' => 'esc_html',
				),
				'forest_portfolio_cta_button_link'   => array(
					'default'  => '',
					'sanitize' => 'esc_html',
				),
				'forest_portfolio_cta_button_window' => array(
					'default'  => false,
					'sanitize' => 'wp_validate_boolean',
				),
				'forest_portfolio_page'              => array(
					'default'  => '',
					'sanitize' => 'esc_html',
				),

				// Social Settings.
				'forest_footer_social_links'         => array(
					'default'  => '',
					'sanitize' => 'wp_kses_post',
				),
				'forest_social_facebook'             => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_twitter'              => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_dribbble'             => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_google_plus'          => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_pinterest'            => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_vimeo'                => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_linkedin'             => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_behance'              => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_devianart'            => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_flickr'               => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_instagram'            => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_myspace'              => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_soundcloud'           => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
				'forest_social_youtube'              => array(
					'default'  => '',
					'sanitize' => 'esc_url_raw',
				),
			)
		);

		return $settings;
	}

	/**
	 * Get the current value of a setting. Sanitize it first.
	 *
	 * This will return the default value for the settting if nothing is stored yet.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 *
	 * @return mixed|null
	 */
	public function get_value( $setting_id ) {
		$sanitized_value = $this->undefined;

		if ( isset( $this->settings[ $setting_id ] ) ) {
			$value           = get_theme_mod( $setting_id, $this->get_default( $setting_id ) );
			$sanitized_value = $this->sanitize_value( $value, $setting_id );
		}

		/**
		 * Filter the current value for a particular setting.
		 *
		 * @since 1.0.0.
		 *
		 * @param string|array    $value         The current value of the setting.
		 * @param string          $setting_id    The id of the setting.
		 */
		return apply_filters( 'forest_settings_current_value', $sanitized_value, $setting_id );
	}

	/**
	 * Get the stored value of a setting, unaltered.
	 *
	 * This will return the class's 'undefined' value if the setting doesn't exist.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 *
	 * @return mixed|null
	 */
	public function get_raw_value( $setting_id ) {
		$value = $this->undefined;

		if ( isset( $this->settings[ $setting_id ] ) ) {
			$value = get_theme_mod( $setting_id, $this->undefined );
		}

		return $value;
	}

	/**
	 * Get the default value of a setting.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 *
	 * @return mixed|null
	 */
	public function get_default( $setting_id ) {
		$default_value = $this->undefined;

		if ( isset( $this->settings[ $setting_id ] ) ) {
			$setting = $this->settings[ $setting_id ];
			if ( isset( $setting['default'] ) ) {
				$default_value = $setting['default'];
			}
		}

		/**
		 * Filter the default value for a particular setting.
		 *
		 * @since 1.0.0.
		 *
		 * @param string|array    $default_value    The default value of the setting.
		 * @param string          $setting_id       The id of the setting.
		 */
		return apply_filters( 'forest_settings_default_value', $default_value, $setting_id );
	}

	/**
	 * Determine if a setting is currently set to its default value.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 *
	 * @return bool
	 */
	public function is_default( $setting_id ) {
		$current_value = $this->get_value( $setting_id );
		$default_value = $this->get_default( $setting_id );

		return $current_value === $default_value;
	}

	/**
	 * Get the name of the callback function used to sanitize a particular setting.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 *
	 * @return string|null
	 */
	public function get_sanitize_callback( $setting_id ) {
		$callback = $this->undefined;

		if ( isset( $this->settings[ $setting_id ] ) ) {
			$setting = $this->settings[ $setting_id ];
			if ( isset( $setting['sanitize'] ) ) {
				$callback = $setting['sanitize'];
			}
		}

		/**
		 * Filter the name of the sanitize callback function for a particular setting.
		 *
		 * @since 1.0.0.
		 *
		 * @param string|array    $callback      The name of the callback function.
		 * @param string          $setting_id    The id of the setting.
		 */
		return apply_filters( 'forest_settings_sanitize_callback', $callback, $setting_id );
	}

	/**
	 * Sanitize the value for a setting using the setting's specified callback function.
	 *
	 * @since 1.0.0.
	 *
	 * @param mixed  $value         The value to sanitize.
	 * @param string $setting_id    The ID of the setting to retrieve.
	 *
	 * @return mixed|null
	 */
	public function sanitize_value( &$value, $setting_id ) {
		$sanitized_value = $this->undefined;

		if ( isset( $this->settings[ $setting_id ] ) ) {
			$callback = $this->get_sanitize_callback( $setting_id );
			if (
				( is_string( $callback ) && function_exists( $callback ) && is_callable( $callback ) )
				||
				( is_array( $callback ) && method_exists( $callback[0], $callback[1] ) && is_callable( $callback ) )
			) {
				$sanitized_value = call_user_func_array( $callback, (array) $value );
			}
		}

		return $sanitized_value;
	}

	/**
	 * Set a new value for a particular setting.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $setting_id The ID of the setting to retrieve.
	 * @param mixed  $value      The value to assign to the setting.
	 *
	 * @return void
	 */
	public function set_value( $setting_id, $value ) {
		if ( isset( $this->settings[ $setting_id ] ) ) {
			$sanitized_value = $this->sanitize_value( $value, $setting_id );
			set_theme_mod( $setting_id, $sanitized_value );
		}
	}
}


if ( ! function_exists( 'sanitize_hex_color' ) ) :
	/**
	 * Copied from WordPress 4.1.1
	 *
	 * Sanitizes a hex color.
	 *
	 * Returns either '', a 3 or 6 digit hex color (with #), or null.
	 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
	 *
	 * @since 1.0.0.
	 *
	 * @param string $color Hex color code.
	 * @return string|null
	 */
	function sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return null;
	}
endif;

if ( ! function_exists( 'sanitize_hex_color_no_hash' ) ) :
	/**
	 * Copied from WordPress 4.1.1
	 *
	 * Sanitizes a hex color without a hash. Use sanitize_hex_color() when possible.
	 *
	 * Saving hex colors without a hash puts the burden of adding the hash on the
	 * UI, which makes it difficult to use or upforest to other color types such as
	 * rgba, hsl, rgb, and html color names.
	 *
	 * Returns either '', a 3 or 6 digit hex color (without a #), or null.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $color Hex color code.
	 * @return string|null
	 */
	function sanitize_hex_color_no_hash( $color ) {
		$color = ltrim( $color, '#' );

		if ( '' === $color ) {
			return '';
		}

		return sanitize_hex_color( '#' . $color ) ? $color : null;
	}
endif;

if ( ! function_exists( 'maybe_hash_hex_color' ) ) :
	/**
	 * Copied from WordPress 4.1.1
	 *
	 * Ensures that any hex color is properly hashed.
	 * Otherwise, returns value untouched.
	 *
	 * This method should only be necessary if using sanitize_hex_color_no_hash().
	 *
	 * @since 1.0.0.
	 *
	 * @param string $color Hex color code.
	 * @return string
	 */
	function maybe_hash_hex_color( $color ) {
		$unhashed = sanitize_hex_color_no_hash( $color );
		if ( $unhashed ) {
			return '#' . $unhashed;
		}

		return $color;
	}
endif;

/**
 * Sanitize a string of text, using a set of allowed HTML tags.
 *
 * @since 1.0.0.
 *
 * @param  string $string The text string to sanitize.
 * @return string
 */
function forest_sanitize_text( $string ) {
	$expandedtags = forest_allowed_html();
	return wp_kses( $string, $expandedtags );
}

/**
 * Return the WordPress array of allowed tags, with a few things added.
 *
 * @since 1.0.0.
 *
 * @return mixed|void
 */
function forest_allowed_html() {
	$expandedtags = wp_kses_allowed_html();

	// Span.
	$expandedtags['span'] = array();

	// H1 - H6.
	$expandedtags['h1'] = array();
	$expandedtags['h2'] = array();
	$expandedtags['h3'] = array();
	$expandedtags['h4'] = array();
	$expandedtags['h5'] = array();
	$expandedtags['h6'] = array();
	// Enable id, class, and style attributes for each tag.
	foreach ( $expandedtags as $tag => $attributes ) {
		$expandedtags[ $tag ]['id']    = true;
		$expandedtags[ $tag ]['class'] = true;
		$expandedtags[ $tag ]['style'] = true;
	}

	// br (doesn't need attributes).
	$expandedtags['br'] = array();

	// img.
	$expandedtags['img'] = array(
		'src'    => true,
		'height' => true,
		'width'  => true,
		'alt'    => true,
		'title'  => true,
	);

	// script tag
	$expandedtags['script'] = array();

	/**
	 * Customize the tags and attributes that are allows during text sanitization.
	 *
	 * @since 1.0.0.
	 *
	 * @param array     $expandedtags    The list of allowed tags and attributes.
	 * @param string    $string          The text string being sanitized.
	 */
	return apply_filters( 'forest_allowed_html', $expandedtags );
}

global $forest_settings;

$forest_settings = new FOREST_Settings();
