<?php
/**
 * The general template for displaying WooCommerce sections
 *
 * This is the "no sidebars" version. To use it, delete (or rename) 
 * the existing woocommerce.php and rename this file to woocommerce.php
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 1.1
 */
get_header();
if ($nirvanas['nirvana_frontpage']=="Enable" && is_front_page() && 'posts' == get_option( 'show_on_front' )): get_template_part( 'frontpage' );
else :
?>
		<section id="container" class="one-column">

			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>

				<?php woocommerce_content(); ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
			<?php  ?>
		</section><!-- #container -->


<?php
endif;
get_footer();