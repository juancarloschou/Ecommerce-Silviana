<?php
add_action( 'wp_enqueue_scripts', 'workpress_theme_css',999);
function workpress_theme_css() {
    wp_enqueue_style( 'workpress-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'workpress-child-style', get_stylesheet_uri(), array( 'workpress-parent-style' ) );
	wp_enqueue_style( 'workpress-default-css', get_stylesheet_directory_uri()."/css/default.css" );
	wp_dequeue_style( 'default',get_template_directory_uri() .'/css/default.css');
	wp_enqueue_style ('workpress-bootstrap',get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style ('workpress-bootstrap-responsive',get_template_directory_uri() .'/css/bootstrap-responsive.css');
}

require( get_stylesheet_directory() . '/functions/customizer/customizer_project.php' );
require( get_stylesheet_directory() . '/functions/customizer/customizer_service_panel.php' );
require( get_stylesheet_directory() . '/functions/widget/custom-sidebar.php' );


add_action( 'after_setup_theme', 'workpress_theme_setup' );
function workpress_theme_setup() {
	require_once( get_stylesheet_directory() . '/theme_setup_data.php' );
	load_child_theme_textdomain( 'workpress', get_stylesheet_directory() . '/languages' );
}

add_action( 'customize_register', 'workpress_remove_custom', 1000 );
function workpress_remove_custom($wp_customize) {
 $wp_customize->remove_section( 'project_settings' );
 $wp_customize->remove_section( 'service_settings' );
}

function workpress_remove_some_widgets(){

	// Unregister sidebars
	unregister_sidebar( 'sidebar-service' );
	unregister_sidebar( 'sidebar-project' );
}
add_action( 'widgets_init', 'workpress_remove_some_widgets', 11 );

/**
 * Enqueue script for custom customize control.
 */
function workpress_custom_customize_enqueue() {
	wp_enqueue_script( 'workpress_customizer_script', get_stylesheet_directory_uri() . '/js/workpress_customizer.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'workpress_custom_customize_enqueue' );



function workpress_import_files() {
  return array(
    array(
      'import_file_name'           => 'Demo Import 1',
      'categories'                 => array( 'Category 1', 'Category 2' ),
      'import_file_url'            => 'https://webriti.com/themes/dummydata/rambo/lite/rambo-content.xml',
      'import_widget_file_url'     => 'https://webriti.com/themes/dummydata/rambo/lite/workpress-widget.json',
      'import_customizer_file_url' => 'https://webriti.com/themes/dummydata/rambo/lite/rambo-customize.dat',
      'import_notice'              => sprintf(__( 'Click the large blue button to start the dummy data import process.</br></br>Please be patient while WordPress imports all the content.</br></br>
			<h3>Recommended Plugins</h3> WorkPress theme supports the following plugins:</br> </br><li> <a href="https://wordpress.org/plugins/contact-form-7/"> Contact Form 7</a></li> <li> <a href="https://wordpress.org/plugins/woocommerce/"> WooCommerce </a> </li><li> <a href="https://wordpress.org/plugins/spoontalk-social-media-icons-widget/"> Spoon Talk Social Media Icons </a></li>', 'workpress' )),
			),
    	
    	
    	
	);
}
add_filter( 'pt-ocdi/import_files', 'workpress_import_files',999 );


function workpress_after_import_setup() {

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
add_action( 'pt-ocdi/after_import', 'workpress_after_import_setup' );
?>