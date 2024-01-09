<?php
/* Template Name: Cars */
?>
<?php get_header(); ?>

<div id="primary" class="content-area">
    <h1 class="text-center">Find your Perfect Car</h1>
    <div class="container">
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'car',
                'post_status' => 'publish',
                'posts_per_page' => -1,
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
                    <div class="col-lg-4 col-md-6 mb-4">
                    
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
                                <h6><b>Sale Price:</b> <?php echo $sale_price; ?></h6>
                                <h6><b>Brand: </b><?php echo $brand; ?></h6>
                                <h6><b>Model Year: </b><?php echo $model_year; ?></h6>
                                <a href="<?php the_permalink(); ?>">
                                <button class="chat-button">Chat</button>      
                                <button class="enquiry-button">Call</button>                 
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

<?php get_footer(); ?>