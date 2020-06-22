<?php
/**
* The default template for displaying content. Used for both single and index/archive/search.
*
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php stag_post_start(); ?>

    <header class="entry-header">
        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <figure class="entry-thumbnail">
            <?php if(!is_single()) echo '<a href="'.get_permalink(get_the_ID()).'">'; ?>
            <?php the_post_thumbnail(); ?>
            <?php if(!is_single()) echo '</a>'; ?>
        </figure>
        <?php endif; ?>

        <div class="entry-metadata">
            <time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            in category <span class="category"><?php echo get_the_category_list( __( ', ', 'forest' ) ); ?></span>
            <?php if(has_tag()): ?>
            <span class="post-tags">
                <?php the_tags('tags ', ', ', ''); ?>
            </span>
        <?php endif; ?>
            and <?php comments_popup_link( '0 comments', '1 comment', '% comments' ); ?>.
        </div>

        <?php if ( is_single() ) : ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'forest' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            the_content( __('Read More&hellip;', 'forest') );
            wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'forest').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
        ?>
    </div><!-- .entry-content -->

    <?php stag_post_end(); ?>
</article><!-- #post -->
