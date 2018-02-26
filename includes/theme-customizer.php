<?php
/**
 * Register Customizer Settings
 * using $wp_customize object
 */

function stag_customize_register( $wp_customize ) {
	// This creates a theme panel named "Theme Options".
	$wp_customize->add_panel(
		'theme_options', array(
			'priority'       => 1000,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Theme Options', 'stag' ),
			'description'    => __( 'Customize your theme settings', 'stag' ),
		)
	);

	// This adds a "General Options" section in Theme options panel.
	$wp_customize->add_section(
		'general_options', array(
			'title'       => __( 'General Settings', 'stag' ),
			'description' => 'Configure general settings of your theme. Upload your preferred logo, favicon, and insert your analytics tracking code.',
			'priority'    => 30,
			'panel'       => 'theme_options',
		)
	);

	// This adds a "Styling Options" section in Theme options panel.
	$wp_customize->add_section(
		'accent_control', array(
			'title'       => __( 'Styling Options', 'stag' ),
			'description' => 'Configure your theme style & accents',
			'priority'    => 36,
			'panel'       => 'theme_options',
		)
	);

	// This adds a "Portfolio Settings" section in Theme options panel.
	$wp_customize->add_section(
		'portfolio_settings', array(
			'title'       => __( 'Portfolio Settings', 'stag' ),
			'description' => 'Customize your portfolio settings',
			'priority'    => 38,
			'panel'       => 'theme_options',
		)
	);

	$wp_customize->add_section(
		'social_settings', array(
			'title'       => __( 'Social Settings', 'stag' ),
			'description' => 'Customize your social profile URLs.<br>Quick tip: you can use shortcode <code>[social url="facebook,twitter,dribbble"]</code> to display social links anywhere between posts.',
			'priority'    => 38,
			'panel'       => 'theme_options',
		)
	);

	/**
	 * General Options Section
	 */
	// Add a setting for Plain Text Logo.
	$wp_customize->add_setting(
		'forest_text_logo',
		array(
			'default' => get_legacy_theme_option( 'general_text_logo' ),
			'type'    => 'theme_mod',
		)
	);
	$wp_customize->add_control(
		'general_text_logo', array(
			'settings'    => 'forest_text_logo',
			'section'     => 'general_options',
			'label'       => __( 'Plain Text Logo', 'stag' ),
			'description' => __( 'Check this box to enable a plain text logo rather than an image logo. Will use your site title.', 'stag' ),
			'type'        => 'checkbox',
		)
	);

	// Add Setting for Custom Logo.
	$wp_customize->add_setting(
		'forest_custom_logo', array(
			'default'           => get_legacy_theme_option( 'general_custom_logo' ),
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'general_custom_logo',
			array(
				'settings'    => 'forest_custom_logo',
				'section'     => 'general_options',
				'label'       => __( 'Custom Logo', 'stag' ),
				'description' => __( 'Upload a custom logo for the site', 'stag' ),
			)
		)
	);

	$wp_customize->add_setting(
		'forest_contact_email',
		array(
			// Add a setting for Contact form e-mail Address.
			'default'           => get_legacy_theme_option( 'general_contact_email' ),
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'general_contact_email', array(
			'settings'    => 'forest_contact_email',
			'section'     => 'general_options',
			'label'       => __( 'Contact Form Email Address', 'stag' ),
			'description' => __( 'Enter an email address for the contact form', 'stag' ),
			'type'        => 'text',
		)
	);

	// Add a setting for adding a Tracking Code.
	$wp_customize->add_setting(
		'forest_tracking_code',
		array(
			'default' => get_legacy_theme_option( 'general_tracking_code' ),
			'type'    => 'theme_mod',
		)
	);
	$wp_customize->add_control(
		'general_tracking_code', array(
			'settings'    => 'forest_tracking_code',
			'section'     => 'general_options',
			'label'       => __( 'Tracking Code', 'stag' ),
			'description' => __( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'stag' ),
			'type'        => 'textarea',
		)
	);

		// Add a setting for Footer Copyright Text.
		$wp_customize->add_setting(
			'forest_general_footer_text',
			array(
				'default'           => get_legacy_theme_option( 'general_footer_text' ),
				'type'              => 'theme_mod',
				'sanitize_callback' => 'esc_html',
			)
		);
		$wp_customize->add_control(
			'general_footer_text', array(
				'settings'    => 'forest_general_footer_text',
				'section'     => 'general_options',
				'label'       => __( 'Footer Copyright Text', 'stag' ),
				'description' => __( 'Enter the text to display in footer copyright area.', 'stag' ),
				'type'        => 'textarea',
			)
		);

	// Add a setting for Post Excerpt Length.
	$wp_customize->add_setting(
		'forest_post_excerpt_text',
		array(
			'default'           => get_legacy_theme_option( 'general_post_excerpt_text' ),
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'general_post_excerpt_text', array(
			'settings'    => 'forest_post_excerpt_text',
			'section'     => 'general_options',
			'label'       => __( 'Post Excerpt Text', 'stag' ),
			'description' => __( 'Enter the length of post excerpt for blog page.', 'stag' ),
			'type'        => 'text',
		)
	);

	// Add a setting for Post Excerpt Length.
	$wp_customize->add_setting(
		'forest_post_excerpt_length',
		array(
			'default'           => get_legacy_theme_option( 'general_post_excerpt_length' ),
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'general_post_excerpt_length', array(
			'settings'    => 'forest_post_excerpt_length',
			'section'     => 'general_options',
			'label'       => __( 'Post Excerpt Length', 'stag' ),
			'description' => __( 'Enter the length of post excerpt for blog page.', 'stag' ),
			'type'        => 'number',
		)
	);

	// Add a setting for Disable SEO Settings.
	$wp_customize->add_setting(
		'forest_disable_seo_settings',
		array(
			'default'           => get_legacy_theme_option( 'general_disable_seo_settings' ),
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'general_disable_seo_settings', array(
			'settings'    => 'forest_disable_seo_settings',
			'section'     => 'general_options',
			'label'       => __( 'Disable SEO Settings', 'stag' ),
			'description' => __( 'Enable/Disable SEO Settings on single posts and pages.', 'stag' ),
			'type'        => 'checkbox',
		)
	);

}
add_action( 'customize_register', 'stag_customize_register' );
