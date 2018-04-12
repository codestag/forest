<?php
/**
 * Get a sanitized value for a Theme Mod setting.
 *
 * @param var $setting_id Setting ID.
 *
 * @return mixed
 */
function forest_get_thememod_value( $setting_id ) {
	global $forest_settings;

	return $forest_settings->get_value( $setting_id );
}

/**
 * Migrated from Previous Theme Settings
 * StagFramework
 */

function stag_google_font_url() {

	$body_font    = forest_get_thememod_value( 'font-body' );
	$heading_font = forest_get_thememod_value( 'font-headers' );

	if ( '' === $body_font && '' === $heading_font ) {
		return;
	}

	$fonts_url     = '';
	$font_families = array();

	$font_families[] = $body_font;
	$font_families[] = $heading_font;

	$query_args = array(
		'family' => urlencode( implode( '|', array_filter( $font_families ) ) ),
		'subset' => urlencode( forest_get_thememod_value( 'google-font-subset' ) ),
	);
	$fonts_url  = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return esc_url( $fonts_url );
}

if ( ! function_exists( 'stag_remove_trailing_char' ) ) {
	/**
	 * Check if there is any space
	 */
	function stag_remove_trailing_char( $string, $char = ' ' ) {
		$offset        = strlen( $string ) - 1;
		$trailing_char = strpos( $string, $char, $offset );
		if ( $trailing_char ) {
			$string = substr( $string, 0, -1 );
		}
		return $string;
	}
}

function stag_get_font_face( $option ) {
	$stack = null;
	if ( $option != '' ) {
		$option = explode( ':', $option );
		$name   = stag_remove_trailing_char( $option[0] );
		$stack  = $name;
	} else {
		$stack = '';
	}
	return $stack;
}

function stag_user_styles_push( $content ) {
	$bodyfont         = forest_get_thememod_value( 'font-body' );
	$body_font_output = stag_get_font_face( $bodyfont );

	$headingfont         = forest_get_thememod_value( 'font-headers' );
	$heading_font_output = stag_get_font_face( $headingfont );

	$background_color = forest_get_thememod_value( 'style_background_color' );

	$accent               = forest_get_thememod_value( 'style_accent_color' );
	$portfolio_background = forest_get_thememod_value( 'style_portfolio_background' );
	$footer_color         = forest_get_thememod_value( 'style_footer_color' );

	$output = "/* Custom Styles Output */\n";

	if ( $background_color != '' ) {
		$output .= "body{ background-color: $background_color; }\n";
	}

	if ( $bodyfont != '' ) {
		$output .= "body{ font-family: '$body_font_output'; }\n";
	}

	if ( $headingfont != '' ) {
		$output .= "\nh1, h2, h3, h4, h5, h6, .heading, .intro-text { ";
		$output .= "font-family: '$heading_font_output'; ";
		$output .= "}\n";
	}

	if ( $accent != '' ) {
		$output .= 'a, .ui-tabs-nav .ui-state-active a, .accent-color{ ';
		$output .= "color: $accent; ";
		$output .= "}\n";
		$output .= "\nbutton, .button, input[type='submit'], .comment-reply-link, .stag-button--green, .page-numbers, .nav-links a, .stag-toggle .ui-state-active, .paging-navigation .nav-links a {";
		$output .= "background: $accent;";
		$output .= "}\n";
		$output .= ".ui-tabs-nav .ui-state-active { border-color: $accent; }";
		$output .= ".stag-toggle span.ui-icon:before { color: $accent; }";
		$output .= ".cycle-pager-active{ background: $accent !important; }\n\n";
	}

	if ( '#41415e' != $portfolio_background ) {
		$output .= ".portfolio-hero, .section-portfolio { background-color: $portfolio_background; }\n";
	}

	if ( '#444444' != $footer_color ) {
		$output .= ".secondary-footer { color: $footer_color; }\n";
	}

	$bg         = forest_get_thememod_value( 'forest_blog_cover_image' );
	$color      = forest_get_thememod_value( 'style_blog_background_color' );
	$opacity    = forest_get_thememod_value( 'forest_blog_background_opacity' );
	$opacityVal = intval( $opacity ) / 100;

	if ( $bg != '' ) {
		$output .= ".the-hero { background-image: url({$bg}); }\n";
	}
	if ( $color != '' ) {
		$output .= ".the-cover { background-color: {$color}; }\n";
	}
	if ( $opacity != '' && $bg != '' ) {
		$output .= ".the-cover { opacity: {$opacityVal}; -ms-filter: 'alpha(opacity=" . $opacity . ")'; }\n";
	}

	$content .= $output;
	return $content;
}
add_action( 'stag_custom_styles', 'stag_user_styles_push', 10 );
