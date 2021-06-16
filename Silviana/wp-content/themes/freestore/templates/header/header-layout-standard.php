<?php
/**
 * @package FreeStore
 */
global $woocommerce; ?>

<header id="masthead" class="site-header">
	
	<?php if ( ! get_theme_mod( 'freestore-header-remove-topbar' ) ) : ?>
	<div class="site-header-topbar">
		<div class="site-container">
			
			<div class="site-topbar-left">
				<?php wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
				
				<?php if ( !get_theme_mod( 'freestore-header-remove-add' ) ) : ?>
                	<span class="site-topbar-left-ad"><i class="fa fa-map-marker"></i> <?php echo wp_kses_post( get_theme_mod( 'freestore-website-site-add', 'Cape Town, South Africa' ) ) ?></span>
                <?php endif; ?>
			</div>
			
			<div class="site-topbar-right">
				<?php if ( !get_theme_mod( 'freestore-header-remove-no' ) ) : ?>
                	<span class="site-topbar-right-no"><i class="fa fa-phone"></i> <?php echo wp_kses_post( get_theme_mod( 'freestore-website-head-no', 'Call Us: +2782 444 YEAH' ) ) ?></span>
				<?php endif; ?>
				
				<?php if ( !get_theme_mod( 'freestore-header-hide-social' ) ) : ?>
					<?php get_template_part( '/templates/social-links' ); ?>
				<?php endif; ?>
			</div>
			
			<div class="clearboth"></div>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="site-container">
		
		<?php if ( !get_theme_mod( 'freestore-header-search' ) ) : ?>
		    <div class="search-block">
		        <?php get_search_form(); ?>
		    </div>
		<?php endif; ?>
		
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
		    <?php else : ?>
		        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		    <?php endif; ?>
		</div><!-- .site-branding -->
		
		<?php if ( !get_theme_mod( 'freestore-header-search' ) ) : ?>
			<div class="menu-search">
		    	<i class="fa fa-search search-btn"></i>
		    </div>
		<?php endif; ?>
		
		<?php if ( freestore_is_woocommerce_activated() ) : ?>
			<?php if ( !get_theme_mod( 'freestore-header-remove-cart' ) ) : ?>
				<div class="header-cart">
					
	                <a class="header-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'freestore' ); ?>">
	                    <span class="header-cart-amount">
	                        <?php echo sprintf( _n( '(%d)', '(%d)', $woocommerce->cart->cart_contents_count, 'freestore' ), $woocommerce->cart->cart_contents_count); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
	                    </span>
	                    <span class="header-cart-checkout <?php echo ( $woocommerce->cart->cart_contents_count > 0 ) ? sanitize_html_class( 'cart-has-items' ) : ''; ?>">
	                        <i class="fa fa-shopping-cart"></i>
	                    </span>
	                </a>
					
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation <?php echo ( get_theme_mod( 'freestore-nav-styling' ) ) ? sanitize_html_class( get_theme_mod( 'freestore-nav-styling' ) ) : sanitize_html_class( 'freestore-nav-underline' ); ?>" role="navigation">
			<span class="header-menu-button"><i class="fa fa-bars"></i><span><?php echo esc_attr( get_theme_mod( 'freestore-header-menu-text', 'menu' ) ); ?></span></span>
			<div id="main-menu" class="main-menu-container">
				<div class="main-menu-close"><i class="fa fa-angle-right"></i><i class="fa fa-angle-left"></i></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
		
		<div class="clearboth"></div>
	</div>
		
</header><!-- #masthead -->