<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FreeStore
 */
global $woocommerce;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site <?php echo sanitize_html_class( get_theme_mod( 'freestore-slider-type' ) ); ?>">
	
<?php echo ( get_theme_mod( 'freestore-site-layout' ) == 'freestore-site-boxed' ) ? '<div class="site-boxed">' : ''; ?>
	
	<?php get_template_part( '/templates/header/header-layout-standard' ); ?>
	
	<?php if ( is_front_page() ) : ?>
		
		<?php get_template_part( '/templates/slider/homepage-slider' ); ?>
		
	<?php endif; ?>
	
	<?php if ( !is_front_page() && get_theme_mod( 'freestore-page-fimage-layout' ) == 'freestore-page-fimage-layout-banner' ) : ?>
		
		<?php get_template_part( '/templates/page-banner' ); ?>
	
	<?php endif; ?>

	<div class="site-container <?php echo ( ! is_active_sidebar( 'sidebar-1' ) ) ? sanitize_html_class( 'content-no-sidebar' ) : sanitize_html_class( 'content-has-sidebar' ); ?> <?php echo ( get_theme_mod( 'freestore-woocommerce-custom-cols' ) ) ? sanitize_html_class( 'freestore-woocommerce-cols-' . get_theme_mod( 'freestore-woocommerce-custom-cols' ) ) : 'freestore-woocommerce-cols-4'; ?> <?php echo ( get_theme_mod( 'freestore-remove-product-border' ) ) ? sanitize_html_class( 'freestore-products-noborder' ) : ''; ?>">
