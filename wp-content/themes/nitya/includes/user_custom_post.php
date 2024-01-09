<?php

add_action('wp_ajax_create_wordpress_custom_post', 'create_wordpress_custom_post');
add_action('wp_ajax_nopriv_create_wordpress_custom_post', 'create_wordpress_custom_post');

function create_wordpress_custom_post() {
    // Make sure this is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Include WordPress functions
        require_once('../../../wp-load.php');

        // Retrieve form data
        $formData = $_POST['formData'];

        // Parse the form data
        $post_data = array();
        $image_attachment_id = null; // Initialize image attachment ID

        foreach ($formData as $field) {
            $post_data[$field['name']] = $field['value'];

            // Check for the image field
            if ($field['name'] === 'images') {
                // Handle image upload and get attachment ID
                $image_attachment_id = handle_image_upload();
            }
        }

        // Create a new car post
        $car_post = array(
            'post_title'   => sanitize_text_field($post_data['title']),
            'post_content' => sanitize_text_field($post_data['description']),
            'post_status'  => 'publish',
            'post_type'    => 'car', // Your custom post type
        );

        $post_id = wp_insert_post($car_post);

        if (!is_wp_error($post_id)) {
            // Update standard custom fields
            update_post_meta($post_id, 'Price', sanitize_text_field($post_data['price']));
            update_post_meta($post_id, 'sale_price', sanitize_text_field($post_data['salePrice']));
            update_post_meta($post_id, 'oil', sanitize_text_field($post_data['oil']));
            update_post_meta($post_id, 'brand', sanitize_text_field($post_data['brand']));
            update_post_meta($post_id, 'model_year', sanitize_text_field($post_data['modelYear']));

            // Set the featured image if available
            if ($image_attachment_id) {
                set_post_thumbnail($post_id, $image_attachment_id);
            }

            echo 'success';
        } else {
            echo 'Error creating car post.';
        }

        exit;
    }
}

function handle_image_upload() {
    // Check if the file is selected for upload
    if (!empty($_FILES['images']['name'])) {
        // Handle image upload and return the attachment ID
        $file = $_FILES['images'];
        $attachment_id = media_handle_upload('images', 0);
        if (!is_wp_error($attachment_id)) {
            return $attachment_id;
        }
    }
    return null;
}
