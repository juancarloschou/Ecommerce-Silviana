<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package FreeStore
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function freestore_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'freestore_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function freestore_jetpack_setup
add_action( 'after_setup_theme', 'freestore_jetpack_setup' );

function freestore_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'templates/contents/content' );
	}
} // end function freestore_infinite_scroll_render