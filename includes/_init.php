<?php

/* Include Theme Options -------------------------------------------------------------------------*/
require_once('options/general-settings.php');
require_once('options/styling-options.php');

require_once('options/blog-settings.php');
require_once('options/portfolio-settings.php');
require_once('options/social-settings.php');


/* Include Theme Widgets -------------------------------------------------------------------------*/
require_once('widgets/widget-portfolio.php');
require_once('widgets/widget-static-content.php');
require_once('widgets/widget-services-section.php');
require_once('widgets/widget-services.php');
require_once('widgets/widget-slider.php');
require_once('widgets/widget-latest-posts.php');
require_once('widgets/widget-clients.php');
require_once('widgets/widget-testimonials.php');
require_once('widgets/widget-team.php');
require_once('widgets/widget-featured-portfolio.php');


/* Include Meta Boxes -------------------------------------------------------------------------*/
if(stag_get_option('general_disable_seo_settings') == 'off'){
  require_once('meta/meta-seo.php');
}

require_once('meta/meta-portfolio.php');
require_once('meta/meta-slides.php');
require_once('meta/meta-background.php');
require_once('meta/meta-team.php');

require_once('theme-shortcodes.php');