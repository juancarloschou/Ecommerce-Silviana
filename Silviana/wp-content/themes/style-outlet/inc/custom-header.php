<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package style outlet
 */
 
/**
 * Setup the WordPress core custom header feature.
 *
 * @uses style_outlet_header_style()  
 * @uses style_outlet_admin_header_style() 
 * @uses style_outlet_admin_header_image()   
 *
 * @package style outlet
 */
function style_outlet_custom_header_setup() { 
	add_theme_support( 'custom-header', apply_filters( 'style_outlet_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff', 
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true, 
		'wp-head-callback'       => 'style_outlet_header_style'
	) ) );
}

add_action( 'after_setup_theme', 'style_outlet_custom_header_setup' );



if ( ! function_exists( 'style_outlet_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see style_outlet_custom_header_setup().  
 */
function style_outlet_header_style() {
	if ( get_header_image() ) {
	?>
	<style type="text/css">    
		.header-image {
			background-image: url(<?php echo esc_url(get_header_image()); ?>);
			display: block;
		}
  
	</style>
	<?php
	}
}
endif; // style_outlet_header_style

