<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php stag_meta_head(); ?>

	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<?php stag_head(); ?>
	<?php wp_head(); ?>
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<?php stag_body_start(); ?>

	<?php stag_header_before(); ?>

	<header id="masthead" class="site-header" role="banner">

		<div class="inside">
			<?php stag_header_start(); ?>

			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php
				if ( true === forest_get_thememod_value( 'forest_text_logo' ) ) {
				?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php } elseif ( forest_get_thememod_value( 'forest_custom_logo' ) != '' ) { ?>
					<img src="<?php echo forest_get_thememod_value( 'forest_custom_logo' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>">
				<?php
}
				?>
				<?php if ( get_bloginfo( 'description' ) != '' ) : ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</a>

			<?php stag_nav_before(); ?>

			<nav id="site-navigation" class="navigation main-navigation" role="navigation">
				<?php
				if ( has_nav_menu( 'primary-menu' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'container'      => '',
							'menu_class'     => 'nav',
							'items_wrap'     => '<ul id="primary-menu" class="%2$s">%3$s</ul>',
						)
					);
				}
				?>
			</nav><!-- #site-navigation -->

			<?php stag_nav_after(); ?>

			<?php stag_header_end(); ?>
		</div>

	</header><!-- #masthead -->

	<?php stag_header_after(); ?>

	<main role="main">
