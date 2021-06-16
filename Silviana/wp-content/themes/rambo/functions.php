<?php
/*
	*Theme Name	: Rambo
	*Theme Core Functions and Codes
*/	
	/**Includes reqired resources here**/
	define('WEBRITI_TEMPLATE_DIR_URI',get_template_directory_uri());	
	
	define('WEBRITI_TEMPLATE_DIR',get_template_directory());
	define('WEBRITI_THEME_FUNCTIONS_PATH',WEBRITI_TEMPLATE_DIR.'/functions');
	
	define('WEBRITI_THEME_OPTIONS_PATH',WEBRITI_TEMPLATE_DIR_URI.'/functions/theme_options');
	require_once('theme_setup_data.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php' ); // for Default Menus
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/rambo_nav_walker.php' ); // for Custom Menus	
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/scripts/scripts.php' ); // all js and css file for rambo-pro	
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/commentbox/comment-function.php' ); //for comments
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/custom-sidebar.php' ); //for widget register
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/font/font.php'); //for font library
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/rambo-site-intro-widget.php' ); //for Site Intro widgets
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/rambo-register-page-widget.php' ); //for Page / Service widgets
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/template-tags.php' ); //for post meta content
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/rambo-sidebar-latest-news.php' ); //for sidebar Latest News custom widgets	
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/rambo-recent-news-widget.php' ); //for news widget
	
	
	//Customizer
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_header.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_slider_panel.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_site_intro.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_service_panel.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_project.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_recent_news.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_copyright.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_pro.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_help.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_import_data.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer_emailcourse.php');
	
	// Rambo Info Page
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/rambo-info/welcome-screen.php');
	
	
	//require( WEBRITI_THEME_FUNCTIONS_PATH . '/excerpt/excerpt.php' ); // for Excerpt Length
	
	global $resetno; //user for reset function
	//content width
	if ( ! isset( $content_width ) ) $content_width = 900;	
	
	//wp title tag starts here
	function webriti_head( $title, $sep )
	{	global $paged, $page;		
		if ( is_feed() )
			return $title;
		// Add the site name.
		$title .= get_bloginfo( 'name' );
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( _e('Page','rambo'), max( $paged, $page ) );
		return $title;
	}	
	add_filter( 'wp_title', 'webriti_head', 10,2 );
	
		add_action( 'after_setup_theme', 'webriti_setup' ); 	
		function webriti_setup()
		{	// Load text domain for translation-ready
			load_theme_textdomain( 'rambo', WEBRITI_THEME_FUNCTIONS_PATH . '/lang' );	
			
		add_theme_support( 'post-thumbnails' ); //supports featured image
		add_theme_support( 'woocommerce' );//woocommerce
		add_theme_support( 'title-tag' ); //Title Tag
		add_theme_support( 'automatic-feed-links' ); // Feed Link
		add_theme_support( 'custom-background' ); // Custom Background
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		//Custom logo
	
		add_theme_support( 'custom-logo' , array(
	
	   'class'       => 'navbar-brand',
	   
	   'width'       => 200,
	   
	   'height'      => 50,
	   
	   'flex-width' => false,
	   
	   'flex-height' => false,
	   
		) );
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'rambo' ) );
		
		// setup admin pannel defual data for index page
		$rambo_pro_theme=theme_data_setup();
	}
	
// change custom logo link class
	add_filter('get_custom_logo','change_logo_class');
	function change_logo_class($html)
	{
		$html = str_replace('class="custom-logo-link"', 'class="brand"', $html);
		return $html;
	}

function rambo_import_files() {
  return array(
    array(
      'import_file_name'           => 'Demo Import 1',
      'categories'                 => array( 'Category 1', 'Category 2' ),
      'import_file_url'            => 'https://webriti.com/themes/dummydata/rambo/lite/rambo-content.xml',
      'import_widget_file_url'     => 'https://webriti.com/themes/dummydata/rambo/lite/rambo-widget.json',
      'import_customizer_file_url' => 'https://webriti.com/themes/dummydata/rambo/lite/rambo-customize.dat',
	  'import_preview_image_url'   => 'https://preview.c9users.io/imranali_13/rambo-import/screenshot.png',
      'import_notice'              => sprintf(__( 'Click the big blue button to start the dummy data import process.</br></br>Please be patient while WordPress imports all the content.</br></br>
			<h3> Recommend Plugins</h3>Rambo theme supports following plugins.</br> </br><li> <a href="https://wordpress.org/plugins/contact-form-7/"> Contact form 7</a> </l1> </br> <li> <a href="https://wordpress.org/plugins/woocommerce/"> WooCommerce </a> </li><li> <a href="https://wordpress.org/plugins/spoontalk-social-media-icons-widget/"> Spoon talk social media icon </a></li>', 'rambo' )),
			),
    	
    	
    	
	);
}
add_filter( 'pt-ocdi/import_files', 'rambo_import_files' );


function rambo_after_import_setup() {

	// Menus to assign after import.
	$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'primary'   => $main_menu->term_id,
	));
	
 // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );	
	
}
add_action( 'pt-ocdi/after_import', 'rambo_after_import_setup' );

//Cerate enwueu function in customizer setting
function rambo_customize_preview_js() {
	wp_enqueue_script( 'rambo-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'rambo_customize_preview_js' );
?>