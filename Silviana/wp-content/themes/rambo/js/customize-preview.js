( function( $ ) {
	var api = wp.customize;

	// Service section title.
	api( 'rambo_pro_theme_options[service_section_title]', function( value ) {
		value.bind( function( to ) {
			$( '.home_service_section .featured_port_title h1' ).text( to );
		} );
	} );
	
	// Service section description.
	api( 'rambo_pro_theme_options[service_section_descritpion]', function( value ) {
		value.bind( function( to ) {
			$( '.home_service_section .featured_port_title p' ).text( to );
		} );
	} );
	
	// Project section title.
	api( 'rambo_pro_theme_options[project_heading_one]', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio_main_content .featured_port_title h1' ).text( to );
		} );
	} );
	
	// Project section description.
	api( 'rambo_pro_theme_options[project_tagline]', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio_main_content .featured_port_title p' ).text( to );
		} );
	} );
	
	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.logo-title' ).text( to );
		} );
	} );
} )( jQuery );