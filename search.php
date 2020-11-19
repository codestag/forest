<?php
/**
 * The template for displaying search result page.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Forest
 */

get_header(); ?>

	<div class="blog-cover-wrap">
		<div class="inside blog-cover">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'forest' ), get_search_query() ); ?></h1>
		</div>
	</div>

	<div class="inside content-wrapper">
		<div id="primary" class="site-content hfeed">
		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		<?php stag_paging_nav(); ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
