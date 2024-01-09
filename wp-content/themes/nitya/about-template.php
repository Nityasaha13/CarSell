<?php
/* Template Name: About Template */
get_header();
?>
<div id="primary" class="content-area">
    <div class="about-newzimo">
        <div class="container">
            <p>Founded in 2015, CARS24 is a leading AutoTech company streamlining and revolutionising the sale, purchase, and financing of pre-owned cars in India, Australia, Thailand, and UAE. Leveraging a Smart AI Pricing Engine, and 140 quality checks, selling and buying pre-owned vehicles is seamless and transparent with CARS24.
                <br>
                <br>Ensuring complete transparency and faster lending processes, CARS24 Financial Services Private Limited, a professionally managed Non-Banking Financial Company (NBFC) registered with the Reserve Bank of India, offers customers focused value added services.
            </p>
        </div>
    </div>
    <div class="container">
        <div id="primary" class="contact-section">
            <div class="column">
                <h1>Contact Us</h1>
                <?php
                // Check if the plugin function exists
                if (function_exists('appycodes_leads_display_form')) {
                    appycodes_leads_display_form();
                }
                ?>
            </div>
            <div class="column">
                <h1>Our Location</h1>
                <div id="map" style="height: 260px;"></div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>