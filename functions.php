<?php

/* Set Retina Cookie -------------------------------------------------------*/
global $is_retina;
( isset( $_COOKIE['retina'] ) ) ? $is_retina = true : $is_retina = false;

/**
* Setup theme defaults and various features.
*
* @uses load_theme_textdomain() for trasnlation/localization support
* @uses add_editor_style() To add a Visual Editor stylesheet.
* @uses add_theme_support() To add support for automatic feed links, post
* @uses set_post_thumbnail_size() To set a custom post thumbnail size.
* thumbnails and post formats.
*/
if ( ! function_exists( 'stag_theme_setup' ) ) {
	function stag_theme_setup() {

		// Load translation domain.
		load_theme_textdomain( 'forest', get_template_directory() . '/languages' );

		$locale      = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once $locale_file;
		}

		// Register Menus.
		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'forest' ) );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 770, 99999, true );

		add_image_size( 'portfolio-thumb', 370, 235, true ); // Image size for portfolio thumbnail.

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add theme support for title tag.$_COOKIE
		 *
		 * @version 2.1.0
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add theme support for selective refresh for widgets.
		 *
		 * @since 2.2.0.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add Gutenberg specific theme support.
		 *
		 * @since 2.2.0.
		 */
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-styles.css' );

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

		// Upgrade theme settings.
		forest_theme_upgrade();
	}
}
add_action( 'after_setup_theme', 'stag_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function forest_content_width() {
	$width = 750;

	if ( ! is_active_sidebar( 'sidebar-main' ) ) {
		$width = 1170;
	}

	$GLOBALS['content_width'] = apply_filters( 'forest_content_width', 750 );
}
add_action( 'after_setup_theme', 'forest_content_width', 0 );

/**
* Register widget areas.
*
* @return void
*/
if ( ! function_exists( 'stag_sidebar_init' ) ) {
	function stag_sidebar_init() {

		register_sidebar(
			array(
				'name'          => __( 'Global Sidebar', 'forest' ),
				'id'            => 'sidebar-main',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'   => __( 'Blog Widgets Area.', 'forest' ),
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Homepage Sections', 'forest' ),
				'id'            => 'sidebar-homepage',
				'before_widget' => '<section id="%1$s" class="%2$s"><div class="inside">',
				'after_widget'  => '</div></section>',
				'before_title'  => '<h2 class="section-title">',
				'after_title'   => '</h2>',
				'description'   => __( 'Here you can configure the layout of the Homepage.', 'forest' ),
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'About Sections', 'forest' ),
				'id'            => 'sidebar-about',
				'before_widget' => '<section id="%1$s" class="%2$s"><div class="inside">',
				'after_widget'  => '</div></section>',
				'before_title'  => '<h2 class="section-title">',
				'after_title'   => '</h2>',
				'description'   => __( 'About template sections.', 'forest' ),
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Service Boxes Section', 'forest' ),
				'id'            => 'sidebar-services',
				'before_widget' => '<div id="%1$s" class="grid-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="service-title">',
				'after_title'   => '</h4>',
				'description'   => __( 'Use only "Service Box" widgets here and they will populate the "Services" widget.', 'forest' ),
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Widgets', 'forest' ),
				'id'            => 'sidebar-footer',
				'before_widget' => '<div class="grid-3 widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				'description'   => __( 'Widget area for footer', 'forest' ),
			)
		);

	}
}
add_action( 'widgets_init', 'stag_sidebar_init' );

/**
* WordPress Title Filter.
*
* @since StagFramework 1.0.1
* @param string $title Default title text for current view.
* @param string $sep Optional separator.
* @return string Filtered title.
* @deprecated 2.1.0
*/
if ( ! function_exists( 'stag_wp_title' ) ) {
	function stag_wp_title( $title, $sep ) {
		if ( ! stag_check_third_party_seo() ) {
			$title .= get_bloginfo( 'name' );

			$site_desc = get_bloginfo( 'description', 'display' );
			if ( $site_desc && ( is_home() || is_front_page() ) ) {
				$title = "$title $sep $site_desc";
			}
		}
		return $title;
	}
}
// add_filter('wp_title', 'stag_wp_title', 10, 2);
/**
 * Add Gutenberg related resources.
 *
 * @return void
 */
function forest_block_editor_styles() {
	$style_dependencies = array();
	$fonts              = forest_get_google_font_uri();
	// Enqueue the fonts.
	wp_enqueue_style( 'forest-google-fonts', $fonts, array(), STAG_THEME_VERSION );

	$style_dependencies[] = 'forest-google-fonts';

	// Editor styles.
	wp_enqueue_style( 'forest-block-editor-style', get_template_directory_uri() . '/assets/css/block-editor-style.css', $style_dependencies, STAG_THEME_VERSION );

	$font_header      = forest_get_thememod_value( 'font-headers' );
	$font_body        = forest_get_thememod_value( 'font-body' );
	$accent_color     = forest_get_thememod_value( 'style_accent_color' );
	$background_color = forest_get_thememod_value( 'style_background_color' );

	wp_add_inline_style(
		'forest-google-fonts',
		".editor-styles-wrapper {
			--accent-color: {$accent_color};
			--style-background-color: {$background_color};
			--font-body: '{$font_body}';
			--font-header: '{$font_header}';
		}"
	);
}
add_action( 'enqueue_block_editor_assets', 'forest_block_editor_styles' );

