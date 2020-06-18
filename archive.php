<?php get_header(); ?>
<?php /* Get author data */
    if(get_query_var('author_name')) {
        $curauth = get_user_by( 'login', get_query_var('author_name') );
    } else {
        $curauth = get_userdata(get_query_var('author'));
    }
?>

    <div class="blog-cover-wrap">
        <div class="inside blog-cover">
            <?php /* If this is a category archive */ if (is_category()) { ?>
                <h1 class="page-title"><?php printf(__('All posts in %s', 'forest'), single_cat_title('',false)); ?></h1>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h1 class="page-title"><?php printf(__('All posts tagged %s', 'forest'), single_tag_title('',false)); ?></h1>
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h1 class="page-title"><?php _e('Archive for', 'forest') ?> <span><?php the_time( get_option('date_format') ); ?></span></h1>
             <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h1 class="page-title"><?php _e('Archive for', 'forest') ?> <span><?php the_time('F, Y'); ?></span></h1>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h1 class="page-title"><?php _e('Archive for', 'forest') ?> <span><?php the_time('Y'); ?></span></h1>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h1 class="page-title"><?php _e('All posts by', 'forest') ?> <span><?php echo esc_html( $curauth->display_name ); ?></span></h1>
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h1 class="page-title"><?php _e('Blog Archives', 'forest') ?></h1>
            <?php } ?>
        </div>
    </div>

    <div class="inside content-wrapper">

        <div id="primary" class="site-content hfeed">

        <?php

        $archive = '';
        if (have_posts()) :

            if( is_category() ){ $archive = 'cat='. get_query_var('cat'); }
            elseif( is_tag() ){ $archive = 'tag_id='. get_query_var('tag_id'); }
            elseif( is_day() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n') .'&day='. get_the_time('j'); }
            elseif( is_month() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n'); }
            elseif( is_year() ){ $archive = 'year='. get_the_time('Y'); }
            elseif( is_author() ){ $archive = 'author='. get_query_var('author'); }
            elseif( $format = get_post_format() ){ $archive = 'post-format-'. $format; }

            $post = $posts[0];

            while (have_posts()) : the_post();

            ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php stag_post_start(); ?>

            <?php get_template_part('content'); ?>

            <?php stag_post_end(); ?>

            </article>

            <?php

            endwhile;

            else:

            get_template_part('content', 'none');

        endif;

        stag_paging_nav();

        ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>
