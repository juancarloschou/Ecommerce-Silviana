<?php
/**
 * The front page template file.
 *
 *
 * @package Style Outlet
 */
 
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	get_template_part('index');  
} else {

get_header();   
  

/*if ( class_exists( 'WooCommerce' ) ) {
	$shop_page_id = get_option('woocommerce_shop_page_id');
	$frontpage_id = get_option( 'page_on_front' ); 

	if( !$shop_page_id  && $frontpage_id ) {
		update_option('woocommerce_shop_page_id', $frontpage_id );
	}  
}else { ?>
	<div id="content" class="site-content">
		<div class="container">
			<main id="main" class="site-main" role="main"><?php
				while ( have_posts() ) : the_post();       
					the_content();
				endwhile; ?>
		    </main><!-- #main -->
	    </div><!-- #primary -->
	</div><?php  
} */ 

	if ( ! class_exists( 'WooCommerce' ) ) { ?>
		<div id="content" class="site-content">
			<div class="container">  
				<main id="main" class="site-main" role="main"><?php
					while ( have_posts() ) : the_post();       
						the_content();
					endwhile; ?>
			    </main><!-- #main -->
		    </div><!-- #primary -->
		</div><?php  
	}

get_footer();

}
