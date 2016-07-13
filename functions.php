<?php

/* Set Content Width ---------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 940;

/* Set Retina Cookie -------------------------------------------------------*/
global $is_retina;
(isset($_COOKIE['retina'])) ? $is_retina = true : $is_retina = false;

/**
* Setup theme defaults and various features
* @uses load_theme_textdomain() for trasnlation/localization support
* @uses add_editor_style() To add a Visual Editor stylesheet.
* @uses add_theme_support() To add support for automatic feed links, post
* @uses set_post_thumbnail_size() To set a custom post thumbnail size.
* thumbnails and post formats.
*/
if(!function_exists('stag_theme_setup')){
    function stag_theme_setup(){

        /* Load translation domain ---------------------------------------------*/
        load_theme_textdomain('stag', get_template_directory().'/languages');

        $locale = get_locale();
        $locale_file = get_template_directory()."/languages/$locale.php";
        if(is_readable($locale_file)){
          require_once($locale_file);
        }

        /* Register Menus ------------------------------------------------------*/
        register_nav_menu('primary-menu', __('Primary Menu', 'stag'));

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style( 'framework/assets/css/editor-style.css' );

        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 770, 99999, true );

        add_image_size( 'portfolio-thumb', 370, 235, true ); // image size for portfolio thumbnail

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        /**
         * Add StagFramework specific theme support
         *
         * @uses Stagtools
         * @link http://wordpress.org/plugins/stagtools/
         * @author Ram Ratan Maurya
         * @since 1.1
         */
        add_theme_support( 'stag-portfolio' );
        add_theme_support( 'stag-slides' );
        add_theme_support( 'stag-testimonials' );
        add_theme_support( 'stag-team' );
    }
}
add_action('after_setup_theme', 'stag_theme_setup');


/**
* Register widget areas
* @return void
*/
if(!function_exists('stag_sidebar_init')){
  function stag_sidebar_init(){

    register_sidebar(array(
        'name' => __('Global Sidebar', 'stag'),
        'id' => 'sidebar-main',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'description'   => __('Blog Widgets Area.', 'stag')
    ));

    register_sidebar(array(
        'name' => __('Homepage Sections', 'stag'),
        'id' => 'sidebar-homepage',
        'before_widget' => '<section id="%1$s" class="%2$s"><div class="inside">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="section-title">',
        'after_title'   => '</h2>',
        'description'   => __('Here you can configure the layout of the Homepage.', 'stag')
    ));

    register_sidebar(array(
        'name' => __('About Sections', 'stag'),
        'id' => 'sidebar-about',
        'before_widget' => '<section id="%1$s" class="%2$s"><div class="inside">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="section-title">',
        'after_title'   => '</h2>',
        'description'   => __('About template sections.', 'stag')
    ));

    register_sidebar(array(
      'name' => __('Service Boxes Section', 'stag'),
      'id' => 'sidebar-services',
      'before_widget' => '<div id="%1$s" class="grid-3 %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="service-title">',
      'after_title'   => '</h4>',
      'description'   => __('Use only "Service Box" widgets here and they will populate the "Services" widget.', 'stag')
    ));

    register_sidebar(array(
        'name' => __('Footer Widgets', 'stag'),
        'id' => 'sidebar-footer',
        'before_widget' => '<div class="grid-3 widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        'description'   => __('Widget area for footer', 'stag')
    ));

  }
}
add_action('widgets_init', 'stag_sidebar_init');

/**
* WordPress Title Filter
* @since StagFramework 1.0.1
* @param string $title Default title text for current view.
* @param string $sep Optional separator.
* @return string Filtered title.
*/
if ( !function_exists( 'stag_wp_title' ) ) {
    function stag_wp_title($title, $sep) {
        if( !stag_check_third_party_seo() ){
            $title .= get_bloginfo( 'name' );

            $site_desc = get_bloginfo( 'description', 'display' );
            if( $site_desc && ( is_home() || is_front_page() ) ) {
                $title = "$title $sep $site_desc";
            }
        }
        return $title;
    }
}
add_filter('wp_title', 'stag_wp_title', 10, 2);


