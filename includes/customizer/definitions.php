<?php
/**
 * Customizer settings definitions.
 *
 * @package Forest
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

	$google_fonts = forest_all_font_choices();

	$wp_customize->add_panel(
		'forest_options_panel', array(
			'title'       => esc_html__( 'Theme Options', 'stag' ),
			'description' => esc_html__( 'Configure your theme settings', 'stag' ),
			'priority'    => 999,
		)
	);

	$definitions = array(
		'colors'             => array(
			'description' => 'Configure your theme style & accents',
			'priority'    => '',
			'options'     => array(
				'style_background_color'      => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Background Color', 'stag' ),
					),
				),
				'style_accent_color'          => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Accent Color', 'stag' ),
					),
				),
				'style_portfolio_background'  => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Portfolio Section Background Color', 'stag' ),
					),
				),
				'style_footer_color'          => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Footer Text Color', 'stag' ),
					),
				),
				'style_blog_background_color' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label'         => esc_html__( 'Blog Header Background Color', 'stag' ),
					),
				),

			),
		),

		'forest_fonts'       => array(
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
						'type'    => 'select',
						'choices' => $google_fonts,
						'label'   => esc_html__( 'Body', 'stag' ),
					),
				),
				'font-headers'       => array(
					'setting' => array(),
					'control' => array(
						'type'    => 'select',
						'choices' => $google_fonts,
						'label'   => esc_html__( 'Headers', 'stag' ),
					),
				),
				'google-font-subset' => array(
					'setting' => array(),
					'control' => array(
						'type'        => 'select',
						'choices'     => forest_get_google_font_subsets(),
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
		'blog_settings'      => array(
			'title'   => esc_html__( 'Blog Settings', 'stag' ),
			'panel'   => 'forest_options_panel',
			'options' => array(
				'forest_blog_title'              => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Blog Title', 'stag' ),
						'description' => esc_html__( 'Enter the default title for the blog header section.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_blog_cover_image'        => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'         => esc_html__( 'Blog Cover', 'stag' ),
						'description'   => esc_html__( 'Choose a header cover image for blog.', 'stag' ),
						'control_class' => 'WP_CUSTOMIZE_IMAGE_CONTROL',
					),
				),
				'forest_blog_background_opacity' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Background Opacity', 'stag' ),
						'description' => esc_html__( 'Choose a default value for background image at the blog header section. For no opacity give a value of 100.', 'stag' ),
						'type'        => 'number',
					),
				),
				'forest_post_excerpt_length'     => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Post Excerpt Length', 'stag' ),
						'description' => esc_html__( 'Enter the length of post excerpt for blog page.', 'stag' ),
						'type'        => 'number',
					),
				),
				'forest_post_excerpt_text'       => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Post Excerpt Text', 'stag' ),
						'description' => esc_html__( 'Enter the text for post excerpt read more on blog page.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_disable_seo_settings'    => array(
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
		'general_settings'   => array(
			'title'   => esc_html__( 'General Settings', 'stag' ),
			'panel'   => 'forest_options_panel',
			'options' => array(
				'forest_text_logo'     => array(
					'setting' => array(
						'transport' => 'refresh',
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
						'label'       => esc_html__( 'Footer Text', 'stag' ),
						'description' => esc_html__( 'Enter the site footer text.', 'stag' ),
						'type'        => 'textarea',
					),
				),
				'forest_theme_credit'  => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Hide Theme Credit', 'stag' ),
						'type'  => 'checkbox',
					),
				),
			),
		),
		'portfolio_settings' => array(
			'title'       => esc_html__( 'Portfolio Settings', 'stag' ),
			'panel'       => 'forest_options_panel',
			'description' => esc_html__( 'Customize your portfolio settings.', 'stag' ),
			'options'     => array(
				'forest_portfolio_cta_text'          => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Portfolio CTA text', 'stag' ),
						'description' => esc_html__( 'Enter the call to action text for portfolio page.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_portfolio_cta_button_text'   => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Portfolio CTA Button text', 'stag' ),
						'description' => esc_html__( 'Enter the call to action button text for portfolio page.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_portfolio_cta_button_link'   => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Portfolio CTA Button Link', 'stag' ),
						'description' => __( 'Enter the call to action button link for portfolio page.', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_portfolio_cta_button_window' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Open link in new window?', 'stag' ),
						'description' => __( 'Check to open the call to action button link in new window.', 'stag' ),
						'type'        => 'checkbox',
					),
				),
				'forest_portfolio_page'              => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Portfolio Page', 'stag' ),
						'description' => __( 'Select portfolio page, used for link to portfolio page.', 'stag' ),
						'type'        => 'dropdown-pages',
					),
				),
			),
		),

		'social_settings'    => array(
			'title'       => esc_html__( 'Social Settings', 'stag' ),
			'panel'       => 'forest_options_panel',
			'description' => __( 'Customize your social profile URLs.<br/><br/><strong>Quick tip:</strong> you can use shortcode <code>[social url="facebook,twitter,dribbble"]</code> to display social links anywhere between posts.', 'stag' ),
			'options'     => array(
				'forest_footer_social_links' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Footer Social Links', 'stag' ),
						'description' => __( 'Display social link in footer with the <code>[social url=""]</code> shortcode.', 'stag' ),
						'type'        => 'textarea',
					),
				),
				'forest_social_facebook'     => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Facebook', 'stag' ),
						'description' => __( 'Enter your facebook profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_twitter'      => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Twitter', 'stag' ),
						'description' => __( 'Enter your twitter profile URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_dribbble'     => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Dribbble', 'stag' ),
						'description' => __( 'Enter your dribbble URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_google_plus'  => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Google+', 'stag' ),
						'description' => __( 'Enter your Google+ profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_pinterest'    => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Pinterest', 'stag' ),
						'description' => __( 'Enter your Pinterest profile URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_vimeo'        => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Vimeo', 'stag' ),
						'description' => __( 'Enter your Vimeo profile URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_linkedin'     => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'LinkedIn', 'stag' ),
						'description' => __( 'Enter your LinkedIn profile URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_behance'      => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Behance', 'stag' ),
						'description' => __( 'Enter your Behance profile URL', 'stag' ),
					),
					'type'    => 'text',
				),
				'forest_social_devianart'    => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'DeviantArt', 'stag' ),
						'description' => __( 'Enter your DevianArt profile URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_flickr'       => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Flickr', 'stag' ),
						'description' => __( 'Enter your Flickr profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_instagram'    => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Instagram', 'stag' ),
						'description' => __( 'Enter your Instagram profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_myspace'      => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Myspace', 'stag' ),
						'description' => __( 'Enter your Myspace profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_soundcloud'   => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'SoundCloud', 'stag' ),
						'description' => __( 'Enter your SoundCloud profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
				'forest_social_youtube'      => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => __( 'Youtube', 'stag' ),
						'description' => __( 'Enter your Youtube profile/page URL', 'stag' ),
						'type'        => 'text',
					),
				),
			),
		),
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
