<?php
/*
Template Name: User Dashboard
*/

get_header();

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $profile_picture = get_user_meta($current_user->ID, 'profile_picture', true);

    // Include the necessary WordPress media functions
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // Handle form submission to update user profile
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
        $full_name = sanitize_text_field($_POST['full_name']);
        $phone_no = sanitize_text_field($_POST['phone_no']);
        $address = sanitize_text_field($_POST['address']);

        // Update user profile data
        wp_update_user(array(
            'ID' => $current_user->ID, 
            'display_name' => $full_name,
        ));
        update_user_meta($current_user->ID, 'phone_no', $phone_no);
        update_user_meta($current_user->ID, 'address', $address);

        // Handle profile picture upload
        if (!empty($_FILES['profile_picture']['name'])) {
            $profile_picture = media_handle_upload('profile_picture', 0);
            if (!is_wp_error($profile_picture)) {
                update_user_meta($current_user->ID, 'profile_picture', wp_get_attachment_url($profile_picture));
            }
        }
        // Add an HTML meta refresh tag to reload the page after a successful update
        echo '<meta http-equiv="refresh" content="0;url=' . esc_url($_SERVER['REQUEST_URI']) . '">';
    }
?>

    <div class="container">
        <div class="heading">
            <h1>User Dashboard</h1>
        </div>

        <div class="profile">
            <div class="profile-circle">
                <img src="<?php echo esc_url($profile_picture); ?>" alt="Profile Picture" />
            </div>
        </div>

        <div class="user-info">
            <h2>Full Name: <?php echo esc_html($current_user->display_name); ?></h2>
            <h2>Username: <?php echo esc_html($current_user->user_login); ?></h2>
            <h2>Email: <?php echo esc_html($current_user->user_email); ?></h2>
            <h2>Phone No: <?php echo $current_user->phone_no ?></h2>
            <h2>Your Address: <?php echo $current_user->address ?></h2>
            <button class="edit-profile-btn">Edit Profile</button>
            <form method="post" enctype="multipart/form-data" class="profile-form">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo esc_attr($current_user->display_name); ?>" required>
                <label for="phone_no">Phone No:</label>
                <input type="text" name="phone_no" id="phone_no" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'phone_no', true)); ?>">
                <label for="address">Your Address:</label>
                <input type="text" name="address" id="address" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'address', true)); ?>">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture">
                <input type="submit" id="update_profile" name="update_profile" value="Update Profile">
                <input type="submit" id="cancel_update" name="cancel_update" value="Cancel">
            </form>
            <a class="logout-btn" id="edit-password" href="<?php echo esc_url(wp_lostpassword_url()); ?>">Reset Password</a>
            <a class="logout-btn" href="<?php echo esc_url(wp_logout_url(home_url('/login/'))); ?>">Log Out</a>
        </div>

        <hr>

        <div class="listings">
            <b>Your Listed Items-</b>
            <button class="post-btn" id="custom-post-button">+ Post Car</button>
            <div class="row">
                <div class="col-md-8">
                    <div class="posts">
                        <?php
                        $current_user_id = get_current_user_id();

                        // Create a custom query to get posts by the current user
                        $args = array(
                            'post_type' => 'car',       // Your custom post type
                            'author'    => $current_user_id,
                        );
                        $query = new WP_Query($args);

                        while ($query->have_posts()) : $query->the_post();

                            $car_details = get_field('car_details');

                            if (!empty($car_details)) :
                                $price = $car_details['Price'];
                                $sale_price = $car_details['sale_price'];
                                $color = $car_details['color'];
                                $oil_used = $car_details['oil'];
                                $brand = $car_details['brand'];
                                $model_year = $car_details['model_year'];
                                $thumbnail = get_the_post_thumbnail($post, 'thumbnail');
                                $images = $car_details['images'];
                        ?>

                                <a href="<?php the_permalink(); ?>">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3><?php the_title(); ?>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="car-thumbnail"><?php echo $thumbnail; ?></div>
                                            <p><?php echo get_the_excerpt(); ?></p>
                                            <h6><b>Price:</b><?php echo $price; ?></h6>
                                            <h6><b>Sale Price: </b><?php echo $sale_price; ?></h6>
                                            <h6><b>Oil Used:</b> <?php echo $oil_used; ?></h6>
                                            <h6><b>Brand: </b><?php echo $brand; ?></h6>
                                            <h6><b>Model Year:</b> <?php echo $model_year; ?></h6>
                                            <div class="gallery-img">
                                                <?php
                                                if ($images) :
                                                    foreach ($images as $key => $image) :
                                                        $car_img = $image['image'];
                                                ?>
                                                        <img src="<?php echo $car_img ?>" alt="" />
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            endif;
                        endwhile;

                        wp_reset_postdata();
                        ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-sidebar-area">
                        <form id="custom-post-form" action="" method="post" enctype="multipart/form-data" style="display: none;">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" required>

                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>

                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" required>

                            <label for="salePrice">Sale Price:</label>
                            <input type="number" id="salePrice" name="salePrice" >

                            <label for="oil">Oil:</label>
                            <input type="text" id="oil" name="oil" required>

                            <label for="brand">Brand:</label>
                            <input type="text" id="brand" name="brand" required>

                            <label for="modelYear">Model Year:</label>
                            <input type="number" id="modelYear" name="modelYear" min="1900" max="2099" required>

                            <label for="images">Upload Thumbnail:</label>
                            <input type="file" id="images" name="images"><br>
                            <div id="message"></div>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editProfileButton = document.querySelector('.edit-profile-btn');
            const cancelProfileButton = document.querySelector('.cancel_update');
            const profileForm = document.querySelector('.profile-form');

            editProfileButton.addEventListener('click', function() {
                profileForm.classList.toggle('visible');
                this.style.display = 'none';
            });
            cancelProfileButton.addEventListener('click', function() {
                profileForm.classList.toggle('hide');
            });
        });
    </script>

<?php

}

get_footer();
