<?php
/**
 * The general template for displaying WooCommerce sections
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 1.1
 */
get_header();
if ($nirvanas['nirvana_frontpage=="Enable"'] && is_front_page() && 'posts' == get_option( 'show_on_front' )): get_template_part( 'frontpage' );
else :
?>
		<section id="container" class="<?php echo nirvana_get_layout_class(); ?>">

			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>

				<?php woocommerce_content(); ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
			<?php nirvana_get_sidebar(); ?>
		</section><!-- #container -->


<?php
endif;
get_footer();