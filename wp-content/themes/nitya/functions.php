<?php

/**
 * Nitya Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nitya
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_NITYA_VERSION', time());

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), CHILD_THEME_NITYA_VERSION, 'all');
	wp_enqueue_style('nitya-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
	wp_enqueue_script('header', get_stylesheet_directory_uri() . '/assets/js/header.js', array(), CHILD_THEME_NITYA_VERSION, true);
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');

	wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', array(), '1.12.9', true);
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', array(), '4.0.0', true);

	wp_enqueue_script('about-page', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', array(), CHILD_THEME_NITYA_VERSION, true);

	wp_enqueue_style('global', get_stylesheet_directory_uri() . '/assets/css/global.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
	wp_enqueue_style('header-css', get_stylesheet_directory_uri() . '/assets/css/header.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
	wp_enqueue_style('footer-css', get_stylesheet_directory_uri() . '/assets/css/footer.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');

	if (is_front_page()) {
		wp_enqueue_style('home', get_stylesheet_directory_uri() . '/assets/css/home.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
	}

	if (is_page('10')) {
		wp_enqueue_script('form-js', get_stylesheet_directory_uri() . '/assets/js/form.js', array('jquery'), CHILD_THEME_NITYA_VERSION, 'true');
		wp_enqueue_style('about-page-style', get_stylesheet_directory_uri() . '/assets/css/about.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		wp_enqueue_script('google-map-page', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAOVYRIgupAurZup5y1PRh8Ismb1A3lLao&libraries=places&callback=initMap', array(), CHILD_THEME_NITYA_VERSION, 'true');
	}
	wp_localize_script('jquery', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	if (is_page('77')) {
		wp_enqueue_style('car-style', get_stylesheet_directory_uri() . '/assets/css/car.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		//wp_enqueue_script('about-page',get_stylesheet_directory_uri() . '/assets/js/about.js', array(),CHILD_THEME_NITYA_VERSION,'true');
	}
	if (is_page('136')) {
		wp_enqueue_style('car-style', get_stylesheet_directory_uri() . '/assets/css/car.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		//wp_enqueue_script('about-page',get_stylesheet_directory_uri() . '/assets/js/about.js', array(),CHILD_THEME_NITYA_VERSION,'true');
	}
	if (is_singular('car')) {
		wp_enqueue_style('single-car-style', get_stylesheet_directory_uri() . '/assets/css/single-car.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		wp_enqueue_script('carousel-effect', get_stylesheet_directory_uri() . '/assets/js/carousel.js', array(), CHILD_THEME_NITYA_VERSION, 'true');
	}
	if (is_singular('bike')) {
		wp_enqueue_style('single-bike-style', get_stylesheet_directory_uri() . '/assets/css/single-bike.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		wp_enqueue_script('carousel-effect', get_stylesheet_directory_uri() . '/assets/js/carousel.js', array(), CHILD_THEME_NITYA_VERSION, 'true');
	}
	if (is_page('182')) {
		wp_enqueue_style('login-form', get_stylesheet_directory_uri() . '/assets/css/login_form.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		wp_enqueue_script('login-form', get_stylesheet_directory_uri() . '/assets/js/login_handler.js', array(), CHILD_THEME_NITYA_VERSION, 'true');
		wp_enqueue_script('jquery-login', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), CHILD_THEME_NITYA_VERSION, 'all');
	}
	if (is_page('186')) {	
		wp_enqueue_script('signup-form', get_stylesheet_directory_uri() . '/assets/js/signup_handler.js', array(), CHILD_THEME_NITYA_VERSION, 'true');
		wp_enqueue_style('signup-form', get_stylesheet_directory_uri() . '/assets/css/signup_form.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
	}
	if (is_page('190')) {
		wp_enqueue_style('user-dashboard', get_stylesheet_directory_uri() . '/assets/css/user_dashboard.css', array('astra-theme-css'), CHILD_THEME_NITYA_VERSION, 'all');
		wp_enqueue_script('custom-post-form', get_stylesheet_directory_uri() . '/assets/js/user_dashboard.js', array(), CHILD_THEME_NITYA_VERSION, 'true');
	}
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

add_filter('use_block_editor_for_post', '__return_false', 5);

require_once('includes/custom_functions.php');
require_once('includes/login-handler.php');
require_once('includes/signup_handler.php');
require_once('includes/user_custom_post.php');

add_action('admin_enqueue_scripts', function () {
	wp_localize_script('jquery', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	wp_enqueue_script('form-js', get_stylesheet_directory_uri() . '/assets/js/form.js', array('jquery'), CHILD_THEME_NITYA_VERSION, 'true');
	//wp_enqueue_style( 'switch_wp_admin_css', get_template_directory_uri() . '/assets/css/switch.css', false, '1.0.0' );

});

// Add extra fields to user profile

function custom_register_user_meta_fields()
{
	register_meta('user', 'phone_no', array(
		'type' => 'string',
		'description' => 'Phone Number',
		'single' => true,
		'show_in_rest' => true, // Allow REST API access
	));

	register_meta('user', 'address', array(
		'type' => 'string',
		'description' => 'Address',
		'single' => true,
		'show_in_rest' => true,
	));

	// Add more custom user meta fields as needed
}
add_action('init', 'custom_register_user_meta_fields');

// Add extra fields to user profile
function custom_save_user_profile_fields($user_id)
{
	if (current_user_can('edit_user', $user_id)) {
		update_user_meta($user_id, 'phone_no', sanitize_text_field($_POST['phone_no']));
		update_user_meta($user_id, 'address', sanitize_text_field($_POST['address']));
	}
}
add_action('personal_options_update', 'custom_save_user_profile_fields');
add_action('edit_user_profile_update', 'custom_save_user_profile_fields');

function custom_show_user_profile_fields($user){

?>
	<h3>Custom User Fields</h3>
	<table class="form-table">
		<tr>
			<th><label for="phone_no">Phone Number</label></th>
			<td>
				<input type="text" name="phone_no" id="phone_no" value="<?php echo esc_attr(get_the_author_meta('phone_no', $user->ID)); ?>" class="regular-text" /><br />
				<span class="description">Please enter your phone number.</span>
			</td>
		</tr>
		<tr>
			<th><label for="address">Address</label></th>
			<td>
				<input type="text" name="address" id="address" value="<?php echo esc_attr(get_the_author_meta('address', $user->ID)); ?>" class="regular-text" /><br />
				<span class="description">Please enter your address.</span>
			</td>
		</tr>
	
	</table>
<?php
}
add_action('show_user_profile', 'custom_show_user_profile_fields');
add_action('edit_user_profile', 'custom_show_user_profile_fields');

function custom_default_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $user = false;
    
    if (is_numeric($id_or_email)) {
        $id = (int)$id_or_email;
        $user = get_user_by('id', $id);
    } elseif ($id_or_email instanceof WP_User) {
        $user = $id_or_email;
    } elseif (is_string($id_or_email) && is_email($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    }
    
    if ($user && $custom_profile_picture = get_user_meta($user->ID, 'profile_picture', true)) {
        // Use the custom profile picture if available
        return '<img src="' . esc_url($custom_profile_picture) . '" alt="' . esc_attr($alt) . '" class="avatar avatar-' . esc_attr($size) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" />';
    }
    
    // If no custom profile picture is available, use the default avatar
    return $avatar;
}

add_filter('get_avatar', 'custom_default_avatar', 10, 5);

// Custom logout function from User Dashboard
function custom_logout() {
	
    wp_logout();
    
    exit;
}