<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function stag_admin_init() {

	$data = get_option( 'stag_framework_options' );

	$data['theme_version']     = STAG_THEME_VERSION;
	$data['theme_name']        = STAG_THEME_NAME;
	$data['framework_version'] = STAG_FRAMEWORK_VERSION;
	$data['stag_framework']    = array();
	update_option( 'stag_framework_options', $data );
}
add_action( 'init', 'stag_admin_init', 2 );


/**
* Load Framework Files
*/
$path         = get_template_directory() . '/framework/';
$classes_path = get_template_directory() . '/framework/classes/';

require_once $classes_path . 'class-tgm-plugin-activation.php';

require_once $path . 'stag-theme-functions.php';
require_once $path . 'stag-theme-hooks.php';
