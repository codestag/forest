<div class="blog-cover-wrap the-hero">
    <div class="the-blog-cover the-cover"></div>
    <div class="inside blog-cover">
        
        <div class="grids">
            
            <div class="grid-9">
                <h1 class="page-title"><?php echo stag_get_option('blog_title'); ?></h1>
            </div>

            <?php if( is_single() ): ?>
            
            <div class="grid-3">
                <nav class="navigation sp-navigation" role="navigation">
                    <?php
                    $prev = get_adjacent_post(false,'',false);
                    $next = get_adjacent_post(false,'',true);
                    ?>
                    <div class="nav-links">
                        <?php if( is_object($prev) && $prev->ID != get_the_ID()): ?>
                        <div class="nav-previous">
                            <a href="<?php echo get_permalink($prev->ID); ?>"><i class="icon icon-previous"></i></a>
                        </div>
                        <?php endif; ?>

                        <?php if( is_object($next) && $next->ID != get_the_ID()): ?>
                        <div class="nav-next">
                            <a href="<?php echo get_permalink($next->ID); ?>"><i class="icon icon-next"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        
        <?php endif; ?>
        </div><!-- .grids -->
    </div><!-- /.inside.blog-cover -->
</div><!-- /.blog-cover-wrap -->