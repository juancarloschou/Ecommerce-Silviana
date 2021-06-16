<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Style Outlet
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'style-outlet' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if( is_active_sidebar('top-left')  || is_active_sidebar('top-right') ) :?>
			<div class="top-nav">
				<div class="container">		
					<div class="eight columns">
						<div class="cart-left">
							<?php dynamic_sidebar('top-left'); ?>
						</div>
					</div>

					<div class="eight columns">
						<div class="cart-right">
							<?php dynamic_sidebar('top-right'); ?>  
						</div>
					</div>

				</div>
			</div> <!-- .top-nav -->
		<?php endif;?>

		<div class="branding header-image"> 
			<div class="container">
				<div class="seven columns">
					<div class="site-branding">
						<?php 
							$logo_title = get_theme_mod( 'logo_title' );   
							$tagline = get_theme_mod( 'tagline',true);
							if( $logo_title && function_exists( 'the_custom_logo' ) ) :
	                               the_custom_logo();     
	                        else : ?>
								<h1 class="site-title"><a style="color: #<?php header_textcolor(); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php endif; ?>
						<?php if( $tagline ) : ?>
							<p class="site-description" style="color: #<?php header_textcolor(); ?>"><?php bloginfo( 'description' ); ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->
				</div>
				<div class="six columns header-search-box">
					<?php get_search_form(); ?>
				</div>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<div class="three columns add-to-cart">
						<div class="cart-item">
							<?php global $woocommerce; ?>
							<i class="fa fa-shopping-cart"></i>
							 <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'style-outlet'); ?>">
							 <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'style-outlet'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
							</a>	
						</div>
					</div>
				<?php endif;?>
			</div>
			<div class="nav-wrap">
				<div class="container">
					<nav id="site-navigation" class="main-navigation sixteen columns" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-align-justify fa-2x" aria-hidden="true"></i></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>  
	</header><!-- #masthead -->

 
<?php  if( is_front_page() && !is_home() ) { 
     do_action( 'style_outlet_action_before_content' );
}     

