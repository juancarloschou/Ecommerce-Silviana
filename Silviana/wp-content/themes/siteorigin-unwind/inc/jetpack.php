<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package siteorigin-unwind
 * @since siteorigin-unwind 0.1
 * @license GPL 2.0
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function siteorigin_unwind_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'siteorigin_unwind_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'siteorigin_unwind_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function siteorigin_unwind_infinite_scroll_render() {
	if ( is_search() ) : ?>
		<div class="left-medium-loop"><?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			} ?>
		</div><!-- .left-medium-loop --><?php
	else :
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		}
	endif;
}

/**
 * Remove sharing buttons from their default locations
 */
 function siteorigin_unwind_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'siteorigin_unwind_remove_share' );
