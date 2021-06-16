<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package nirvana
 * @subpackage Functions
 */

/* = Loading CSS
--------------------------------------*/

/* Enqueue all styles */
function nirvana_enqueue_styles() {
	global $nirvanas;
	extract($nirvanas);

	wp_enqueue_style( 'nirvanas-fonts', get_template_directory_uri() . '/fonts/fontfaces.css', NULL, _CRYOUT_THEME_VERSION ); // fontfaces.css

	/* Google fonts */
	$gfonts = array();

	if($nirvana_googlefont) $gfonts[] = cryout_gfontclean( $nirvana_googlefont );
	if($nirvana_googlefonttitle) $gfonts[] = cryout_gfontclean( $nirvana_googlefonttitle );
	if($nirvana_googlefontside) $gfonts[] = cryout_gfontclean( $nirvana_googlefontside );
	if($nirvana_googlefontwidget) $gfonts[] = cryout_gfontclean( $nirvana_googlefontwidget );
	if($nirvana_sitetitlegooglefont) $gfonts[] = cryout_gfontclean( $nirvana_sitetitlegooglefont );
	if($nirvana_menugooglefont) $gfonts[] = cryout_gfontclean( $nirvana_menugooglefont );
	if($nirvana_headingsgooglefont) $gfonts[] = cryout_gfontclean( $nirvana_headingsgooglefont );

	// enqueue fonts with subsets separately
	foreach($gfonts as $i=>$gfont):
		if (strpos($gfont,"&") === false):
		   // do nothing
		else:
			wp_enqueue_style( 'nirvana-googlefont_'.$i, '//fonts.googleapis.com/css?family=' . $gfont );
			unset($gfonts[$i]);
		endif;
	endforeach;

	// merged fonts
	if ( count($gfonts)>0 ):
		wp_enqueue_style( 'nirvana-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique($gfonts) ), array(), null, 'screen' ); // google fonts
	endif;

	wp_enqueue_style( 'nirvanas', get_stylesheet_uri(), NULL, _CRYOUT_THEME_VERSION ); // main style.css
	if (is_rtl()) wp_enqueue_style( 'nirvana-rtl', get_template_directory_uri() . '/styles/rtl.css', NULL, _CRYOUT_THEME_VERSION );

}

add_action('wp_head', 'nirvana_enqueue_styles', 5 );

/* Enqueue all custom styles */
function nirvana_styles_echo() {
	global $nirvanas;

	echo preg_replace("/[\n\r\t\s]+/"," " ,nirvana_custom_styles())."\n"; // custom-styles.php
	if (($nirvanas['nirvana_frontpage'] == "Enable") && is_front_page() && ('posts' == get_option( 'show_on_front' )) ) {
		echo preg_replace("/[\n\r\t\s]+/"," " ,nirvana_presentation_css())."\n";   // PP styles also in custom-styles.php
	}
	echo preg_replace("/[\n\r\t\s]+/"," " ,nirvana_customcss())."\n"; // user custom CSS
}
add_action('wp_head', 'nirvana_styles_echo', 20);


/* Enqueue mobile styles */
function nirvana_load_mobile_css() {
	global $nirvanas;
	if ($nirvanas['nirvana_mobile']=="Enable") {
		wp_enqueue_style( 'nirvana-mobile', get_template_directory_uri() . '/styles/style-mobile.css', NULL, _CRYOUT_THEME_VERSION );
	}
}
add_action('wp_head', 'nirvana_load_mobile_css', 30);

// User Custom JS
add_action('wp_footer', 'nirvana_customjs', 35 );

// Scripts loading and hook into wp_enque_scripts
function nirvana_scripts_method() {
	global $nirvanas;

	wp_enqueue_script('nirvana-frontend',get_template_directory_uri() . '/js/frontend.js', array('jquery'), _CRYOUT_THEME_VERSION, true );

	if (($nirvanas['nirvana_frontpage'] == "Enable") && is_front_page()) {
			// if PP and the current page is frontpage - load the nivo slider js
			wp_enqueue_script('nirvana-nivoslider',get_template_directory_uri() . '/js/nivo.slider.min.js', array('jquery'), _CRYOUT_THEME_VERSION, true);
			// add slider init js in footer
			add_action('wp_footer', 'nirvana_pp_slider' );
	}
	
	$js_options = array(
		//'masonry' => $nirvana_masonry,
		'mobile' => (($nirvanas['nirvana_mobile']=='Enable')?1:0),
		'fitvids' => $nirvanas['nirvana_fitvids'],
	);
	wp_localize_script( 'nirvana-frontend', 'nirvana_settings', $js_options );

	// We add some JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
if ( !is_admin() ) add_action('wp_enqueue_scripts', 'nirvana_scripts_method');

/*
 * nirvana_custom_editor_styles() is located in custom-styles.php
 */
function nirvana_add_editor_styles() {
	add_editor_style( add_query_arg( 'action', 'nirvana_editor_styles', admin_url( 'admin-ajax.php' ) ) );
	add_action( 'wp_ajax_nirvana_editor_styles', 'nirvana_editor_styles' );
	add_action( 'wp_ajax_no_priv_nirvana_editor_styles', 'nirvana_editor_styles' );
} // nirvana_add_editor_styles()
if ( is_admin() && $nirvanas['nirvana_editorstyle'] ) nirvana_add_editor_styles();

// FIN