/**
 * Enqueues scripts and styles for front end.
 *
 * @return void
 */
function stag_scripts_styles() {
	global $is_IE;
	if ( ! is_admin() ) {
		wp_register_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', '', '2.6.4' );

		/* Register Scripts ---------------------------------------------------*/
		wp_register_script( 'stag-custom', get_template_directory_uri() . '/assets/js/jquery.custom.js', array( 'jquery', 'superfish' ), STAG_THEME_VERSION, true );
		wp_register_script( 'stag-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array( 'jquery' ), STAG_THEME_VERSION, true );
		wp_register_script( 'superfish', get_template_directory_uri() . '/assets/js/jquery.superfish.js', array( 'jquery' ), '', true );
		wp_register_script( 'cycle2', get_template_directory_uri() . '/assets/js/jquery.cycle2.min.js', array( 'jquery' ), '20141007', true );
		wp_register_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '2.7.0', true );
		wp_register_script( 'mixitup', get_template_directory_uri() . '/assets/js/jquery.mixitup.min.js', array( 'jquery' ), '1.5.3', true );
		wp_register_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array(), '3.7.3', false );
		wp_register_script( 'css3-mediaqueries', get_template_directory_uri() . '/assets/js/css3-mediaqueries.min.js', array(), '1.0.0', false );

		/* Enqueue Scripts ---------------------------------------------------*/

		if ( is_front_page() || is_singular( 'portfolio' ) || is_page_template( 'template-widgetized.php' ) ) {
			wp_enqueue_script( 'flexslider' );
			wp_enqueue_style( 'flexslider' );
		}

		if ( is_front_page() || is_page_template( 'template-about.php' ) || is_page_template( 'template-widgetized.php' ) ) {
			wp_enqueue_script( 'cycle2' );
		}

		// Google fonts.
		$google_request = forest_get_google_font_uri();

		if ( '' !== $google_request ) {
			// Enqueue the fonts.
			wp_enqueue_style(
				'forest-google-fonts',
				$google_request,
				'',
				STAG_THEME_VERSION
			);
		}

		/* Enqueue Styles ---------------------------------------------------*/
		wp_dequeue_style( 'stag-shortcode-styles' );
		wp_enqueue_style( 'shortcode-styles', get_template_directory_uri() . '/assets/css/shortcodes.css', '', STAG_THEME_VERSION );

		wp_enqueue_style( 'stag-style', get_stylesheet_uri(), '', STAG_THEME_VERSION );
		wp_enqueue_style( 'stag-custom-style', get_template_directory_uri() . '/assets/css/stag-custom-styles.php', 'stag-style', STAG_THEME_VERSION );
		if ( is_page() && post_type_exists( 'portfolio' ) || is_page_template( 'template-homepage.php' ) ) {
			wp_enqueue_script( 'mixitup' );
		}

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'stag-custom' );
		wp_enqueue_script( 'stag-plugins' );

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' ); // Loads the javascript required for threaded comments.
		}

		wp_localize_script(
			'stag-custom',
			'stag',
			array(
				'ajaxurl'  => admin_url( 'admin-ajax.php' ),
				'accent'   => forest_get_thememod_value( 'style_accent_color' ),
				'menuIcon' => ( function_exists( 'stag_icon' ) ) ? stag_icon( array( 'icon' => 'bars' ) ) : '',
			)
		);

		if ( $is_IE ) {
			wp_enqueue( 'html5shiv' );
			wp_enqueue( 'css3-mediaqueries' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'stag_scripts_styles' );


/**
 * Comment Styling
 */
function stag_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	 <div id="comment-<?php comment_ID(); ?>" class="the-comment">

	 <div class="comment-body clearfix">
		<div class="avatar-wrap">
			<?php
			global $is_retina;
			if ( $is_retina ) {
				echo get_avatar( $comment, $size = '140' );
			} else {
				echo get_avatar( $comment, $size = '70' );
			}
			?>
		</div>
		<div class="comment-area">
			<div class="row">
			  <span class="comment-author"><?php echo get_comment_author_link(); ?></span>
			  <span class="comment-date"><?php printf( __( '%s ago', 'forest' ), human_time_diff( get_comment_date( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			   <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'forest' ); ?></em>
			<?php endif; ?>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>
		</div>
	  </div>

	 </div>
   </li>

	<?php
}

/**
 * Comment list pings
 *
 * @param array $comment Array of WP_Comment objects.
 * @return void
 */
function stag_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
	?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php
}


if ( ! function_exists( 'custom_excerpt_length' ) ) {
	/**
	 * Custom Excerpt
	 *
	 * @return int modified excerpt length.
	 */
	function custom_excerpt_length() {
		return forest_get_thememod_value( 'forest_post_excerpt_length' );
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}


if ( ! function_exists( 'new_excerpt_more' ) ) {
	/**
	 * Excerpt More
	 *
	 * @return string modified exerpt more markup.
	 */
	function new_excerpt_more() {
		global $post;
		return ' <a class="read-more" href="' . get_permalink( $post->ID ) . '">' . forest_get_thememod_value( 'forest_post_excerpt_text' ) . '</a>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );
}

/**
* Allow shortcodes in text widgets
*/
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Pagination function.
 *
 * @return void
 */
function pagination() {
	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ( $total_pages > 1 ) {
		if ( $total_pages > 1 ) {
			$current_page = max( 1, get_query_var( 'paged' ) );
			$return       = paginate_links(
				array(
					'base'      => get_pagenum_link( 1 ) . '%_%',
					'format'    => '/page/%#%',
					'current'   => $current_page,
					'total'     => $total_pages,
					'prev_next' => false,
				)
			);
			echo "<div class='pages'>{$return}</div>";
		}
	} else {
		return false;
	}
}

/**
 * Process Page navigation.
 *
 * @return void
 */
function stag_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}
	?>
  <nav class="navigation paging-navigation" role="navigation">
	<?php
	if ( ! is_search() ) {
		pagination();}
	?>
	<div class="nav-links">

		<?php if ( get_previous_posts_link() ) : ?>
	  <div class="nav-previous"><?php previous_posts_link( __( '<i class="icon icon-previous"></i>', 'forest' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_next_posts_link() ) : ?>
	  <div class="nav-next"><?php next_posts_link( __( '<i class="icon icon-next"></i>', 'forest' ) ); ?></div>
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
function forest_required_plugins() {
	$plugins = array(

		array(
			'name'     => __( 'StagTools', 'forest' ),
			'slug'     => 'stagtools',
			'required' => true,
		),
		array(
			'name'             => __( 'Forest Assistant', 'forest' ),
			'slug'             => 'forest-assistant',
			'source'           => get_parent_theme_file_path() . '/assistant/forest-assistant-1.0.1.zip',
			'required'         => true,
			'force_activation' => true,
			'version'          => '1.0.1',
			'external_url'     => 'https://github.com/codestag/forest-assistant/',
		),

	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'forest_required_plugins' );

/**
 * Check if there is any third party plugin active
 *
 * @since 1.1
 */
function stag_check_third_party_seo() {
	if ( class_exists( 'HeadSpace2_Admin' ) ) {
		return true;
	}
	if ( defined( 'AIOSEOP_VERSION' ) ) {
		return true;
	}
	if ( defined( 'WPSEO_VERSION' ) ) {
		return true;
	}

	return false;
}

/**
 * Parse the date for portfolio page.
 *
 * @since  1.1.2
 */
function stag_date( $arg, $data = null ) {
	$return = date( $arg, strtotime( $data ) );
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
		'after_title'   => '</h2>',
	);
}
add_filter( 'stag_custom_sidebars_widget_args', 'stag_custom_sidebar_widget_wrapper' );


if ( ! function_exists( 'forest_assistant_notice' ) ) {
	/**
	 * Alerts if assistant plugin is not activated.
	 *
	 * @since 2.3.0
	 * @return void
	 */
	function forest_assistant_notice() {
		if ( ! class_exists( 'Forest_Assistant' ) && current_user_can( 'activate_plugins' ) ) {
			$page_link = self_admin_url( 'themes.php?page=tgmpa-install-plugins' );
			$message   = '<p>' . sprintf( '%1$s<br><strong>%2$s<a href="%3$s">this page</a>.', __( 'As per ThemeForest guidelines, some functionalities are now excluded from theme and moved to an assistant plugin.', 'forest' ), __( 'To use Forest with full features, please activate Forest Assistant from ', 'forest' ), esc_url( $page_link ) ) . '</strong></p>';

			echo '<div class="error">' . $message . '</div>'; // phpcs:ignore
		}
	}
}
add_action( 'admin_notices', 'forest_assistant_notice' );

/**
 * Include framework and other files
 */
require_once get_template_directory() . '/framework/stag-framework.php';
require_once get_template_directory() . '/includes/customizer/load.php';
require_once get_template_directory() . '/includes/template-tags.php';
require_once get_template_directory() . '/includes/upgrade.php';
require_once get_template_directory() . '/includes/extras.php';

