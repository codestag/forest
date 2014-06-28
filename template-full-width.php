<?php
/**
* Template Name: Full Width
*/
?>
<?php get_header(); ?>

    <div class="blog-cover-wrap the-hero-<?php the_ID(); ?>">
        <div class="the-cover the-cover-<?php the_ID(); ?>"></div>
        <div class="inside blog-cover">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="inside content-wrapper">
        <div id="primary" class="site-content full hfeed">
            <?php stag_page_before(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php stag_page_start(); ?>

                <div class="entry-content">
                    <?php
                        the_content( __('Continue Reading <span class="meta-nav">&rarr;</span>', 'stag') );
                        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
                    ?>
                </div><!-- .entry-content -->

                <?php stag_page_end(); ?>
            </article><!-- #post -->

            <?php endwhile; ?>

            <?php stag_page_after(); ?>
        </div><!-- #primary -->
    </div>

<?php get_footer(); ?>