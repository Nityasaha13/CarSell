<?php
/* Template Name: Home Page */
?>
<?php get_header();
$sidebar_message = get_field('home_sidebar', 'option');
$side_poster = get_field('poster', 'option');
$home_banner = get_field('home_page_banner', 'option');
$banner_text = get_field('banner_text', 'option');
?>

<div id="primary" class="content-area">
    <div class="home-banner">
        <div class="banner-image">
            <img src="<?php echo esc_url($home_banner); ?>">
        </div>
        <div class="ast-container">
            <div class="banner-text">
                <?php echo $banner_text ?>
            </div>
        </div>
    </div>

    <div class="ast-container">
        <div class="row">
            <div class="col-md-4">
                <div class="sticky-sidebar">
                    <h1 id="sidebar-content">Don't Miss it!</h1>
                    <p id="sidebar-content"><?php echo $sidebar_message; ?></p>
                    <img id="sidebar-content" src="<?php echo esc_url($side_poster); ?>">
                </div>
            </div>
            <div class="col-md-8">

                <?php
                $args = array(
                    'post_type' => 'car',
                    'post_status' => 'publish',
                    'posts_per_page' => 5,
                    'orderby' => 'title',
                    'order' => 'DSC',
                );

                $loop = new WP_Query($args);

                while ($loop->have_posts()) : $loop->the_post();

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
    </div>

</div>


<?php get_footer(); ?>