<?php
/**
 * Includes theme files such as widgets and post meta boxes.
 *
 * @package Stag_Customizer
 */

/**
 * Include Theme Widgets.
 */
require_once 'widgets/class-forest-widget.php';
require_once 'widgets/widget-portfolio.php';
require_once 'widgets/widget-static-content.php';
require_once 'widgets/widget-services-section.php';
require_once 'widgets/widget-services.php';
require_once 'widgets/widget-slider.php';
require_once 'widgets/widget-latest-posts.php';
require_once 'widgets/widget-clients.php';
require_once 'widgets/widget-testimonials.php';
require_once 'widgets/widget-team.php';
require_once 'widgets/widget-featured-portfolio.php';


/**
 * Include Meta Boxes.
 */
if ( false === forest_get_thememod_value( 'general_disable_seo_settings' ) ) {
	require_once 'meta/meta-seo.php';
}

require_once 'meta/meta-portfolio.php';
require_once 'meta/meta-slides.php';
require_once 'meta/meta-background.php';
require_once 'meta/meta-team.php';

require_once 'theme-shortcodes.php';
