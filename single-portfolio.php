<?php get_header(); ?>

<div id="primary" class="portfolio-content hfeed">

    <?php while(have_posts()): the_post(); ?>

    <?php stag_post_before(); ?>
        
	<div class="portfolio-hero the-hero-<?php the_ID(); ?>">
		
		<div class="portfolio-cover the-cover-<?php the_ID(); ?>"></div>

		<div class="inside">
			
			<div class="grids">
				<h1 class="entry-title grid-9">
					<?php the_title(); ?>
				</h1>

				<div class="grid-3">
					<nav class="portfolio-navigation">
						<?php if( stag_get_option('portfolio_page') != '' && stag_get_option('portfolio_page') != "-1" ): ?>
						<li><a href="<?php echo get_page_link(stag_get_option('portfolio_page')); ?>"><i class="icon-grid"></i></a></li>
						<?php endif; ?>

						<?php
						$prev = get_adjacent_post(false, '', false);
						$next = get_adjacent_post(false, '', true);
						?>

						<?php if( is_object($prev) && $prev->ID != get_the_ID()): ?>
						<li><a href="<?php echo get_permalink($prev->ID); ?>"><i class="icon-previous"></i></a></li>
						<?php endif; ?>

						<?php if( is_object($next) && $next->ID != get_the_ID()): ?>
						<li><a href="<?php echo get_permalink($next->ID); ?>"><i class="icon-next"></i></a></li>
						<?php endif; ?>
					</nav>
				</div>
			</div>

			<?php

			$image_ids = explode(',', get_post_meta(get_the_ID(), '_stag_image_ids', true));

			if($image_ids[0] !== ""):
			?>

			<div class="flexslider portfolio-slider">
				<ul class="slides">
					<?php

					foreach ($image_ids as $image) {
						if(!$image) continue;
						$src = wp_get_attachment_image_src($image, 'full');
						echo "<li><img src='{$src[0]}' width='{$src[1]}' height='{$src[2]}'></li>";
					}

					?>
				</ul>
			</div><!-- /#portfolio-slider -->
			<?php endif; ?>

		</div>
	</div><!-- /.portfolio-hero -->

	<div class="inside">
		<div class="entry-content grids">
			<div class="project-content grid-9">
				<div class="project-content-inner">
					<?php
					the_content( __('Continue Reading <span class="meta-nav">&rarr;</span>', 'stag') );
					wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
				?>
				</div>
			</div>
			
			<?php get_template_part('helper', 'portfolio-sidebar'); ?>

		</div>
	</div>

    <?php stag_post_after(); ?>

    <?php endwhile; ?>

</div><!-- #primary -->

<?php get_footer(); ?>