    </main>
    
    <?php stag_footer_before(); ?>

    <?php if( is_active_sidebar( 'sidebar-footer' )): ?>

    <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="inside">
            <?php stag_footer_start(); ?>
            
            <div class="grids">
                <?php dynamic_sidebar( 'sidebar-footer' ); ?>
            </div>

            <?php stag_footer_end(); ?>
        </div>

    </footer><!-- .site-footer -->

    <?php endif; ?>

    <footer class="secondary-footer">
        <div class="inside">
            <div class="grids">
                <div class="site-info grid-6">
                    <?php echo stripslashes(stag_get_option('general_footer_text')); ?>
                </div><!-- .site-info -->

                <div class="grid-6">
                    <?php echo do_shortcode(stripcslashes(stag_get_option('footer_social_links'))); ?>
                </div>
            </div>
        </div>
    </footer><!-- /.secondary-footer -->

    <?php stag_footer_after(); ?>

    <?php stag_body_end(); ?>

    <?php wp_footer(); ?>
</body>
</html>