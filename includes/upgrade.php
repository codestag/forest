<?php
/**
 * Handle theme upgrade process.
 *
 * @package Forest
 * @since 2.2.0
 */

if ( ! function_exists( 'forest_theme_upgrade' ) ) :
	/**
	 * Handle theme upgrade.
	 *
	 * @since 2.2.0.
	 * @return bool|void
	 */
	function forest_theme_upgrade() {
		// Grab old theme values.
		$framework_values = get_option( 'stag_framework_values' );

		// Bail early if old framework values are not found.
		if ( ! is_array( $framework_values ) ) return;

		$legacy_options = array_filter( $framework_values );
		$has_updated    = get_theme_mod( 'has_forest_migrated' );

		if ( ! $has_updated && $legacy_options && '' !== $legacy_options['settings_updated'] ) {
			$mapped_settings = forest_mapped_settings();

			foreach ( $legacy_options as $legacy_key => $legacy_value ) {
				if ( array_key_exists( $legacy_key, $mapped_settings ) ) {
					$filtered_value = forest_filter_legacy_value( $legacy_key, $legacy_value );

					set_theme_mod( $mapped_settings[ $legacy_key ], $filtered_value );
				}
			}

			// TODO: Remove custom framework values in future release.
			add_action( 'admin_notices', 'forest_upgrade_notice' );
			set_theme_mod( 'has_forest_migrated', true );
		}
	}
endif; // End of forest_theme_upgrade.

/**
 * Map old theme key settings to new.
 *
 * @since 2.2.0
 * @return array
 */
function forest_mapped_settings() {
	$settings = [
		// General Settings.
		'general_text_logo'            => 'forest_text_logo',
		'general_custom_logo'          => 'forest_custom_logo',
		'general_contact_email'        => 'forest_contact_email',
		'general_tracking_code'        => 'forest_tracking_code',
		'general_post_excerpt_length'  => 'forest_post_excerpt_length',
		'general_post_excerpt_text'    => 'forest_post_excerpt_text',
		'general_disable_seo_settings' => 'forest_disable_seo_settings',
		'general_site_footer'          => 'forest_site_footer',

		// Styling Options.
		'style_background_color'       => 'style_background_color',
		'style_accent_color'           => 'style_accent_color',
		'style_portfolio_background'   => 'style_portfolio_background',
		'style_footer_color'           => 'style_footer_color',
		'style_body_font'              => 'font-body',
		'style_heading_font'           => 'font-headers',
		'style_font_script'            => 'google-font-subset',

		// Blog Settings.
		'blog_background'              => 'forest_blog_cover_image',
		'blog_title'                   => 'forest_blog_title',
		'blog_background_color'        => 'style_blog_background_color',
		'blog_background_opacity'      => 'forest_blog_background_opacity',

		// Portfolio Settings.
		'portfolio_cta_text'           => 'forest_portfolio_cta_text',
		'portfolio_cta_button_text'    => 'forest_portfolio_cta_button_text',
		'portfolio_cta_button_link'    => 'forest_portfolio_cta_button_link',
		'portfolio_cta_button_window'  => 'forest_portfolio_cta_button_window',
		'portfolio_page'               => 'forest_portfolio_page',

		// Social Settings.
		'footer_social_links'          => 'forest_footer_social_links',
		'social_facebook'              => 'forest_social_facebook',
		'social_twitter'               => 'forest_social_twitter',
		'social_dribbble'              => 'forest_social_dribbble',
		'social_google-plus'           => 'forest_social_google_plus',
		'social_pinterest'             => 'forest_social_pinterest',
		'social_vimeo'                 => 'forest_social_vimeo',
		'social_linkedin'              => 'forest_social_linkedin',
		'social_behance'               => 'forest_social_behance',
		'social_deviantart'            => 'forest_social_devianart',
		'social_flickr'                => 'forest_social_flickr',
		'social_instagram'             => 'forest_social_instagram',
		'social_myspace'               => 'forest_social_myspace',
		'social_soundcloud'            => 'forest_social_soundcloud',
		'social_youtube'               => 'forest_social_youtube',
	];

	return $settings;
}

/**
 * Filter/sanitize legacy values before saving into customizer.
 *
 * @param string $key The settings ID.
 * @param string $value The setting value to sanitize.
 * @return mixed
 */
function forest_filter_legacy_value( $key, $value ) {
	$filtered_value = '';
	$old_settings   = get_option( 'stag_framework_values' );
	$original_value = $old_settings[ $key ];

	switch ( $key ) {
		case 'style_body_font':
		case 'style_heading_font':
			$font           = explode( ':', $value );
			$filtered_value = $font[0];
			break;

		case 'general_disable_seo_settings':
			$filtered_value = ( 'off' === $value ) ? false : true;
			break;

		case 'portfolio_cta_button_window':
			$filtered_value = ( 'off' === $value ) ? false : true;
			break;

		case 'style_font_script':
			$filtered_value = 14;
			break;

		case 'general_site_footer':
		case 'forest_footer_social_links':
			$filtered_value = stripslashes( $value );
			break;

		default:
			$filtered_value = $value;
			break;
	}

	return $filtered_value;
}

/**
 * Add admin notice info for new settings location.
 *
 * @return void
 */
function forest_upgrade_notice() {
	$class = 'notice notice-info is-dismissible';

	$message = sprintf(
		/* translators: %s: Link to customizer. */
		__( 'Looking for theme settings? It has been moved under Appearance &rarr; <a href="%s">Customize</a>.', 'forest' ),
		admin_url( 'customize.php' )
	);

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); // WPCS: XSS ok.
}
