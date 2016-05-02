<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_slider");'));

class stag_widget_slider extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'section-slider', 'description' => __('Displays the slideshow.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_slider');
        parent::__construct('stag_widget_slider', __('Section: Slider', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS

        echo $before_widget;

        query_posts(array(
          'post_type'      => 'slides',
          'posts_per_page' => -1,
          'post_status'    => 'publish'
        ));

        if(have_posts()):

        ?>

        <div id="slider" class="flexslider">
            <ul class="slides">
                <?php while(have_posts()): the_post(); ?>
                <?php
                    $button_link = get_post_meta( get_the_ID(), '_stag_slider_link', true);
                    $button_text = get_post_meta( get_the_ID(), '_stag_slider_text', true);
                ?>
                <li>
                    <div class="flex-caption">
                        <div class="flex-caption--inner">
                            <div class="flex-content">
                                <h2><?php the_title(); ?></h2>
                                <?php if($button_link): ?>
                                <a href="<?php echo $button_link; ?>" class="button-secondary"><?php echo $button_text; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <img src="<?php echo get_post_meta(get_the_ID(), '_stag_slider_image', true); ?>" alt="">
                </li>
                <?php endwhile; ?>
            </ul>
            <div class="flex-container"></div>
        </div>

        <?php

        endif;

        wp_reset_query();

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        // $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p><span class="description"><?php _e('Yay! No options to set!', 'stag'); ?></span></p>

    <?php
  }
}

?>
