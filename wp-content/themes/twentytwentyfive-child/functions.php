<?php

require_once get_stylesheet_directory() . '/inc/theme-helper.php';
require_once get_stylesheet_directory() . '/inc/car-post-type.php';
require_once get_stylesheet_directory() . '/inc/car-image-meta.php';

function cars_enqueue_assets()
{
    // Tailwind
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com');
    wp_enqueue_style('twentytwentyfive-child', get_stylesheet_uri());
    wp_enqueue_style('twentytwentyfive', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('flowbite', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js', array(), null, true);

    // Enqueue Owl Carousel CSS
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], null, true);
    wp_enqueue_script('custom-carousel', get_stylesheet_directory_uri() . '/js/carousel.js', ['jquery', 'owl-carousel'], null, true);

    // Theme JS
    wp_enqueue_script('cars-js', get_stylesheet_directory_uri() . '/js/cars.js');
}

add_action('wp_enqueue_scripts', 'cars_enqueue_assets');