/**
* Enqueues scripts and styles for front end.
* @return void
*/
function stag_scripts_styles(){
    if( !is_admin() ){
        wp_register_style('flexslider', get_template_directory_uri().'/assets/css/flexslider.css', '', '2.1');

        /* Register Scripts ---------------------------------------------------*/
        wp_register_script('stag-custom', get_template_directory_uri().'/assets/js/jquery.custom.js', array('jquery', 'superfish'), STAG_THEME_VERSION, true);
        wp_register_script('stag-plugins', get_template_directory_uri().'/assets/js/plugins.js', array('jquery'), STAG_THEME_VERSION, true);
        wp_register_script('superfish', get_template_directory_uri().'/assets/js/jquery.superfish.js', array('jquery'), '', true);
        wp_register_script('cycle2', '//cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/20130409/jquery.cycle2.min.js', array('jquery'), 'v20130409', true);
        wp_register_script('flexslider', get_template_directory_uri().'/assets/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);
        wp_register_script('mixitup', get_template_directory_uri().'/assets/js/jquery.mixitup.min.js', array('jquery'), '1.5.3', true);

        /* Enqueue Scripts ---------------------------------------------------*/

        if( is_front_page() || is_singular('portfolio') || is_page_template( 'template-widgetized.php' ) ){
            wp_enqueue_script( 'flexslider' );
            wp_enqueue_style( 'flexslider' );
        }

        if( is_front_page() || is_page_template( 'template-about.php' ) || is_page_template( 'template-widgetized.php' ) ){
          wp_enqueue_script('cycle2');
        }

        /* Enqueue Styles ---------------------------------------------------*/
        wp_dequeue_style( 'stag-shortcode-styles' );
        wp_enqueue_style( 'shortcode-styles', get_template_directory_uri().'/assets/css/shortcodes.css', '', STAG_THEME_VERSION );

        wp_enqueue_style( 'stag-style', get_stylesheet_uri(), '', STAG_THEME_VERSION );
        wp_enqueue_style( 'stag-custom-style', get_template_directory_uri().'/assets/css/stag-custom-styles.php', 'stag-style', STAG_THEME_VERSION );
        wp_enqueue_style( 'doctype-fonts', stag_google_font_url(), array(), null );

        if( is_page() && post_type_exists( 'portfolio' ) || is_page_template( 'template-homepage.php' ) ) wp_enqueue_script('mixitup');

        wp_enqueue_script('jquery');
        wp_enqueue_script('stag-custom');
        wp_enqueue_script('stag-plugins');
        if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments

        wp_localize_script('stag-custom', 'stag', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'accent' => stag_get_option('style_accent_color'),
            'menuIcon' => ( function_exists( 'stag_icon' ) ) ? stag_icon( array( 'icon' => 'bars' ) ) : ''
        ));

    }
}
add_action('wp_enqueue_scripts', 'stag_scripts_styles');


