<?php
/**
 * Functions for creating a donations support page
 *
 * @package FreeStore
 */

/**
 * Display the Support page.
 */
function freestore_support_admin_menu() {
    global $freestore_support_page;
    $freestore_support_page = add_theme_page( __( 'Support FreeStore', 'freestore' ), '<span class="freestore-support-link">' . __( 'Support FreeStore', 'freestore' ) . '</span>', 'edit_theme_options', 'freestore_support_page', 'freestore_render_support_page' );
}
add_action( 'admin_menu', 'freestore_support_admin_menu' );

/**
 * Enqueue admin stylesheet only on support page.
 */
function freestore_load_support_page_scripts( $hook ) {
    global $freestore_support_page;
    if ( $hook != $freestore_support_page )
        return;
    
    wp_enqueue_style( 'freestore-support-css', get_template_directory_uri() . '/support/css/admin-support.css' );
    wp_enqueue_script( 'freestore-support-js', get_template_directory_uri() . '/support/js/support-custom.js', array( 'jquery' ), FREESTORE_THEME_VERSION, true );
}    
add_action( 'admin_enqueue_scripts', 'freestore_load_support_page_scripts' );

/**
 * Render the support page
 */
function freestore_render_support_page() {
	$theme_name = basename( get_template_directory() ); // = freestore

	get_template_part( 'support/tpl/support-page' );
}
