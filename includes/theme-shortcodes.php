<?php
/* Theme Shortcode for social links ------------------------------------------------------------------------------------*/
function stag_social_shortcode( $atts ){
    extract( shortcode_atts( array(
        'url' => '',
    ), $atts ) );

    $output = '<div class="social-icons">';
    $url = explode(',', $url);

    foreach($url as $u){
        $u = trim($u);

        if($u === 'email' || $u === ' email'){
          $output .= "<a target='_blank' href='mailto:". stag_get_option('general_contact_email') ."'><i class='icon icon-{$u}'></i></a>";
      }
      if($u === 'rss' || $u === ' rss'){
          $output .= "<a target='_blank' href='". get_bloginfo('rss_url') ."'><i class='icon icon-{$u}'></i></a>";
      }

      if(stag_get_option('social_'.$u) != ''){
          $output .= "<a target='_blank' href='". stag_get_option('social_'.$u) ."' target='_blank'><i class='icon icon-{$u}'></i></a>";
      }
  }

    $output .= '</div>';

    return $output;
}
add_shortcode( 'social', 'stag_social_shortcode' );