<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_static_content");'));

class stag_widget_static_content extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'static-content', 'description' => __('Displays content from a specific page.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_static_content');
        parent::__construct('stag_widget_static_content', __('Section: Static Content', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $title = apply_filters('widget_title', $instance['title'] );
        $page = $instance['page'];
        $bg = $instance['bg'];
        $bg_image = $instance['bg_image'];
        $bg_opacity = $instance['bg_opacity'];
        $color = $instance['color'];
        $link = $instance['link'];

        echo $before_widget;

        $the_page = get_page($page);

        $query_args = array(
            'page_id' => $page,
            'posts_per_page' => 1
        );

        $query = new WP_Query($query_args);

        while ( $query->have_posts() ) : $query->the_post();

    ?>

        <article <?php post_class(); ?> data-bg-color="<?php echo $bg; ?>" data-bg-image="<?php echo $bg_image; ?>" data-bg-opacity="<?php echo $bg_opacity; ?>" data-text-color="<?php echo $color; ?>" data-link-color="<?php echo $link; ?>">
            <?php if($title != '') echo $before_title. $title . $after_title; ?>
            <div class="entry-content">
                <?php
                    global $more;
                    $more = false;
                    the_content( __('Continue Reading', 'stag') );
                    wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
                ?>
            </div>
        </article>

        <?php

        endwhile;

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['page'] = strip_tags($new_instance['page']);
        $instance['bg'] = strip_tags($new_instance['bg']);
        $instance['bg_image'] = strip_tags($new_instance['bg_image']);
        $instance['bg_opacity'] = strip_tags($new_instance['bg_opacity']);
        $instance['color'] = strip_tags($new_instance['color']);
        $instance['link'] = strip_tags($new_instance['link']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'page' => 0,
            'opacity' => 50
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo @$instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Select Page:', 'stag'); ?></label>

      <select id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" class="widefat">
      <?php

        $args = array(
          'sort_order' => 'ASC',
          'sort_column' => 'post_title',
          );
        $pages = get_pages($args);

        foreach($pages as $paged){ ?>
          <option value="<?php echo $paged->ID; ?>" <?php if($instance['page'] == $paged->ID) echo "selected"; ?>><?php echo $paged->post_title; ?></option>
        <?php }

       ?>
     </select>
     <span class="description">This page will be used to display static content.</span>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('bg'); ?>"><?php _e('Background Color:', 'stag'); ?></label><br>
      <input type="text" name="<?php echo $this->get_field_name( 'bg' ); ?>" id="<?php echo $this->get_field_id( 'bg' ); ?>" value="<?php echo @$instance['bg']; ?>" />
      <script>jQuery('#<?php echo $this->get_field_id("bg") ?>').wpColorPicker();</script>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('bg_image'); ?>"><?php _e('Background Image URL:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" name="<?php echo $this->get_field_name( 'bg_image' ); ?>" value="<?php echo @$instance['bg_image']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('bg_opacity'); ?>"><?php _e('Background Opacity:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'bg_opacity' ); ?>" name="<?php echo $this->get_field_name( 'bg_opacity' ); ?>" value="<?php echo @$instance['bg_opacity']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Text Color:', 'stag'); ?></label><br>
      <input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" id="<?php echo $this->get_field_id( 'color' ); ?>" value="<?php echo @$instance['color']; ?>" />
      <script>jQuery('#<?php echo $this->get_field_id("color") ?>').wpColorPicker();</script>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Color:', 'stag'); ?></label><br>
      <input type="text" name="<?php echo $this->get_field_name( 'link' ); ?>" id="<?php echo $this->get_field_id( 'link' ); ?>" value="<?php echo @$instance['link']; ?>" />
      <script>jQuery('#<?php echo $this->get_field_id("link") ?>').wpColorPicker();</script>
    </p>

    <?php
  }
}

?>
