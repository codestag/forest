<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_services");'));

class stag_widget_services extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'service', 'description' => __('Display latest posts from blog.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_services');
        parent::__construct('stag_widget_services', __('Service Box', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $title = apply_filters('widget_title', $instance['title'] );
        $description = $instance['description'];
        $custom_icon = $instance['customicon'];

        echo $before_widget;

    ?>


        <?php if(!empty($custom_icon)){
            echo '<div class="custom-icon"><img src="'.$custom_icon.'" alt=""></div>';
        } ?>

        <div class="service-content">
            <?php
            echo "\n\t".$before_title. htmlspecialchars_decode($title) . $after_title;
            if(!empty($description)) echo "\n\t<div class='service__description'>". htmlspecialchars_decode($description) ."</div>";
            ?>
        </div>

        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        $instance['title'] = $new_instance['title'];
        $instance['description'] = $new_instance['description'];
        $instance['customicon'] = strip_tags($new_instance['customicon']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'title' => '',
            'customicon' => '',
            'description' => '',
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'stag'); ?></label>
        <textarea rows="5" class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo @$instance['description']; ?></textarea>
        <span class="description"><?php _e('Some HTML would not harm.', 'stag'); ?></span>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('customicon'); ?>"><?php _e('Custom Icon URL:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'customicon' ); ?>" name="<?php echo $this->get_field_name( 'customicon' ); ?>" value="<?php echo @$instance['customicon']; ?>" />
      <span class="description"><?php _e('Enter the custom icon URL if you want to use your own icon or choose one below. Recommended size 100x100px.', 'stag'); ?></span>
    </p>

    <?php
  }
}

?>
