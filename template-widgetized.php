<?php
/**
 * Template Name: Widgetized
 *
 * @package StagFramework
 * @subpackage Forest
 * @since 1.1.7
 */

get_header(); ?>

<div class="widgetized-sections">
	<?php

	while( have_posts() ): the_post();
		the_content();
	endwhile;

	?>
</div>

<?php get_footer(); ?>
