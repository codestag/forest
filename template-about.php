<?php
/**
 * Template Name: About
 */
?>

<?php get_header(); ?>
    
    <div class="blog-cover-wrap the-hero-<?php the_ID(); ?>">
        <div class="the-cover the-cover-<?php the_ID(); ?>"></div>
        <div class="inside blog-cover">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="widgetized-sections">
        <?php dynamic_sidebar('sidebar-about'); ?>
    </div>

<?php get_footer(); ?>