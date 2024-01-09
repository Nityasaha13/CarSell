<?php
function custom_register_car_post_type()
{
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car',
        'menu_name' => 'Cars',
        'add_new' => 'Add New Car',
        'add_new_item' => 'Add New Car',
        'edit_item' => 'Edit Car',
        'new_item' => 'New Car',
        'view_item' => 'View Car',
        'search_items' => 'Search Cars',
        'not_found' => 'No cars found',
        'not_found_in_trash' => 'No cars found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'author'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-car',
        'rewrite' => array('slug' => 'car'),
        'show_in_rest' => true, // Add this line to enable the block editor (Gutenberg).
    );

    register_post_type('car', $args);
}

add_action('init', 'custom_register_car_post_type');


function custom_register_bike_post_type()
{
    $labels = array(
        'name' => 'Bikes',
        'singular_name' => 'Bike',
        'menu_name' => 'Bikes',
        'add_new' => 'Add New Bike',
        'add_new_item' => 'Add New Bike',
        'edit_item' => 'Edit Bike',
        'new_item' => 'New Bike',
        'view_item' => 'View Bike',
        'search_items' => 'Search Bike',
        'not_found' => 'No Bike found',
        'not_found_in_trash' => 'No bikes found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'author'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-bike',
        'rewrite' => array('slug' => 'bike'),
        'show_in_rest' => true, // Add this line to enable the block editor (Gutenberg).
    );

    register_post_type('bike', $args);
}
add_action('init', 'custom_register_bike_post_type');

function print_time()
{
    return date('d-m-y', time());
}




// Add global options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Home Sidebar', // Change this to your desired page title
        'menu_title' => 'Home Sidebar', // Change this to your desired menu title
        'menu_slug'  => 'home_sidebar', // Change this to your desired menu slug
        'capability' => 'edit_posts', // Define the user capability required to access the options page
        'redirect'   => false, // Set this to false to prevent automatic redirection after saving
    ));
}

// Add global options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Banner & Header', // Change this to your desired page title
        'menu_title' => 'Banner & Header', // Change this to your desired menu title
        'menu_slug'  => 'banner_message', // Change this to your desired menu slug
        'capability' => 'edit_posts', // Define the user capability required to access the options page
        'redirect'   => false, // Set this to false to prevent automatic redirection after saving
    ));
}
