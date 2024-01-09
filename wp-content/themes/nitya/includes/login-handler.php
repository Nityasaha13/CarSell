<?php

function custom_login_ajax() {
    //check_ajax_referer('custom-login-nonce', 'security');

    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    // Attempt to authenticate the user
    $user = wp_authenticate($email, $password);
 
    if (is_wp_error($user)) {
        // Authentication failed
        $error_message = $user->get_error_message();
        echo 'error'; // Return an 'error' response
    } else {
        // Authentication successful
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login);

        // Provide a success message to JavaScript
        echo 'success';
 
    }

    // Always exit, even if there's an error
    wp_die();
}

add_action('wp_ajax_custom_login_ajax', 'custom_login_ajax');
add_action('wp_ajax_nopriv_custom_login_ajax', 'custom_login_ajax');
