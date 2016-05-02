<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_team");'));

class stag_widget_team extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'section-team', 'description' => __('Displays team members.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_team');
        parent::__construct('stag_widget_team', __('Section: Team', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;

        if($title != '') echo $before_title. $title . $after_title;

        query_posts(array(
            'post_type' => 'team',
            'posts_per_page' => -1,
        ));

        echo '<section class="team-members">';

        if(have_posts()): while(have_posts()): the_post();

        if( !has_post_thumbnail() ) continue;

        $info = get_post_meta( get_the_ID(), '_stag_team_info', true );
        $twitter = get_post_meta( get_the_ID(), '_stag_team_twitter', true );
        $gplus = get_post_meta( get_the_ID(), '_stag_team_gplus', true );
        $linkedin = get_post_meta( get_the_ID(), '_stag_team_linkedin', true );

        ?>

        <div class="team-member">
            <figure class="member-picture">
                <?php the_post_thumbnail(); ?>

                <div class="team-member-icons social-icons">
                    <?php
                        if($twitter != '') echo '<a href="'. esc_url($twitter) .'" target="_blank"><i class="icon icon-twitter"></i></a>';
                        if($gplus != '') echo '<a href="'. esc_url($gplus) .'" target="_blank"><i class="icon icon-google-plus"></i></a>';
                        if($linkedin != '') echo '<a href="'. esc_url($linkedin) .'" target="_blank"><i class="icon icon-linkedin"></i></a>';
                    ?>
                </div>
            </figure>

            <h3 class="member-title"><?php the_title(); ?></h3>
            <?php if( $info != '' ) echo '<p class="member-info">'. $info .'</p>'; ?>
        </div>

        <?php
        endwhile;
        endif;
        wp_reset_query();
        ?>

        </section>
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
      'title' => 'Our Team'
    );

    $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo @$instance['title']; ?>" />
    </p>

    <?php
  }
}

?>