/**
* Comment Styling
*/
function stag_comments($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the-comment">

     <div class="comment-body clearfix">
        <div class="avatar-wrap">
          <?php
            global $is_retina;
            if($is_retina){
              echo get_avatar($comment, $size='140');
            }else{
              echo get_avatar($comment, $size='70');
            }
          ?>
        </div>
        <div class="comment-area">
            <div class="row">
              <span class="comment-author"><?php echo get_comment_author_link(); ?></span>
              <span class="comment-date"><?php printf( __( '%s ago', 'stag' ), human_time_diff( get_comment_date( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
              <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
               <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'stag') ?></em>
            <?php endif; ?>
            <div class="comment-text">
              <?php comment_text() ?>
            </div>
        </div>
      </div>

     </div>
   </li>

<?php
}

function stag_list_pings($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }


/**
* Custom Excerpt
*/
if(!function_exists('custom_excerpt_length')){
    function custom_excerpt_length( $length ) {
        return stag_get_option('general_post_excerpt_length');
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}


if(!function_exists('new_excerpt_more')){
    function new_excerpt_more($more) {
        global $post;
        return ' <a class="read-more" href="'. get_permalink($post->ID) . '">'.stag_get_option('general_post_excerpt_text').'</a>';
    }
    add_filter('excerpt_more', 'new_excerpt_more');
}

/**
* Allow shortcodes in text widgets
*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


/**
* Relative Date for comments
*/
// add_filter( 'get_comment_date', 'get_the_relative_time' );
function get_the_relative_time($time = null){
    if(is_null($time)) $time = get_the_time("U");

    $time_diff = date("U") - $time; // difference in second

    $second = 1;
    $minute = 60;
    $hour = 60*60;
    $day = 60*60*24;
    $week = 60*60*24*7;
    $month = 60*60*24*7*30;
    $year = 60*60*24*7*30*365;

    if ($time_diff <= 120) {
        $output = "now";
    } elseif ($time_diff > $second && $time_diff < $minute) {
        $output = round($time_diff/$second)." second";
    } elseif ($time_diff >= $minute && $time_diff < $hour) {
        $output = round($time_diff/$minute)." minute";
    } elseif ($time_diff >= $hour && $time_diff < $day) {
        $output = round($time_diff/$hour)." hour";
    } elseif ($time_diff >= $day && $time_diff < $week) {
        $output = round($time_diff/$day)." day";
    } elseif ($time_diff >= $week && $time_diff < $month) {
        $output = round($time_diff/$week)." week";
    } elseif ($time_diff >= $month && $time_diff < $year) {
        $output = round($time_diff/$month)." month";
    } elseif ($time_diff >= $year && $time_diff < $year*10) {
        $output = round($time_diff/$year)." year";
    } else{ $output = " more than a decade ago"; }

    if ($output <> "now") {
        $output = (substr($output,0,2)<>"1 ") ? $output."s" : $output;
        $output .= " ago";
    }

  return $output;
}


function pagination(){
  global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if($total_pages > 1){
      if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        $return = paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_next' => false
          ));
        echo "<div class='pages'>{$return}</div>";
        }
  }else{
    return false;
  }
}


function stag_paging_nav() {
  global $wp_query;

  // Don't print empty markup if there's only one page.
  if ( $wp_query->max_num_pages < 2)
    return;
  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <?php if( !is_search() ) pagination(); ?>
    <div class="nav-links">

      <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-previous"><?php previous_posts_link( __( '<i class="icon icon-previous"></i>', 'stag' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-next"><?php next_posts_link( __( '<i class="icon icon-next"></i>', 'stag' ) ); ?></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}


/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function stag_required_plugins() {
  $plugins = array(

    array(
      'name'    => 'StagTools',
      'slug'    => 'stagtools',
      'required'  => true,
    ),

  );

  tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'stag_required_plugins' );

/**
 * Check if there is any third party plugin active
 *
 * @since 1.1
 */
function stag_check_third_party_seo() {
	include_once(ABSPATH .'wp-admin/includes/plugin.php');
	if( is_plugin_active('headspace2/headspace.php') ) return true;
	if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
	if( is_plugin_active('wordpres-seo/wp-seo.php') ) return true;
	return false;
}

/**
 * Parse the date for portfolio page.
 *
 * @since  1.1.2
 */
function stag_date( $arg, $data = null ) {
  $return = date($arg, strtotime($data));
  return $return;
}

/**
 * Stag Custom Sidebar wrapper to match theme structure.
 *
 * @since 1.1.7
 * @return array Sidebar wrapper.
 */
function stag_custom_sidebar_widget_wrapper() {
	return array(
		'before_widget' => '<section id="%1$s" class="%2$s"><div class="inside">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="section-title">',
		'after_title'   => '</h2>'
	);
}
add_filter( 'stag_custom_sidebars_widget_args', 'stag_custom_sidebar_widget_wrapper' );

/**
 * Include framework and other files
 */

include_once ( get_template_directory() . '/framework/stag-framework.php' );
include_once ( get_template_directory() . '/includes/_init.php' );
