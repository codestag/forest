<?php get_header(); ?>

    <div class="blog-cover-wrap">
        <div class="inside blog-cover">
            <h1 class="page-title"><?php _e('Error 404 - Not Found', 'forest') ?></h1>
        </div>
    </div>

    <div class="inside content-wrapper">
        <div id="primary" class="site-content hfeed">

            <div class="entry-content">
                <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'forest' ); ?></p>

                <?php get_search_form(); ?>
            </div>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>
