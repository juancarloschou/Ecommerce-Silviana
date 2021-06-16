<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library FreeStore
 */

if ( ! function_exists( 'customizer_library_freestore_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_freestore_build_styles() {
	
	// Site Logo Max Width
	$setting = 'freestore-logo-max-width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$logo_max_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding a.custom-logo-link'
			),
			'declarations' => array(
				'max-width' => $logo_max_width . 'px'
			)
		) );
	}
	
	// Site Container Set Width
	$setting = 'freestore-set-container-width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$container_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-container,
				.site-boxed'
			),
			'declarations' => array(
				'max-width' => $container_width . 'px'
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer-social'
			),
			'declarations' => array(
				'max-width' => ( $container_width - 60 ) . 'px'
			)
		) );
	}
	
	// Set Sidebar Width
	$setting = 'freestore-set-sidebar-width';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$sidebar_width = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.woocommerce #container,
				.woocommerce-page #container,
				.content-area'
			),
			'declarations' => array(
				'width' => ( 100 - $sidebar_width ) . '%'
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body.freestore-page-styling-raised .content-area,
				body.freestore-page-styling-raised.woocommerce #container,
				body.freestore-page-styling-raised.woocommerce-page #container'
			),
			'declarations' => array(
				'width' => ( 97 - $sidebar_width ) . '%'
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.widget-area,
				body.freestore-page-styling-raised .widget-area,
				body.freestore-page-styling-raised.page-template-template-left-sidebar .widget-area'
			),
			'declarations' => array(
				'width' => $sidebar_width . '%'
			)
		) );
	}
	
	// Primary Color
	$setting = 'freestore-primary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'#comments .form-submit #submit,
                .search-block .search-submit,
                .no-results-btn,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"],
                .woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button,
                .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale,
                .woocommerce button.button.alt,
                .woocommerce-page button.button.alt,
                .woocommerce input.button.alt:hover,
                .woocommerce-page #content input.button.alt:hover,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button,
                .woocommerce-page a.button,
                .woocommerce input.button,
                .woocommerce-page #content input.button,
                .woocommerce-page input.button,
                .woocommerce #review_form #respond .form-submit input,
                .woocommerce-page #review_form #respond .form-submit input,
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
				.woocommerce button.button.alt.disabled,
				.woocommerce button.button.alt.disabled:hover,
                .single-product span.onsale,
                .main-navigation ul ul a:hover,
                .main-navigation ul ul li:hover,
                .main-navigation ul ul li.current-menu-item > a,
                .main-navigation ul ul li.current_page_item > a,
                .main-navigation ul ul li.current-menu-parent > a,
                .main-navigation ul ul li.current_page_parent > a,
                .main-navigation ul ul li.current-menu-ancestor > a,
                .main-navigation ul ul li.current_page_ancestor > a,
                .main-navigation button,
                .wpcf7-submit'
			),
			'declarations' => array(
				'background' => 'inherit',
                'background-color' => $color
			)
		) );
	}
	
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a,
				.header-social-icon:hover,
				.footer-social-icon:hover,
				.site-footer-bottom-bar ul li a:hover,
				.site-topbar-left ul li a:hover,
				.content-area .entry-content a,
				#comments a,
				.search-btn,
				.post-edit-link,
				.site-title a,
				.error-404.not-found .page-header .page-title span,
				.search-button .fa-search,
				.main-navigation li a:hover,
				.main-navigation.freestore-nav-plain .current_page_item > a,
				.main-navigation.freestore-nav-plain .current-menu-item > a,
				.main-navigation.freestore-nav-plain .current_page_ancestor > a,
				.main-navigation.freestore-nav-underline .current_page_item > a,
				.main-navigation.freestore-nav-underline .current-menu-item > a,
				.main-navigation.freestore-nav-underline .current_page_ancestor > a,
				.header-cart-checkout.cart-has-items .fa-shopping-cart'
			),
			'declarations' => array(
                'color' => $color . ''
			)
		) );
		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation.freestore-nav-underline .current_page_item > a,
				.main-navigation.freestore-nav-underline .current-menu-item > a,
				.main-navigation.freestore-nav-underline .current_page_ancestor > a'
			),
			'declarations' => array(
                'box-shadow' => '0 -3px 0 ' . $color . ' inset'
			)
		) );
	}
	
	// Secondary Color
	$setting = 'freestore-secondary-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.main-navigation button:hover,
                #comments .form-submit #submit:hover,
                .search-block .search-submit:hover,
                .no-results-btn:hover,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"],
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button:hover,
                .woocommerce-page a.button:hover,
                .woocommerce input.button:hover,
                .woocommerce-page #content input.button:hover,
                .woocommerce-page input.button:hover,
                .woocommerce ul.products li.product a.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.add_to_cart_button:hover,
                .woocommerce button.button.alt:hover,
                .woocommerce-page button.button.alt:hover,
                .woocommerce #review_form #respond .form-submit input:hover,
                .woocommerce-page #review_form #respond .form-submit input:hover,
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
                .wpcf7-submit:hover'
			),
			'declarations' => array(
				'background' => 'inherit',
                'background-color' => $color
			)
		) );
	}
	
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover,
                .widget-area .widget a:hover,
                .site-footer-widgets .widget a:hover,
                .site-footer .widget a:hover,
                .search-btn:hover,
                .search-button .fa-search:hover,
                .woocommerce #content div.product p.price,
                .woocommerce-page #content div.product p.price,
                .woocommerce-page div.product p.price,
                .woocommerce #content div.product span.price,
                .woocommerce div.product span.price,
                .woocommerce-page #content div.product span.price,
                .woocommerce-page div.product span.price,

                .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Body Font
	$setting = 'freestore-body-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body,
				.main-navigation ul li a,
				.widget-area .widget a'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	
	// Body Font Color
	$setting = 'freestore-body-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body,
                .widget-area .widget a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Heading Font
	$setting = 'freestore-heading-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .widget-area .widget-title,
                .woocommerce table.cart th,
                .woocommerce-page #content table.cart th,
                .woocommerce-page table.cart th,
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce table.cart input,
                .woocommerce-page #content table.cart input,
                .woocommerce-page table.cart input,
                button, input[type="button"],
                input[type="reset"],
                input[type="submit"]',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	
	// Site Title Font
	$setting = 'freestore-title-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title a'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	// Site Title Font Size
	$setting = 'freestore-title-font-size';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$title_font_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title'
			),
			'declarations' => array(
				'font-size' => $title_font_size . 'px'
			)
		) );
	}
	// Site Title Font
	$setting = 'freestore-tagline-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-description'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}
	// Site Title Font Size
	$setting = 'freestore-tagline-font-size';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$title_font_size = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-description'
			),
			'declarations' => array(
				'font-size' => $title_font_size . 'px'
			)
		) );
	}
	
	// Site Logo Padding
	$setting = 'freestore-logo-padding-top';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$logo_padding_top = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding a.custom-logo-link,
				.site-title'
			),
			'declarations' => array(
				'padding-top' => $logo_padding_top . 'px'
			)
		) );
	}
	$setting = 'freestore-logo-padding-bottom';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$logo_padding_bottom = esc_attr( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding a.custom-logo-link,
				.site-description'
			),
			'declarations' => array(
				'padding-bottom' => $logo_padding_bottom . 'px'
			)
		) );
	}
	
	// Heading Font Color
	$setting = 'freestore-heading-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .widget-area .widget-title'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}
	
	// Site Boxed Background Color
	$setting = 'freestore-boxed-bg-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-boxed'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}
	
	// Body Blocks Background Color
	$setting = 'freestore-page-styling-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body.freestore-page-styling-raised .content-area,
				body.freestore-page-styling-raised .widget-area,
				body.freestore-page-styling-raised.woocommerce #container,
				body.freestore-page-styling-raised.woocommerce-page #container'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}
	
	// Header Background Color
	$setting = 'freestore-header-bg-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header,
				.search-block,
				.main-navigation ul ul'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}
	
	// Header Font Color
	$setting = 'freestore-header-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header,
				.main-navigation ul li a,
				.site-description'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}
	
	// Top Bar Background Color
	$setting = 'freestore-topbar-bg-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header-topbar'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}
	
	// Top Bar Font Color
	$setting = 'freestore-topbar-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-header-topbar'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}
	
	// Footer Background Color
	$setting = 'freestore-footer-bg-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer-standard'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}
	
	// Footer Font Color
	$setting = 'freestore-footer-font-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-footer,
				.site-footer .widgettitle'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

}
endif;

add_action( 'customizer_library_styles', 'customizer_library_freestore_build_styles' );

if ( ! function_exists( 'customizer_library_freestore_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_freestore_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"freestore-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'customizer_library_freestore_styles', 11 );