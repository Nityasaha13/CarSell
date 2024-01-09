<?php
//user signup handeler

add_action('wp_ajax_custom_signup', 'custom_signup_ajax');
add_action('wp_ajax_nopriv_custom_signup', 'custom_signup_ajax');

function custom_signup_ajax()
{       
    $formData = $_POST['formData'];
  
    // Verify nonce
    if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'custom_signup_nonce')) {
        die('Permission denied.');
    }
    // Retrieve and sanitize form data
    $first_name = sanitize_text_field($formData[0]['value']);
    $last_name = sanitize_text_field($formData[1]['value']);
    $phone = sanitize_text_field($formData[2]['value']);
    $address = sanitize_text_field($formData[3]['value']);  
    $email = sanitize_email($formData[4]['value']);
    $password = wp_hash_password($formData[5]['value']); 

    // Check if the user already exists by email
    if (email_exists($email)) {
        echo json_encode(array('status' => 'user_exists'));
    } else {
        // User doesn't exist, create a new user
        $user_id = wp_insert_user(array(
            'user_login'    => $email,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'user_email'    => $email,
            'user_pass'     => $password,
        ));

        // Check if a profile picture was uploaded
        if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] === 0) {
            $profile_picture = $_FILES['profile-picture'];

            // Get the current year and month
            $current_year = date('Y');
            $current_month = date('m');

            // Define the directory path for the current year and month
            $upload_path = wp_upload_dir();
            $upload_path = $upload_path['basedir'] . '/' . $current_year . '/' . $current_month . '/';

            // Create the directory if it doesn't exist
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $uploaded_file = $upload_path . basename($profile_picture['name']);

            if (move_uploaded_file($profile_picture['tmp_name'], $uploaded_file)) {
                $profile_picture_url = wp_upload_dir()['baseurl'] . '/' . $current_year . '/' . $current_month . '/' . $profile_picture['name'];
                update_user_meta($user_id, 'profile_picture', $profile_picture_url);
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error uploading the profile picture.'));
                wp_die();
            }
        }

        if (is_wp_error($user_id)) {
            echo json_encode(array('status' => 'error', 'message' => $user_id->get_error_message()));
        } else {
            // Now, update custom fields
            update_user_meta($user_id, 'phone_no', $phone);
            update_user_meta($user_id, 'address', $address);

            echo json_encode(array('status' => 'success'));
        }
    }

    wp_die(); // Always include this at the end of your AJAX function
}
