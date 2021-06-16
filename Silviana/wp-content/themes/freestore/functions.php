<?php
/**
 * FreeStore functions and definitions
 *
 * @package FreeStore
 */
define( 'FREESTORE_THEME_VERSION' , '1.2.1' );

// Load WP included scripts
require get_template_directory() . '/includes/inc/template-tags.php';
require get_template_directory() . '/includes/inc/extras.php';
require get_template_directory() . '/includes/inc/jetpack.php';
require get_template_directory() . '/includes/inc/customizer.php';

// Support page for taking donations
require get_template_directory() . '/support/support.php';

// Load Customizer Library scripts
require get_template_directory() . '/customizer/customizer-options.php';
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';
require get_template_directory() . '/customizer/styles.php';
require get_template_directory() . '/customizer/mods.php';

// Load TGM plugin class
require_once get_template_directory() . '/includes/inc/class-tgm-plugin-activation.php';
// Add customizer Upgrade class
require_once( get_template_directory() . '/includes/freestore-pro/class-customize.php' );

if ( ! function_exists( 'freestore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function freestore_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on freestore, use a find and replace
	 * to change 'freestore' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'freestore', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'freestore_blog_img_side', 500, 380, true );
    add_image_size( 'freestore_blog_img_top', 1200, 440, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'freestore' ),
        'top-bar-menu' => __( 'Top Bar Menu', 'freestore' ),
        'footer-bar' => __( 'Footer Bar Menu', 'freestore' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	
	// The custom logo is used for the logo
	add_theme_support( 'custom-logo', array(
		'height'      => 145,
		'width'       => 280,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'freestore_custom_background_args', array(
		'default-color' => 'F9F9F9',
	) ) );
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif; // freestore_setup
add_action( 'after_setup_theme', 'freestore_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function freestore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'freestore' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar(array(
		'name' => __( 'Sidebar Menu', 'freestore' ),
		'id' => 'freestore-sidebar-menu',
        'description' => __( 'These widgets are placed in the slide out menu under the navigation.', 'freestore' )
	));
	
    register_sidebar(array(
		'name' => __( 'FreeStore Footer Centered', 'freestore' ),
		'id' => 'freestore-site-footer-centered',
        'description' => __( 'The footer will add widgets centered below each other.', 'freestore' )
	));
	
	register_sidebar(array(
		'name' => __( 'FreeStore Footer Standard', 'freestore' ),
		'id' => 'freestore-site-footer-standard',
        'description' => __( 'The footer will divide into however many widgets are placed here.', 'freestore' )
	));
}
add_action( 'widgets_init', 'freestore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function freestore_scripts() {
	wp_enqueue_style( 'freestore-body-font-default', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic', array(), FREESTORE_THEME_VERSION );
	wp_enqueue_style( 'freestore-heading-font-default', '//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic', array(), FREESTORE_THEME_VERSION );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/includes/font-awesome/css/font-awesome.css', array(), '4.7.0' );
	
	wp_enqueue_style( 'freestore-header-style-standard', get_template_directory_uri().'/templates/css/header-standard.css', array(), FREESTORE_THEME_VERSION );
	
	wp_enqueue_style( 'freestore-style', get_stylesheet_uri(), array(), FREESTORE_THEME_VERSION );
	
	if ( freestore_is_woocommerce_activated() ) :
		wp_enqueue_style( 'freestore-standard-woocommerce-style', get_template_directory_uri().'/templates/css/woocommerce-standard-style.css', array(), FREESTORE_THEME_VERSION );
	endif;
	
	if ( get_theme_mod( 'freestore-footer-layout' ) == 'freestore-footer-layout-centered' ) :
	    wp_enqueue_style( 'freestore-footer-centered-style', get_template_directory_uri().'/templates/css/footer-centered.css', array(), FREESTORE_THEME_VERSION );
	elseif ( get_theme_mod( 'freestore-footer-layout' ) == 'freestore-footer-layout-standard' ) :
	    wp_enqueue_style( 'freestore-footer-standard-style', get_template_directory_uri().'/templates/css/footer-standard.css', array(), FREESTORE_THEME_VERSION );
	elseif ( get_theme_mod( 'freestore-footer-layout' ) == 'freestore-footer-layout-none' ) :
	    wp_enqueue_style( 'freestore-no-footer-style', get_template_directory_uri().'/templates/css/footer-none.css', array(), FREESTORE_THEME_VERSION );
	else :
		wp_enqueue_style( 'freestore-footer-social-style', get_template_directory_uri().'/templates/css/footer-social.css', array(), FREESTORE_THEME_VERSION );
	endif;

	wp_enqueue_script( 'freestore-caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), FREESTORE_THEME_VERSION, true );
	
	wp_enqueue_script( 'freestore-customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), FREESTORE_THEME_VERSION, true );
	
	wp_enqueue_script( 'freestore-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), FREESTORE_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'freestore_scripts' );

/**
 * Add theme stying to the theme content editor
 */
function freestore_add_editor_styles() {
    add_editor_style( 'style-theme-editor.css' );
}
add_action( 'admin_init', 'freestore_add_editor_styles' );

/**
 * Enqueue admin styling.
 */
function freestore_load_admin_script() {
    wp_enqueue_style( 'freestore-admin-css', get_template_directory_uri() . '/support/css/admin-css.css' );
}
add_action( 'admin_enqueue_scripts', 'freestore_load_admin_script' );

/**
 * Enqueue freestore custom customizer styling.
 */
function freestore_load_customizer_script() {
    wp_enqueue_script( 'freestore-customizer-js', get_template_directory_uri() . '/customizer/customizer-library/js/customizer-custom.js', array('jquery'), FREESTORE_THEME_VERSION, true );
    wp_enqueue_style( 'freestore-customizer-css', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'freestore_load_customizer_script' );

/**
 * To maintain backwards compatibility with older versions of WordPress
 */
function freestore_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * Check if WooCommerce exists.
 */
if ( ! function_exists( 'freestore_is_woocommerce_activated' ) ) :
	function freestore_is_woocommerce_activated() {
	    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
endif; // freestore_is_woocommerce_activated

// If WooCommerce exists include ajax cart
if ( freestore_is_woocommerce_activated() ) {
	require get_template_directory() . '/includes/inc/woocommerce-header-inc.php';
}

/*
 * Override WooCommerce for product # per page
 */
function freestore_shop_products_per_page( $freestore_wc_ppp ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	$freestore_wc_ppp = 8;
	if ( get_theme_mod( 'freestore-woocommerce-products-per-page' ) ) :
		$freestore_wc_ppp = esc_attr( get_theme_mod( 'freestore-woocommerce-products-per-page' ) );
	endif;
	return $freestore_wc_ppp;
}
add_filter( 'loop_shop_per_page', 'freestore_shop_products_per_page', 20 );

/*
 * Override WooCommerce for product # per row
 */
if ( !function_exists( 'freestore_loop_columns' ) ) :
	function freestore_loop_columns() {
		$freestore_woocommerce_product_cols = 4;
		if ( get_theme_mod( 'freestore-woocommerce-custom-cols' ) ) :
			$freestore_woocommerce_product_cols = esc_attr( get_theme_mod( 'freestore-woocommerce-custom-cols' ) );
		endif;
		return $freestore_woocommerce_product_cols;
	}

	add_filter('loop_shop_columns', 'freestore_loop_columns');
endif;

/**
 * Add classed to the body tag from settings
 */
function freestore_add_body_class( $classes ) {
	if ( get_theme_mod( 'freestore-page-styling' ) ) {
		$page_style_class = sanitize_html_class( get_theme_mod( 'freestore-page-styling' ) );
	} else {
		$page_style_class = sanitize_html_class( 'freestore-page-styling-flat' );
	}
	$classes[] = $page_style_class;
	
	if ( get_theme_mod( 'freestore-blog-left-sidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-blog-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-blog-archive-left-sidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-blog-archives-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-blog-single-left-sidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-blog-single-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-blog-search-left-sidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-blog-search-left-sidebar' );
	}
	
	if ( get_theme_mod( 'freestore-woocommerce-shop-leftsidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-woocommerce-shop-archive-leftsidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-archives-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-woocommerce-shop-single-leftsidebar' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-single-left-sidebar' );
	}
	if ( get_theme_mod( 'freestore-woocommerce-shop-fullwidth' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-full-width' );
	}
	if ( get_theme_mod( 'freestore-woocommerce-shop-archive-fullwidth' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-archives-full-width' );
	}
	if ( get_theme_mod( 'freestore-woocommerce-shop-single-fullwidth' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-single-full-width' );
	}
	
	if ( get_theme_mod( 'freestore-page-titles' ) ) {
		$classes[] = sanitize_html_class( 'freestore-shop-remove-title' );
	}
	
	return $classes;
}
add_filter( 'body_class', 'freestore_add_body_class' );

/**
 * Add classes to the blog list for styling.
 */
function freestore_add_post_classes ( $classes ) {
	global $current_class;
	
	if ( is_home() ) :
		$classes[] = $current_class;
		$current_class = ( $current_class == 'blog-alt-odd' ) ? 'blog-alt-even' : 'blog-alt-odd';
	endif;
	
	return $classes;
}
global $current_class;
$current_class = 'blog-alt-odd';
add_filter ( 'post_class' , 'freestore_add_post_classes' );

/**
 * Adjust is_home query if freestore-blog-cats is set
 */
function freestore_set_blog_queries( $query ) {
    $blog_query_set = '';
    if ( get_theme_mod( 'freestore-blog-cats', false ) ) {
        $blog_query_set = esc_attr( get_theme_mod( 'freestore-blog-cats' ) );
    }
    
    if ( $blog_query_set ) {
        // do not alter the query on wp-admin pages and only alter it if it's the main query
        if ( !is_admin() && $query->is_main_query() ){
            if ( is_home() ){
                $query->set( 'cat', $blog_query_set );
            }
        }
    }
}
add_action( 'pre_get_posts', 'freestore_set_blog_queries' );

/**
 * Display recommended plugins with the TGM class
 */
function freestore_register_required_plugins() {
	$plugins = array(
		// The recommended WordPress.org plugins.
		array(
			'name'      => __( 'Page Builder', 'freestore' ),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __( 'woocommerce', 'freestore' ),
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => __( 'Widgets Bundle', 'freestore' ),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __( 'Contact Form 7', 'freestore' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => __( 'Breadcrumb NavXT', 'freestore' ),
			'slug'      => 'breadcrumb-navxt',
			'required'  => false,
		),
		array(
			'name'      => __( 'Meta Slider', 'freestore' ),
			'slug'      => 'ml-slider',
			'required'  => false,
		)
	);
	$config = array(
		'id'           => 'freestore',
		'menu'         => 'tgmpa-install-plugins',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'freestore_register_required_plugins' );

/**
 * Function to remove Category pre-title text
 */
function freestore_cat_title_remove_pretext( $freestore_cat_title ) {
	if ( is_category() ) {
            $freestore_cat_title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $freestore_cat_title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $freestore_cat_title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $freestore_cat_title;
}
if ( get_theme_mod( 'freestore-remove-cat-pre-title' ) ) :
	add_filter( 'get_the_archive_title', 'freestore_cat_title_remove_pretext' );
endif;

/**
 * Register a custom Post Categories ID column
 */
function freestore_edit_cat_columns( $freestore_cat_columns ) {
    $freestore_cat_in = array( 'cat_id' => 'Category ID <span class="cat_id_note">For the Default Slider</span>' );
    $freestore_cat_columns = freestore_cat_columns_array_push_after( $freestore_cat_columns, $freestore_cat_in, 0 );
    return $freestore_cat_columns;
}
add_filter( 'manage_edit-category_columns', 'freestore_edit_cat_columns' );

/**
 * Print the ID column
 */
function freestore_cat_custom_columns( $value, $name, $cat_id ) {
    if ( 'cat_id' == $name ) 
        echo $cat_id;
}
add_filter( 'manage_category_custom_column', 'freestore_cat_custom_columns', 10, 3 );

/**
 * Insert an element at the beggining of the array
 */
function freestore_cat_columns_array_push_after( $src, $freestore_cat_in, $pos ) {
    if ( is_int( $pos ) ) {
        $R = array_merge( array_slice( $src, 0, $pos + 1 ), $freestore_cat_in, array_slice( $src, $pos + 1 ) );
    } else {
        foreach ( $src as $k => $v ) {
            $R[$k] = $v;
            if ( $k == $pos )
                $R = array_merge( $R, $freestore_cat_in );
        }
    }
    return $R;
}

/**
 * Add donation dismissable notice in admin
 */
function freestore_donation_dismissable_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    
    if ( ! get_user_meta( $user_id, 'freestore_donation_ignore_notice' ) ) { ?>
        <div class="notice notice-info freestore-admin-notice is-dismissible">
			<p><?php printf( __( 'Please consider <a href="http://kaira.fetchapp.com/sell/a9380c28?amount=" target="_blank">donating any amount of your choice to FreeStore</a> to help us keep developing on it and keep it as a FREE premium theme. <a href="?freestore_donation_nag_ignore=0" class="freestore-admin-notice-close">Dismiss Notice</a>', 'freestore' ) ); ?></p>
		</div>
	<?php
    }
}
add_action( 'admin_notices', 'freestore_donation_dismissable_notice' );

function freestore_donation_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
        
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset( $_GET['freestore_donation_nag_ignore'] ) && '0' == $_GET['freestore_donation_nag_ignore'] ) {
        add_user_meta( $user_id, 'freestore_donation_ignore_notice', 'true', true );
    }
}
add_action( 'admin_init', 'freestore_donation_nag_ignore' );
