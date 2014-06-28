<?php
add_action('admin_init', 'stag_portfolio_settings');
function stag_portfolio_settings(){
    
    $portfolio_settings['description'] = __('Customize your portfolio settings', 'stag');

    $portfolio_settings[] = array(
        'title' => __('Portfolio CTA text', 'stag'),
        'desc'  => __('Enter the call to action text for portfolio page.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_cta_text',
        'val'   => ''
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio CTA Button text', 'stag'),
        'desc'  => __('Enter the call to action button text for portfolio page.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_cta_button_text',
        'val'   => ''
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio CTA Button Link', 'stag'),
        'desc'  => __('Enter the call to action button link for portfolio page.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_cta_button_link',
        'val'   => ''
    );

    $portfolio_settings[] = array(
        'title' => __('Open link in new window?', 'stag'),
        'desc'  => __('Check to open the call to action button link in new window.', 'stag'),
        'type'  => 'checkbox',
        'id'    => 'portfolio_cta_button_window',
        'val'   => 'off'
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Page', 'stag'),
        'desc'  => __('Select portfolio page, used for link to portfolio page.', 'stag'),
        'type'  => 'pages',
        'id'    => 'portfolio_page'
    );
    
    stag_add_framework_page( 'Portfolio Settings', $portfolio_settings, 20 );
}
