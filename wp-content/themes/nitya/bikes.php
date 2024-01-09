<?php
/* Template Name: Bikes */
?>
<?php get_header(); ?>

<div id="primary" class="content-area">
    <h1 class="text-center">Find your Perfect Bike</h1>
    <div class="container">
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'bike',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'DSC',
            );

            $loop = new WP_Query($args);

            while ($loop->have_posts()) : $loop->the_post();

                $bike_details = get_field('bike_details');

                if (!empty($bike_details)) :
                    $price = $bike_details['price'];
                    $sale_price = $bike_details['sale_price'];
                    $color = $bike_details['color'];
                    $oil_used = $bike_details['oil'];
                    $brand = $bike_details['brand'];
                    $model_year = $bike_details['model_year'];
                    $thumbnail = get_the_post_thumbnail($post, 'thumbnail');
                    $gallery = $bike_details['images'];

            ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="<?php the_permalink(); ?>">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="car-thumbnail"><?php echo $thumbnail; ?></div>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                    <h6><b>Price:</b> <?php echo $price; ?></h6>
                                    <h6><b>Sale Price: </b><?php echo $sale_price; ?></h6>
                                    <h6><b>Brand:</b> <?php echo $brand; ?></h6>
                                    <h6><b>Model Year:</b> <?php echo $model_year; ?></h6>
                                    <button class="chat-button">Chat</button>
                                    <button class="enquiry-button">Call</button>
                                </div>
                            </div>
                    </div>

            <?php
                endif;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>