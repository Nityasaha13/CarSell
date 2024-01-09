<?php
/* Template Name: SignUp Page */

get_header();
?>

<div class="container">
    <h1>Sign Up</h1>
    <form id="signup-form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" required>
        </div>
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone No:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="profile-picture">Profile Picture:</label>
            <input type="file" id="profile-picture" name="profile-picture" accept="image/*">
        </div>
        <div class="btn-container">
            <input type="submit" class="btn" value="Sign Up">
        </div>
        <input type="hidden" name="security" value="<?php echo esc_attr(wp_create_nonce('custom_signup_nonce')); ?>" />
        <div id="message" style="display: none;"></div>
    </form>

    <div class="switch-form">
        Already have an account? <a href="http://nityasite.test/login/">Login</a>
    </div>
</div>

<?php

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Retrieve and sanitize form data
//     $first_name = sanitize_text_field($_POST["first-name"]);
//     $last_name = sanitize_text_field($_POST["last-name"]);
//     $phone = sanitize_text_field($_POST["phone"]);
//     $address = sanitize_text_field($_POST['address']);
//     $email = sanitize_email($_POST["email"]);
//     $password = $_POST["password"]; // Note: You should securely hash this password before storing it.

//     // Check if the user already exists by email
//     if (email_exists($email)) {
//         echo "User with this email already exists.";
//     } else {
//         // User doesn't exist, create a new user
//         $user_id = wp_insert_user(array(
//             'user_login'    => $email,
//             'first_name'    => $first_name,
//             'last_name'     => $last_name,
//             'user_email'    => $email,
//             'user_pass'     => $password,
//         ));

//         // Check if a profile picture was uploaded
//         if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] === 0) {
//             $profile_picture = $_FILES['profile-picture'];

//             // Get the current year and month
//             $current_year = date('Y');
//             $current_month = date('m');

//             // Define the directory path for the current year and month
//             $upload_path = wp_upload_dir();
//             $upload_path = $upload_path['basedir'] . '/' . $current_year . '/' . $current_month . '/';

//             // Create the directory if it doesn't exist
//             if (!file_exists($upload_path)) {
//                 mkdir($upload_path, 0755, true);
//             }

//             $uploaded_file = $upload_path . basename($profile_picture['name']);

//             if (move_uploaded_file($profile_picture['tmp_name'], $uploaded_file)) {
//                 $profile_picture_url = wp_upload_dir()['baseurl'] . '/' . $current_year . '/' . $current_month . '/' . $profile_picture['name'];
//             }
//         }


//         if (is_wp_error($user_id)) {
//             echo "Error: " . $user_id->get_error_message();
//         } else {

//             // Now, update custom fields
//             update_user_meta($user_id, 'phone_no', $phone);
//             update_user_meta($user_id, 'address', $address);

//             if (!empty($profile_picture_url)) {
//                 update_user_meta($user_id, 'profile_picture', $profile_picture_url);
//             }

//             echo "Signup successfully!";
//         }
//     }
// }


get_footer();
