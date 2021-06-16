<?php

/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function rambo_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i','Philosopher:400,400i,700,700i' );
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function rambo_scripts_styles() {
    wp_enqueue_style( 'rambo-fonts', rambo_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'rambo_scripts_styles' );
?>