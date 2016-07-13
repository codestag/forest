<?php
add_action('admin_init', 'stag_blog_settings');
function stag_blog_settings(){
    $blog_settings['description'] = __('Customize your blog settings', 'stag');

    $blog_settings[] = array(
        'title' => __('Blog Title', 'stag'),
        'desc'  => __('Enter the default title for the blog header section.', 'stag'),
        'type'  => 'text',
        'id'    => 'blog_title',
        'val'   => 'Blog Entries'
    );

    $blog_settings[] = array(
        'title' => __('Blog Background Image', 'stag'),
        'desc'  => __('Upload a default background image for the blog header section.', 'stag'),
        'type'  => 'file',
        'id'    => 'blog_background',
        'val'   => __('Upload Background', 'stag')
    );

    $blog_settings[] = array(
        'title' => __('Blog Background Color', 'stag'),
        'desc'  => __('Choose a default background color for the blog header section.', 'stag'),
        'type'  => 'color',
        'id'    => 'blog_background_color',
        'val'   => '#41415e'
    );

    $blog_settings[] = array(
        'title' => __('Blog Background Opacity', 'stag'),
        'desc'  => __('Choose a default value for background image at the blog header section. For no opacity give a value of 100.', 'stag'),
        'type'  => 'text',
        'id'    => 'blog_background_opacity',
        'val'   => '70'
    );

    stag_add_framework_page( 'Blog Settings', $blog_settings, 15 );
}
