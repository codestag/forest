<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_testimonials");'));

class stag_widget_testimonials extends WP_Widget{
  function __construct(){
    $widget_ops = array('classname' => 'section-testimonials', 'description' => __('Displays testimonials.', 'stag'));
    $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_testimonials');
    parent::__construct('stag_widget_testimonials', __('Section: Testimonials', 'stag'), $widget_ops, $control_ops);
  }

  function widget($args, $instance){
    extract($args);

    // VARS FROM WIDGET SETTINGS
    $title = apply_filters('widget_title', $instance['title'] );

    echo $before_widget;

    if ( $title ) { echo $before_title . $title . $after_title; }

    query_posts(array(
        'post_type' => 'testimonials',
        'posts_per_page' => -1,
    ));

    echo "<div class='testimonials-slideshow' data-cycle-speed='400' data-cycle-swipe='true'>";

    if(have_posts()): while(have_posts()): the_post();

    ?>

    <blockquote>
        <i class="icon-testimonial"></i>
        <?php the_content(); ?>
        <footer><?php the_title(); ?></footer>
    </blockquote>

    <?php
    endwhile;
    endif;
    wp_reset_query();
    ?>
      <div class="cycle-pager"></div>
    </div>
    <?php
    echo $after_widget;
  }

  function update($new_instance, $old_instance){
    $instance = $old_instance;

    // STRIP TAGS TO REMOVE HTML
    $instance['title'] = strip_tags($new_instance['title']);


    return $instance;
  }

  function form($instance){
    $defaults = array(
      /* Deafult options goes here */
      'title' => '',
      'post_count' => 5
    );

    $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <?php
  }
}

?>
