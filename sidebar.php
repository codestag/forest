<?php if( is_active_sidebar( 'sidebar-main' ) ) : ?>
    <div id="sidebar" class="sidebar" role="complementary">
        <div class="widget-area">
            <?php dynamic_sidebar( 'sidebar-main' ); ?>
        </div><!-- .widget-area -->
    </div><!-- #sidebar -->
<?php endif; ?>