<?php
add_action('admin_init', 'stag_styling_options');
function stag_styling_options(){

	$styling_options['description'] = __('Configure the visual appearance of your theme, or insert any custom CSS.', 'stag');

	$styling_options[] = array(
		'title' => __('Background Color', 'stag'),
		'desc'  => __('Choose the background color of your site', 'stag'),
		'type'  => 'color',
		'id'    => 'style_background_color',
		'val'   => '#ffffff'
	);

	$styling_options[] = array(
		'title' => __('Accent Color', 'stag'),
		'desc'  => __('Choose the accent color of your site', 'stag'),
		'type'  => 'color',
		'id'    => 'style_accent_color',
		'val'   => '#1bbc9b'
	);

	$styling_options[] = array(
		'title' => __('Portfolio Section Background Color', 'stag'),
		'desc'  => null,
		'type'  => 'color',
		'id'    => 'style_portfolio_background',
		'val'   => '#41415e'
	);

	$styling_options[] = array(
		'title' => __('Footer Text Color', 'stag'),
		'desc'  => null,
		'type'  => 'color',
		'id'    => 'style_footer_color',
		'val'   => '#444444'
	);

	$styling_options[] = array(
		'title' => __('Body Font', 'stag'),
		'desc'  => __('Quickly add a custom Google Font for body from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
				   <code>Example font name: "Source Sans Pro"</code>, for including font weights type <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
		'type'  => 'text',
		'id'    => 'style_body_font',
		'val'   => 'Roboto:400,700,400italic,700italic'
	);

	$styling_options[] = array(
		'title' => __('Heading Font', 'stag'),
		'desc'  => __('Quickly add a custom Google Font for Headings from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
				   For font type: <code>"Source Sans Pro"</code>, for including specific font weights <code>Source Sans Pro:400,700,400italic</code>.', 'stag'),
		'type'  => 'text',
		'id'    => 'style_heading_font',
		'val'   => 'Roboto:400,700,400italic,700italic'
	);

	$styling_options[] = array(
		'title' => __( 'Google Font Script', 'stag' ),
		'desc' => __( 'Choose the character sets you want for Google Web Font', 'stag' ),
		'type' => 'select',
		'id' => 'style_font_script',
		'val' => 'latin',
		'options' => array(
			'cyrillic' => __( 'Cyrillic', 'stag' ),
			'cyrillic-ext' => __( 'Cyrillic Extended', 'stag' ),
			'greek' => __( 'Greek', 'stag' ),
			'greek-ext' => __( 'Greek Extended', 'stag' ),
			'khmer' => __( 'Khmer', 'stag' ),
			'latin' => __( 'Latin', 'stag' ),
			'latin,latin-ext' => __( 'Latin Extended', 'stag' ),
			'vietnamese' => __( 'Vietnamese', 'stag' ),
		)
	);

	$styling_options[] = array(
		'title' => __('Custom CSS', 'stag'),
		'desc'  => __('Quickly add some CSS to your theme by adding it to this block.', 'stag'),
		'type'  => 'textarea',
		'id'  => 'style_custom_css',
	);

  	stag_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/* Custom Stylesheet Output -----------------------------------------------*/
function stag_custom_css($content){
	$stag_values = get_option( 'stag_framework_values' );
	if( array_key_exists( 'style_custom_css', $stag_values ) && $stag_values['style_custom_css'] != '' ){
		$content .= '/* Custom CSS */' . "\n";
		$content .= stripslashes($stag_values['style_custom_css']);
		$content .= "\n\n";
	}
	return $content;
}
add_filter( 'stag_custom_styles', 'stag_custom_css' );

function stag_google_font_url() {

	$body_font = stag_get_option('style_body_font');
	$heading_font = stag_get_option('style_heading_font');

	if( $body_font === '' && $heading_font === '' )
		return;

	$fonts_url = '';
	$font_families = array();

	$font_families[] = $body_font;
	$font_families[] = $heading_font;

	$query_args = array(
		'family' => urlencode( implode( '|', array_filter($font_families) ) ),
		'subset' => urlencode( stag_get_option('style_font_script') )
	);
	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return esc_url( $fonts_url );
}

if( ! function_exists( 'stag_remove_trailing_char' ) ) {
/**
 * Check if there is any space
 */
function stag_remove_trailing_char( $string, $char = ' ' ) {
	$offset = strlen( $string ) - 1;
	$trailing_char = strpos( $string, $char, $offset );
	if( $trailing_char )
		$string = substr( $string, 0, -1 );
	return $string;
}
}

function stag_get_font_face( $option ) {
	$stack = null;
	if( $option !=  '') {
		$option = explode( ':', $option );
		$name = stag_remove_trailing_char( $option[0] );
		$stack = $name;
	} else {
		$stack = '';
	}
	return $stack;
}

function stag_user_styles_push($content){
	$bodyfont = stag_get_option('style_body_font');
	$body_font_output = stag_get_font_face($bodyfont);

	$headingfont = stag_get_option('style_heading_font');
	$heading_font_output = stag_get_font_face($headingfont);

	$background_color = stag_get_option('style_background_color');

	$accent = stag_get_option('style_accent_color');
	$portfolio_background = stag_get_option('style_portfolio_background');
	$footer_color = stag_get_option('style_footer_color');

	$output = "/* Custom Styles Output */\n";

	if($background_color != ''){
		$output .= "body{ background-color: $background_color; }\n";
	}

	if($bodyfont != ''){
		$output .= "body{ font-family: '$body_font_output'; }\n";
	}

	if($headingfont != ''){
		$output .= "\nh1, h2, h3, h4, h5, h6, .heading, .intro-text { ";
		$output .= "font-family: '$heading_font_output'; ";
		$output .= "}\n";
	}

	if( $accent != '' ){
		$output .= "a, .ui-tabs-nav .ui-state-active a, .accent-color{ ";
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

	$bg = stag_get_option('blog_background');
	$color = stag_get_option('blog_background_color');
	$opacity = stag_get_option('blog_background_opacity');
	$opacityVal = intval($opacity)/100;

	if($bg != '') $output .= ".the-hero { background-image: url({$bg}); }\n";
	if($color != '') $output .= ".the-cover { background-color: {$color}; }\n";
	if($opacity != '' && $bg != '') $output .= ".the-cover { opacity: {$opacityVal}; -ms-filter: 'alpha(opacity=".$opacity.")'; }\n";

	$content .= $output;
	return $content;
}
add_action( 'stag_custom_styles', 'stag_user_styles_push', 10);
