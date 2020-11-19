<?php
/**
 * Template Name: Widgetized
 *
 * @package Forest
 */

get_header(); ?>

<div class="widgetized-sections">
	<?php

	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;

	?>
</div>

<?php get_footer(); ?>
