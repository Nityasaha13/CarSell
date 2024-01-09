<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->

<?php
	if(!is_page('190')):
?>

<footer class="myFooter">
	<div class="footer-column">
		<p><strong> ABOUT US </strong></p>
		<p>Buy and Sell Cars</p>
		<p>Buy and Sell Bikes</p>
		<p>Buy and Buy Cars/Bikes</p>
	</div>
	<div class="footer-column">
		<p><strong> EXTERNAL LINKS </strong></p>
		<p>Resources</p>
		<p>Career</p>
		<p>Enquiry</p>
	</div>
	<div class="footer-column">
		<p><strong> EXTRA </strong></p>
		<p>CEO</p>
		<p>Company</p>
		<p>Team</p>
		<p>Create Account</p>
	</div>
</footer>

<?php
endif;

astra_content_after();

astra_footer_before();
?>


<!-- Remove the container if you want to extend the Footer to full width. -->

<?php

astra_footer();

astra_footer_after();
?>

</div><!-- #page -->

<?php
astra_body_bottom();
wp_footer();
?>
</body>

</html>