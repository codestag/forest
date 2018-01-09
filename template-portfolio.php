<?php
/**
* Template Name: Portfolio
*/
?>

<?php get_header(); ?>

	<div id="primary" class="portfolio-content section-portfolio">
		<div class="portfolio-hero">
			<div class="inside">

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<ul class="portfolio-filter">
					<li class="button filter" data-filter="all"><?php _e('All', 'stag'); ?></li>
					<?php

					$terms = get_terms('skill');
					$count = count($terms);
					$i = 0;

					if($count > 0){
					    foreach($terms as $term){
					        echo "<li class='button filter' data-filter='{$term->slug}'>{$term->name}</li>";
					    }
					}

					?>
				</ul>

				<ul id="portfolio-filter" class="grids portfolios">

				  <?php

				  $args = array(
					'post_type'      => 'portfolio',
					'posts_per_page' => -1,
				  );

				  $query = new WP_Query($args);

				  if( $query->have_posts() ):

				  while( $query->have_posts() ): $query->the_post();

				  if(!has_post_thumbnail()) continue;

				  $skills = get_the_terms(get_the_ID(), 'skill');
				  $skill = array();
				  if($skills){
				  	foreach($skills as $ski){
				  		$skill[] .= $ski->slug;
				  	}
				  	$skill = implode($skill, ' ');
				  }

				  $class = "grid-4 mix ".$skill;

				  ?>

				    <li id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>

				        <figure class="portfolio-thumb">

				            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>">
				                <div class="portfolio-preview">
				                    <button class="button-secondary"><i class="icon-eye"></i> Details</button>
				                </div>
				                <?php

				                $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'portfolio-thumb' );
				                $attr = array(
				                	'src' => get_template_directory_uri().'/assets/img/blank.gif',
				                	'data-src' => $src[0],
				                	'class' => 'lazy'
				                );

				                ?>
				                <?php echo get_the_post_thumbnail(get_the_ID(), 'portfolio-thumb', $attr); ?>
				            </a>

				        </figure>

				        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
				        <?php

				        $portfolio_sub_title = get_post_meta( get_the_ID(), '_stag_portfolio_subtitle', true );

				        if($portfolio_sub_title) echo "<p>{$portfolio_sub_title}</p>";

				        ?>
				    </li>

				  <?php

				  endwhile;

				  endif;

				  wp_reset_postdata();
				  ?>

				</div>

			</div>
		</div><!-- .portfolio-hero -->
	</div><!-- #primary -->

	<?php

	$text             = stag_get_option('portfolio_cta_text');
	$button_text      = stag_get_option('portfolio_cta_button_text');
	$button_text_link = stag_get_option('portfolio_cta_button_link');
	$button_window    = (stag_get_option('portfolio_cta_button_window') == "on") ? " target='_blank'" : false;

	if( $text != '' ):
		?>

		<div class="call-to-action <?php if($button_text != '') echo "with-button"; ?>">
			<div class="inside">
				<p><?php echo $text; ?></p>
				<?php if( $button_text != '' ): ?>
				<a href="<?php echo esc_url($button_text_link) ?>" class="button" <?php echo $button_window; ?>><?php echo $button_text; ?></a>
				<?php endif; ?>
			</div>
		</div>

		<?php
	endif;



	?>

<?php get_footer(); ?>
