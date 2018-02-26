<?php
/**
 * Customizer settings definitions.
 *
 * @package Slope
 */

/**
 * Get the array of definitions for Customizer settings and controls.
 *
 * @since 1.0.0.
 *
 * @param  object $wp_customize    The Customizer instance.
 *
 * @return mixed|void
 */
function forest_customize_get_definitions( $wp_customize ) {

	$wp_customize->add_panel(
		'forest_options_panel', array(
			'title'       => esc_html__( 'Theme Options', 'stag' ),
			'description' => esc_html__( 'Configure your theme settings', 'stag' ),
			'priority'    => 999,
		)
	);

	$definitions = array(
		'colors'           => array(
			'title'       => esc_html__( 'Styling Options', 'stag' ),
			'description' => 'Configure your theme style & accents',
			'priority'    => '',
			'options'     => array(
				'style_background_color' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Background Color', 'stag' ),
					),
				),
				'accent-color'           => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Accent Color', 'stag' ),
					),
				),
			),
		),

		'forest_fonts'     => array(
			'title'       => esc_html__( 'Fonts', 'stag' ),
			'panel'       => 'forest_options_panel',
			'description' => sprintf(
				/* translators: Link to Google Fonts website */
				esc_html__( 'The list of Google fonts is long! You can %s before making your choices.', 'stag' ),
				sprintf(
					'<a href="%1$s" class="external-link" target="_blank">%2$s</a>',
					esc_url( 'https://fonts.google.com' ),
					esc_html__( 'preview', 'stag' )
				)
			),
			'options'     => array(
				'font-body'          => array(
					'setting' => array(),
					'control' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Body', 'stag' ),
					),
				),
				'font-headers'       => array(
					'setting' => array(),
					'control' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Headers', 'stag' ),
					),
				),
				'google-font-subset' => array(
					'setting' => array(),
					'control' => array(
						'type'        => 'select',
						'choices'     => array(
							'arabic'       => __( 'Arabic', 'stag' ),
							'bengali'      => __( 'Bengali', 'stag' ),
							'cyrillic'     => __( 'Cyrillic', 'stag' ),
							'cyrillic-ext' => __( 'Cyrillic Extended', 'stag' ),
							'devanagari'   => __( 'Devanagari', 'stag' ),
							'greek'        => __( 'Greek', 'stag' ),
							'greek-ext'    => __( 'Greek Extended', 'stag' ),
							'gujarati'     => __( 'Gujarati', 'stag' ),
							'gurmukhi'     => __( 'Gurmukhi', 'stag' ),
							'hebrew'       => __( 'Hebrew', 'stag' ),
							'kannada'      => __( 'Kannada', 'stag' ),
							'khmer'        => __( 'Khmer', 'stag' ),
							'latin'        => __( 'Latin', 'stag' ),
							'latin-ext'    => __( 'Latin Extended', 'stag' ),
							'malayalam'    => __( 'Malayalam', 'stag' ),
							'myanmar'      => __( 'Myanmar', 'stag' ),
							'oriya'        => __( 'Oriya', 'stag' ),
							'sinhala'      => __( 'Sinhala', 'stag' ),
							'tamil'        => __( 'Tamil', 'stag' ),
							'telugu'       => __( 'Telugu', 'stag' ),
							'thai'         => __( 'Thai', 'stag' ),
							'vietnamese'   => __( 'Vietnamese', 'stag' ),
						),
						'label'       => esc_html__( 'Google Font Subset', 'stag' ),
						'description' => sprintf(
							/* translators: Link to Google fonts website */
							esc_html__( 'Not all fonts provide each of these subsets. Please visit the %s to see which subsets are available for each font.', 'stag' ),
							sprintf(
								'<a href="%1$s" target="_blank">%2$s</a>',
								esc_url( 'https://fonts.google.com' ),
								esc_html__( 'Google Fonts website', 'stag' )
							)
						),
					),
				),
			),
		),
		'blog_settings'    => array(
			'title'   => esc_html__( 'Blog Settings', 'stag' ),
			'panel'   => 'forest_options_panel',
			'options' => array(
				'forest_blog_cover_image'     => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'         => esc_html__( 'Blog Cover', 'stag' ),
						'description'   => esc_html__( 'Choose a cover image for blog.', 'stag' ),
						'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
					),
				),
				'forest_post_excerpt_length'  => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Post Excerpt Length', 'stag' ),
						'description' => esc_html__( 'Enter the length of post excerpt for blog page.', 'stag' ),
						'type'        => 'number',
					),
				),
				'forest_post_excerpt_text'    => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Post Excerpt Text', 'stag' ),
						'description' => esc_html__( 'Enter the text for post excerpt read more on blog page.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_disable_seo_settings' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Disable SEO Settings', 'stag' ),
						'description' => esc_html__( 'Enable/Disable SEO Settings on single posts and pages.', 'stag' ),
						'type'        => 'checkbox',
					),
				),
			),
		),
		'general_settings' => array(
			'title'   => esc_html__( 'General Settings', 'stag' ),
			'panel'   => 'forest_options_panel',
			'options' => array(
				'forest_text_logo'     => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Plain Text Logo', 'stag' ),
						'description' => esc_html( 'Check this box to enable a plain text logo rather than an image logo. Will use your site title.', 'stag' ),
					),
				),
				'forest_custom_logo'   => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'         => esc_html__( 'Custom Logo Upload', 'stag' ),
						'description'   => esc_html__( 'Upload a logo for your theme.', 'stag' ),
						'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
					),
				),
				'forest_contact_email' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Contact Form Email Address', 'stag' ),
						'description' => esc_html__( 'Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_tracking_code' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Tracking Code', 'stag' ),
						'description' => esc_html__( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'stag' ),
						'type'        => 'textarea',
					),
				),
				'forest_site_footer'   => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Footer Credit Text', 'stag' ),
						'description' => esc_html__( 'Enter the site footer text.', 'stag' ),
						'type'        => 'textarea',
					),
				),
			),
		),

		/* TODO: REUSABLE TEMPLATES */
		// 'wedding_settings' => array(
		// 'title'       => esc_html__( 'Wedding Settings', 'stag' ),
		// 'panel'       => 'forest_options_panel',
		// 'description' => esc_html__( 'Customize your homepage preferences.', 'stag' ),
		// 'options'     => array(
		// 'forest_wedding_date'                  => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => esc_html__( 'Wedding Date', 'stag' ),
		// 'description' => esc_html__( 'Select the wedding date in dd-mm-yyyy format.', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_time'                  => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => esc_html__( 'Wedding Time', 'stag' ),
		// 'description' => esc_html__( 'Select the wedding time in H:i:s format. For example: 20:12:55; hours, minutes, and seconds respectively.', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_bridegroom_first_name' => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bridegroom First Name', 'stag' ),
		// 'description' => __( 'Enter the first name of the Bridegroom', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_bridegroom_last_name'  => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bridegroom Last Name', 'stag' ),
		// 'description' => __( 'Enter the last name of the Bridegroom', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_bridegroom_avatar'     => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
		// 'label'         => __( 'Bridegroom Avatar', 'stag' ),
		// 'description'   => __( 'Upload the avatar of Bridegroom. Ideal size 115px x 115px or 230px x 230px for retina displays', 'stag' ),
		// ),
		// ),
		// 'forest_wedding_bridegroom_bio'        => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bridegroom Short Bio', 'stag' ),
		// 'description' => __( 'Bio text for bridegroom', 'stag' ),
		// 'type'        => 'textarea',
		// ),
		// ),
		// 'forest_wedding_bride_first_name'      => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bride First Name', 'stag' ),
		// 'description' => __( 'Enter the first name of the Bride', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_bride_last_name'       => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bride Last Name', 'stag' ),
		// 'description' => __( 'Enter the last name of the Bride', 'stag' ),
		// 'type'        => 'text',
		// ),
		// ),
		// 'forest_wedding_bride_avatar'          => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
		// 'label'         => __( 'Bride Avatar', 'stag' ),
		// 'description'   => __( 'Upload the avatar of Bride. Ideal size 115px x 115px or 230px x 230px for retina displays', 'stag' ),
		// ),
		// 'forest_wedding_bride_bio'             => array(
		// ),
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Bride Short Bio', 'stag' ),
		// 'description' => __( 'Bio text for Bride', 'stag' ),
		// 'type'        => 'textarea',
		// ),
		// ),
		// 'forest_wedding_slideshow'             => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
		// 'label'         => __( 'Slideshow Images', 'stag' ),
		// 'description'   => __( 'Upload slideshow images for the Intro Section slideshow', 'stag' ),
		// ),
		// ),
		// 'forest_wedding_slideshow_duration'    => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Slideshow Duration', 'stag' ),
		// 'description' => __( 'Enter the duration between slideshows. 1000 is equal to 1 second.', 'stag' ),
		// 'type'        => 'number',
		// ),
		// ),
		// 'forest_wedding_fade_duration'         => array(
		// 'setting' => array(
		// 'transport' => 'refresh',
		// ),
		// 'control' => array(
		// 'label'       => __( 'Fade Duration', 'stag' ),
		// 'description' => __( 'Enter the duration between slideshows fade animation. 1000 is equal to 1 second.', 'stag' ),
		// 'type'        => 'number',
		// ),
		// ),
		// ),
		// ),
	);

	/**
	 * Filter the control definitions for the Customizer.
	 *
	 * '[section_id]' => array(
	 *     'title' => esc_html__( '[Section Title]', 'stag' ),
	 *     'description' => esc_html__( '[Section description]', 'stag' ),
	 *     'options' => array(
	 *         '[setting-id]' => array(
	 *             'setting' => array(
	 *                 [setting-parameter] => [value]
	 *             ),
	 *            'control' => array(
	 *                 [control-parameter] => [value]
	 *             ),
	 *         ),
	 *    ),
	 * ),
	 *
	 * @since 1.0.0.
	 *
	 * @param array    $definitions    The array containing all of the Customizer definitions.
	 */
	$definitions = apply_filters( 'forest_customizer_definitions', $definitions );

	return $definitions;
}
