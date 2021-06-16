<?php

/**
 * Style Outlet functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Style Outlet
 */

if ( ! function_exists( 'style_outlet_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function style_outlet_setup() {
	/* 
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on style_outlet, use a find and replace
	 * to change 'style-outlet' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'style-outlet', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'style-outlet' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'style_outlet_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	
	add_image_size( 'style_outlet_service_img', 200,250, true );
	add_image_size( 'style_outlet_blog_full_width', 380,350, true );
	add_image_size( 'style_outlet_small_featured_image_width', 450,300, true );
	add_image_size( 'style_outlet_blog_large_width', 800,300, true );  

	/* Woocommerce support */
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' ); 

    /* 
	* Custom Logo 
	*/
	add_theme_support( 'custom-logo' );

    // Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
		
			'top-left' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'text' , 
		        	// Widget $instance -> settings 
					array(
					  'text'  => '<ul><li><a href="#"><i class="fa fa-envelope"></i>Email:info@gmail.com</a></li></ul>'
					)
				)
			),

			// Put two core-defined widgets in the footer 2 area.
			'top-right' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'text' , 
		        	// Widget $instance -> settings 
					array(
					  'text'  => '<ul><li><a href="#">Login / Register</a></li><li><a href="#">Cart</a></li><li><a href="#">My Account</a></li></ul>'
					)
				),
			),

			'footer' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'text' , 
		        	// Widget $instance -> settings 
					array(
					  'title' => __('About Theme','style-outlet'),
					  'text'  => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.','style-outlet'),
					),
				)
			),
			'footer-2' => array(
				// Widget ID
			    'archives',
			),
			'footer-3' => array(
				// Widget ID
			    'categories'
			),

			'footer-4' => array(
				'recent-posts',
			),

			'footer-nav' => array(
				// Widget ID
			    'my_text' => array(
					// Widget $id -> set when creating a Widget Class
		        	'text' , 
		        	// Widget $instance -> settings 
					array(
					  'text'  => '<ul><li><a href="#"><i class="fa fa-facebook"></i></a></li><li><a href="#"><i class="fa fa-twitter"></i></a></li><li><a href="#"><i class="fa fa-pinterest"></i></a></li></ul>'
					)
				)
			),

		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home' => array(
				'post_type' => 'page',
			),
			'blog' => array(
				'post_type' => 'page',
			),
			'post-one' => array(
	            'post_type' => 'post',
	            'post_title' => __( 'Post One', 'style-outlet'),
	            'post_content' => __( '<h3>We are starting our business</h3><h1>Realize your goal Here</h1><a href="#">GET THE THEME</a>', 'style-outlet'),
	            'thumbnail' => '{{post-featured-image}}',
	        ),
	        'post-two' => array(
	            'post_type' => 'post',
	            'post_title' => __( 'Post Two', 'style-outlet'),
	            'post_content' => __( '<h3>We are starting our business</h3><h1>Realize your goal Here</h1><a href="#">GET THE THEME</a>', 'style-outlet'),
	            'thumbnail' => '{{post-featured-image}}',
	        ), 
			'service-one' => array(  
				'post_type' => 'page',
				'post_title' => __( 'For Men', 'style-outlet'),
	            'post_content' => __( 'Collection<br><a href="#">Up-to 50 Off </a>', 'style-outlet'),
				'thumbnail' => '{{page-images}}',
			),
			'service-two' => array(
				'post_type' => 'page',
				'post_title' => __( 'For Child', 'style-outlet'),
	            'post_content' => __( 'Collection<br><a href="#">Up-to 50 Off </a>', 'style-outlet'),
				'thumbnail' => '{{page-images}}',
			),
			'service-three' => array(
				'post_type' => 'page',
				'post_title' => __( 'For Women', 'style-outlet'),
	            'post_content' => __( 'Collection<br><a href="#">Up-to 50 Off </a>', 'style-outlet'),
				'thumbnail' => '{{page-images}}',
			),
			
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'post-featured-image' => array( 
				'post_title' => __( 'slider one', 'style-outlet' ),
				'file' => 'images/slider.png', // URL relative to the template directory.
			),
			'page-images' => array(
				'post_title' => __( 'Page Images', 'style-outlet' ),
				'file' => 'images/page.png', // URL relative to the template directory.
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),  

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array( 
			'slider_cat' => '1', 
			'service-1' => '{{service-one}}',
			'service-2' => '{{service-two}}',
			'service-3' => '{{service-three}}',
			'enable_service_section' => true
		),

	);

	$starter_content = apply_filters( 'style_outlet_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

}
endif;
add_action( 'after_setup_theme', 'style_outlet_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function style_outlet_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'style_outlet_content_width', 640 );
}
add_action( 'after_setup_theme', 'style_outlet_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function style_outlet_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'style-outlet' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Top Left', 'style-outlet' ),
		'id'            => 'top-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Top Right', 'style-outlet' ),
		'id'            => 'top-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebars( 4, array(
		'name'          => __( 'Footer %d', 'style-outlet' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
 
	register_sidebar( array(
		'name'          => __( 'Footer Nav', 'style-outlet' ),
		'id'            => 'footer-nav',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'style_outlet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load Theme Options Panel
 */
require get_template_directory() . '/inc/theme-options.php';


/**
 * Load TGM plugin 
 */
require get_template_directory() . '/admin/class-tgm-plugin-activation.php';


add_filter('add_to_cart_fragments', 'style_outlet_header_add_to_cart_fragment');
function style_outlet_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce; 
    ob_start(); ?>

    <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'style-outlet'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'style-outlet'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

    <?php $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments; 

}

/* Woocommerce support */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
add_action('woocommerce_before_main_content', 'style_outlet_output_content_wrapper');

function style_outlet_output_content_wrapper() { ?>
	<div class="container" id="content">
		<div class="row">
			<?php $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); ?>
			<?php if( 'left' == $sidebar_position ) :?>
				<?php get_sidebar(); ?>
			<?php endif; ?> 
			<?php if ('left' == $sidebar_position || 'fullwidth' ==$sidebar_position || 'no-sidebar' == $sidebar_position ) :?>
				<?php remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar');?>
			<?php endif;?>
			<div id="primary" class="content-area <?php style_outlet_layout_class(); ?> columns" role="main"><?php
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
add_action( 'woocommerce_after_main_content', 'style_outlet_output_content_wrapper_end' );

function style_outlet_output_content_wrapper_end () {
	echo "</div>";
}

add_action( 'init', 'style_outlet_remove_wc_breadcrumbs' );
function style_outlet_remove_wc_breadcrumbs() {
   	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/* Recommended plugin using TGM */
add_action( 'tgmpa_register', 'style_outlet_register_plugins');
if( !function_exists('style_outlet_register_plugins') ) {
	function style_outlet_register_plugins() {
       /**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'     => 'WooCommerce', // The plugin name.
				'slug'     => 'woocommerce', // The plugin slug (typically the folder name).
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
			),
		);
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'themes.php',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}