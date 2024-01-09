<?php
// Template Name: Single Bike
get_header();

$bike_details = get_field('bike_details');
$price = $bike_details['price'];
$sale_price = $bike_details['sale_price'];
$color = $bike_details['color'];
$oil_used = $bike_details['oil'];
$brand = $bike_details['brand'];
$model_year = $bike_details['model_year'];
$thumbnail = get_the_post_thumbnail($post, 'thumbnail');
$gallery = $bike_details['images'];
?>

<div id="primary" class="content-area">

    <div id="carouselExampleControls" class="carousel slide" data-interval="false" data-ride="carousel">
        <div class="carousel-inner">

            <?php
            if ($gallery) :
                foreach ($gallery as $key => $image) :
                    //$car_img = $image['image'];
            ?>
                    <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                        <img class="d-block w-100" src="<?php echo $image; ?>" alt="Bike Image">
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <!-- Carousel navigation controls -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h1><?php echo get_the_title(); ?></h1>

    <div class="gallery-img">
        <?php

        if ($gallery) :
            foreach ($gallery as $key => $image) :
                $bike_img = $image;
        ?>
                <img src="<?php echo $bike_img ?>" alt="" />
        <?php
            endforeach;
        endif;
        ?>
    </div>
    <p><?php echo get_the_excerpt(); ?></p>
    <br>
    <p><b>Price:</b> <?php echo $price; ?></p>
    <p><b>Sale Price:</b> <?php echo $sale_price; ?></p>
    <p><b>Color:</b> <?php echo $color; ?></p>
    <p><b>Oil Used:</b> <?php echo $oil_used; ?></p>
    <p><b>Brand:</b> <?php echo $brand; ?></p>
    <p><b>Model Year:</b> <?php echo $model_year; ?></p>
    <button class="chat-button">Chat</button>
    <button class="enquiry-button">Call</button>

    <div class="navigation">
        <?php previous_post_link('%link', '<button class="button" style="float:left">Previous</button>'); ?>
        <?php next_post_link('%link', '<button class="button" style="float:right">Next</button>'); ?>
    </div>

</div>
<?php get_footer(); ?>