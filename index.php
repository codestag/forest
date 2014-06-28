<?php get_header(); ?>
    
    <?php get_template_part('helper', 'blog-header'); ?>
        
    <div class="inside content-wrapper">
        <div id="primary" class="site-content hfeed">
            <?php stag_post_before(); ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php stag_post_start(); ?>
                <?php get_template_part('content'); ?>
            <?php stag_post_end(); ?>

            <?php endwhile; ?>
            <?php stag_post_after(); ?>

            <?php else: ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; ?>

            <?php stag_paging_nav(); ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>