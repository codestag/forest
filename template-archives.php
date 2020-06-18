<?php
/**
* Template Name: Archives
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
        <div id="primary" class="site-content hfeed">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(__('Read more...', 'forest')); ?>
                <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'forest').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            </div>

            <div class="archive-lists">
                <h3><?php _e('Last 30 Posts', 'forest') ?></h3>

                <ul>
                <?php $archive_30 = get_posts('numberposts=30');
                foreach($archive_30 as $post) : ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                <?php endforeach; ?>
                </ul>

                <h3><?php _e('Archives by Month', 'forest') ?></h3>

                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>

                <h3><?php _e('Archives by Subject', 'forest') ?></h3>

                <ul>
                    <?php wp_list_categories( 'title_li=' ); ?>
                </ul>
            </div>

        </article>

        <?php endwhile; ?>

        <?php endif; ?>

        </div><!-- /#primary -->

        <?php get_sidebar(); ?>

    </div><!-- /.inside -->

<?php get_footer(); ?>
