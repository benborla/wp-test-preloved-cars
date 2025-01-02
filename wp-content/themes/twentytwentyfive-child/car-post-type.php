<?php

function create_car_post_type()
{
    register_post_type('car', [
        'labels' => [
            'name' => 'Cars',
            'singular_name' => 'Car',
            'add_new' => 'Add New Car',
            'add_new_item' => 'Add New Car',
            'edit_item' => 'Edit Car',
            'view_item' => 'View Car'
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'gallery'],
        'menu_icon' => 'dashicons-car',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_car_post_type');
