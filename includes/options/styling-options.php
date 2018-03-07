<?php
add_action( 'admin_init', 'stag_styling_options' );
function stag_styling_options() {

	$styling_options['description'] = __( 'Configure the visual appearance of your theme, or insert any custom CSS.', 'stag' );

	$styling_options[] = array(
		'title' => __( 'Background Color', 'stag' ),
		'desc'  => __( 'Choose the background color of your site', 'stag' ),
		'type'  => 'color',
		'id'    => 'style_background_color',
		'val'   => '#ffffff',
	);

	$styling_options[] = array(
		'title' => __( 'Accent Color', 'stag' ),
		'desc'  => __( 'Choose the accent color of your site', 'stag' ),
		'type'  => 'color',
		'id'    => 'style_accent_color',
		'val'   => '#1bbc9b',
	);

	$styling_options[] = array(
		'title' => __( 'Portfolio Section Background Color', 'stag' ),
		'desc'  => null,
		'type'  => 'color',
		'id'    => 'style_portfolio_background',
		'val'   => '#41415e',
	);

	$styling_options[] = array(
		'title' => __( 'Footer Text Color', 'stag' ),
		'desc'  => null,
		'type'  => 'color',
		'id'    => 'style_footer_color',
		'val'   => '#444444',
	);

	$styling_options[] = array(
		'title' => __( 'Body Font', 'stag' ),
		'desc'  => __(
			'Quickly add a custom Google Font for body from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
				   <code>Example font name: "Source Sans Pro"</code>, for including font weights type <code>Source Sans Pro:400,700,400italic</code>.', 'stag'
		),
		'type'  => 'text',
		'id'    => 'style_body_font',
		'val'   => 'Roboto:400,700,400italic,700italic',
	);

	$styling_options[] = array(
		'title' => __( 'Heading Font', 'stag' ),
		'desc'  => __(
			'Quickly add a custom Google Font for Headings from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory.</a><br>
				   For font type: <code>"Source Sans Pro"</code>, for including specific font weights <code>Source Sans Pro:400,700,400italic</code>.', 'stag'
		),
		'type'  => 'text',
		'id'    => 'style_heading_font',
		'val'   => 'Roboto:400,700,400italic,700italic',
	);

	$styling_options[] = array(
		'title'   => __( 'Google Font Script', 'stag' ),
		'desc'    => __( 'Choose the character sets you want for Google Web Font', 'stag' ),
		'type'    => 'select',
		'id'      => 'style_font_script',
		'val'     => 'latin',
		'options' => array(
			'cyrillic'        => __( 'Cyrillic', 'stag' ),
			'cyrillic-ext'    => __( 'Cyrillic Extended', 'stag' ),
			'greek'           => __( 'Greek', 'stag' ),
			'greek-ext'       => __( 'Greek Extended', 'stag' ),
			'khmer'           => __( 'Khmer', 'stag' ),
			'latin'           => __( 'Latin', 'stag' ),
			'latin,latin-ext' => __( 'Latin Extended', 'stag' ),
			'vietnamese'      => __( 'Vietnamese', 'stag' ),
		),
	);

	$styling_options[] = array(
		'title' => __( 'Custom CSS', 'stag' ),
		'desc'  => __( 'Quickly add some CSS to your theme by adding it to this block.', 'stag' ),
		'type'  => 'textarea',
		'id'    => 'style_custom_css',
	);

	stag_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/* Custom Stylesheet Output -----------------------------------------------*/
function stag_custom_css( $content ) {
	$stag_values = get_option( 'stag_framework_values' );
	if ( array_key_exists( 'style_custom_css', $stag_values ) && $stag_values['style_custom_css'] != '' ) {
		$content .= '/* Custom CSS */' . "\n";
		$content .= stripslashes( $stag_values['style_custom_css'] );
		$content .= "\n\n";
	}
	return $content;
}
add_filter( 'stag_custom_styles', 'stag_custom_css' );
