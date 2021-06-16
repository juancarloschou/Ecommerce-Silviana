<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library FreeStore
 */

/**
 * Enqueue Google Fonts Example
 */
function customizer_freestore_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'freestore-title-font', customizer_library_get_default( 'freestore-title-font' ) ),
		get_theme_mod( 'freestore-tagline-font', customizer_library_get_default( 'freestore-tagline-font' ) ),
		get_theme_mod( 'freestore-body-font', customizer_library_get_default( 'freestore-body-font' ) ),
		get_theme_mod( 'freestore-heading-font', customizer_library_get_default( 'freestore-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'customizer_freestore_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'customizer_freestore_fonts' );
