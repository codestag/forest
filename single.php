<?php get_header(); ?>

	<?php get_template_part('helper', 'blog-header'); ?>
	
	<div class="inside content-wrapper">
		<div id="primary" class="site-content hfeed">

		    <?php while(have_posts()): the_post(); ?>

		    <?php stag_post_before(); ?>
		        <?php get_template_part('content'); ?>
		    <?php stag_post_after(); ?>

		    <?php comments_template(); ?>

		    <?php endwhile; ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>