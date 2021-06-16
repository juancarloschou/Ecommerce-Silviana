<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library FreeStore
 */

function customizer_library_freestore_options() {

	// Theme defaults
	$blocks_bg_color = '#F7F7F7';
    
    $topbar_bg_color = '#000000';
    $topbar_font_color = '#FFFFFF';
    
    $header_bg_color = '#FFFFFF';
    $footer_bg_color = '#F7F7F7';
    
    $header_font_color = '#2F2F2F';
    $footer_font_color = '#000000';
	
	$primary_color = '#29a6e5';
	$secondary_color = '#2886e5';
	
	$body_font_color = '#000000';
	$heading_font_color = '#000000';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
    
	
    $section = 'title_tagline';
    
    $options['freestore-logo-max-width'] = array(
        'id' => 'freestore-logo-max-width',
        'label'   => __( 'Set a max-width for the logo', 'freestore' ),
        'section' => $section,
        'type'    => 'number',
        'description' => __( 'This only applies if a logo is uploaded', 'freestore' ),
    );
    
    $panel = 'freestore-panel-layout';
    
    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Theme Settings', 'freestore' ),
        'priority' => '30'
    );
    
	$section = 'freestore-panel-layout-section-layout';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Site Layout', 'freestore' ),
		'priority' => '20',
        'panel' => $panel
	);
	
    $choices = array(
        'freestore-site-boxed' => __( 'Boxed Layout', 'freestore' ),
        'freestore-site-full-width' => __( 'Full Width Layout', 'freestore' )
    );
    $options['freestore-site-layout'] = array(
        'id' => 'freestore-site-layout',
        'label'   => __( 'Site Layout', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-site-full-width'
    );
    $options['freestore-set-container-width'] = array(
        'id' => 'freestore-set-container-width',
        'label'   => __( 'Site Container Width', 'freestore' ),
        'section' => $section,
        'type'    => 'range',
        'input_attrs' => array(
            'min'   => 900,
            'max'   => 1400,
            'step'  => 2,
        ),
        'description' => __( 'Set the width of your site between 900 pixels and 1400 pixels', 'freestore' ),
        'default' => 1240
    );
	$choices = array(
		'freestore-page-styling-flat' => __( 'Flat / One Color Style', 'freestore' ),
		'freestore-page-styling-raised' => __( 'Blocks / Raised Style', 'freestore' )
	);
	$options['freestore-page-styling'] = array(
		'id' => 'freestore-page-styling',
		'label'   => __( 'Page Styling', 'freestore' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $choices,
		'default' => 'freestore-page-styling-flat'
	);
	$options['freestore-page-styling-color'] = array(
		'id' => 'freestore-page-styling-color',
		'label'   => __( 'Blocks Background Color', 'freestore' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $blocks_bg_color,
	);
    
    
    $section = 'freestore-panel-layout-section-header';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header', 'freestore' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['freestore-header-remove-topbar'] = array(
        'id' => 'freestore-header-remove-topbar',
        'label'   => __( 'Remove the Top Bar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    $options['freestore-header-menu-text'] = array(
        'id' => 'freestore-header-menu-text',
        'label'   => __( 'Menu Button Text', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'menu',
        'description' => __( 'This is the text for the mobile menu button', 'freestore' )
    );
    $choices = array(
        'freestore-nav-underline' => __( 'Underline', 'freestore' ),
        'freestore-nav-plain' => __( 'Plain', 'freestore' )
    );
    $options['freestore-nav-styling'] = array(
        'id' => 'freestore-nav-styling',
        'label'   => __( 'Navigation Styling', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-nav-underline'
    );
    $options['freestore-header-search'] = array(
        'id' => 'freestore-header-search',
        'label'   => __( 'Remove Search', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-header-hide-social'] = array(
        'id' => 'freestore-header-hide-social',
        'label'   => __( 'Remove Social Links', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-header-remove-add'] = array(
        'id' => 'freestore-header-remove-add',
        'label'   => __( 'Remove Header Address', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-header-remove-no'] = array(
        'id' => 'freestore-header-remove-no',
        'label'   => __( 'Remove Header Phone Number', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    
    $section = 'freestore-panel-layout-section-slider';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Home Page Slider', 'freestore' ),
        'priority' => '40',
        'panel' => $panel
    );
    
    $choices = array(
        'freestore-slider-default' => __( 'Default Slider', 'freestore' ),
        'freestore-meta-slider' => __( 'Meta Slider', 'freestore' ),
        'freestore-no-slider' => __( 'None', 'freestore' )
    );
    $options['freestore-slider-type'] = array(
        'id' => 'freestore-slider-type',
        'label'   => __( 'Choose a Slider', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-slider-default'
    );
    $options['freestore-slider-cats'] = array(
        'id' => 'freestore-slider-cats',
        'label'   => __( 'Slider Categories', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)<br /><br />Get the ID at <b>Posts -> Categories</b>.<br /><br />Or <a href="https://kairaweb.com/documentation/setting-up-the-default-slider/" target="_blank"><b>See more instructions here</b></a>', 'freestore' )
    );
    $options['freestore-meta-slider-shortcode'] = array(
        'id' => 'freestore-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by meta slider.', 'freestore' )
    );
    $choices = array(
        'freestore-slider-size-small' => __( 'Small Slider', 'freestore' ),
        'freestore-slider-size-medium' => __( 'Medium Slider', 'freestore' ),
        'freestore-slider-size-large' => __( 'Large Slider', 'freestore' )
    );
    $options['freestore-slider-size'] = array(
        'id' => 'freestore-slider-size',
        'label'   => __( 'Slider Size', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-slider-size-medium'
    );
    $options['freestore-slider-linkto-post'] = array(
        'id' => 'freestore-slider-linkto-post',
        'label'   => __( 'Link Slide to post', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-slider-remove-title'] = array(
        'id' => 'freestore-slider-remove-title',
        'label'   => __( 'Remove Slider Text', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-slider-auto-scroll'] = array(
        'id' => 'freestore-slider-auto-scroll',
        'label'   => __( 'Stop Auto Scroll', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    
    $section = 'freestore-panel-layout-section-pages';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Pages', 'freestore' ),
        'priority' => '50',
        'panel' => $panel
    );
    
    $options['freestore-page-titles'] = array(
        'id' => 'freestore-page-titles',
        'label'   => __( 'Remove Page Titles', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-set-sidebar-width'] = array(
        'id' => 'freestore-set-sidebar-width',
        'label'   => __( 'Sidebar Width', 'freestore' ),
        'section' => $section,
        'type'    => 'range',
        'input_attrs' => array(
            'min'   => 20,
            'max'   => 42,
            'step'  => 1,
        ),
        'default' => 25
    );
    $choices = array(
        'freestore-page-fimage-layout-none' => __( 'None', 'freestore' ),
        'freestore-page-fimage-layout-standard' => __( 'Standard', 'freestore' ),
        'freestore-page-fimage-layout-banner' => __( 'Page Banner', 'freestore' )
    );
    $options['freestore-page-fimage-layout'] = array(
        'id' => 'freestore-page-fimage-layout',
        'label'   => __( 'Featured Image Layout', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-page-fimage-layout-none'
    );
    $choices = array(
        'freestore-page-fimage-size-extra-small' => __( 'Extra Small Banner', 'freestore' ),
        'freestore-page-fimage-size-small' => __( 'Small Banner', 'freestore' ),
        'freestore-page-fimage-size-medium' => __( 'Medium Banner', 'freestore' ),
        'freestore-page-fimage-size-large' => __( 'Large Banner', 'freestore' ),
        'freestore-page-fimage-size-actual' => __( 'Use Proper Image', 'freestore' )
    );
    $options['freestore-page-fimage-size'] = array(
        'id' => 'freestore-page-fimage-size',
        'label'   => __( 'Page Banner Size', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-page-fimage-size-medium'
    );
    $options['freestore-page-fimage-fullwidth'] = array(
        'id' => 'freestore-page-fimage-fullwidth',
        'label'   => __( 'Full Width Banner', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    
    $section = 'freestore-panel-layout-section-blog';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog', 'freestore' ),
        'priority' => '60',
        'panel' => $panel
    );
    
    $choices = array(
        'blog-post-standard-layout' => __( 'Standard Layout', 'freestore' ),
        'blog-post-right-layout' => __( 'Right Aligned Layout', 'freestore' ),
        'blog-post-alt-layout' => __( 'Alternate Layout', 'freestore' ),
        'blog-post-top-layout' => __( 'Top Layout', 'freestore' )
    );
    $options['freestore-blog-layout'] = array(
        'id' => 'freestore-blog-layout',
        'label'   => __( 'Blog Posts Layout', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-post-standard-layout'
    );
    $options['freestore-blog-cats'] = array(
        'id' => 'freestore-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br /><br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.<br /><br />Get the ID at <b>Posts -> Categories</b>.', 'freestore' )
    );
    
    $options['freestore-blog-left-sidebar'] = array(
        'id' => 'freestore-blog-left-sidebar',
        'label'   => __( 'Blog Left Sidebar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-archive-left-sidebar'] = array(
        'id' => 'freestore-blog-archive-left-sidebar',
        'label'   => __( 'Blog Archive/Categories Left Sidebar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-single-left-sidebar'] = array(
        'id' => 'freestore-blog-single-left-sidebar',
        'label'   => __( 'Blog Single Pages Left Sidebar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-search-left-sidebar'] = array(
        'id' => 'freestore-blog-search-left-sidebar',
        'label'   => __( 'Search Results Left Sidebar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    $options['freestore-blog-full-width'] = array(
        'id' => 'freestore-blog-full-width',
        'label'   => __( 'Blog Full Width', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-archive-full-width'] = array(
        'id' => 'freestore-blog-archive-full-width',
        'label'   => __( 'Blog Archive/Categories Full Width', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-single-full-width'] = array(
        'id' => 'freestore-blog-single-full-width',
        'label'   => __( 'Blog Single Pages Full Width', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-blog-search-full-width'] = array(
        'id' => 'freestore-blog-search-full-width',
        'label'   => __( 'Search Results Full Width', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-remove-cat-pre-title'] = array(
        'id' => 'freestore-remove-cat-pre-title',
        'label'   => __( 'Remove pre-text before Archive Pages Title', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'This will not update in the Customizer. Exit the Customizer to view the change', 'freestore' ),
        'default' => 0,
    );
    
    
    $section = 'freestore-panel-layout-section-footer';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer', 'freestore' ),
        'priority' => '70',
        'panel' => $panel
    );
    
    $choices = array(
        'freestore-footer-layout-standard' => __( 'Standard Layout', 'freestore' ),
        'freestore-footer-layout-centered' => __( 'Centered Layout', 'freestore' ),
        'freestore-footer-layout-social' => __( 'Social Layout', 'freestore' ),
        'freestore-footer-layout-none' => __( 'None', 'freestore' )
    );
    $options['freestore-footer-layout'] = array(
        'id' => 'freestore-footer-layout',
        'label'   => __( 'Footer Layout', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'freestore-footer-layout-social'
    );
    
    $options['freestore-footer-bottombar'] = array(
        'id' => 'freestore-footer-bottombar',
        'label'   => __( 'Remove the Bottom Bar', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['freestore-footer-hide-social'] = array(
        'id' => 'freestore-footer-hide-social',
        'label'   => __( 'Remove Social Links', 'freestore' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
	
	// WooCommerce style Layout
    if ( freestore_is_woocommerce_activated() ) :
    	
        $section = 'freestore-panel-layout-section-WooCommerce';

        $sections[] = array(
            'id' => $section,
            'title' => __( 'WooCommerce', 'freestore' ),
            'priority' => '80',
            'panel' => $panel
        );
        
        $options['freestore-header-remove-cart'] = array(
            'id' => 'freestore-header-remove-cart',
            'label'   => __( 'Remove WooCommerce Cart', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        
        $options['freestore-remove-product-border'] = array(
            'id' => 'freestore-remove-product-border',
            'label'   => __( 'Remove Product Border', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        $choices = array(
            '2' => __( '2', 'freestore' ),
            '3' => __( '3', 'freestore' ),
            '4' => __( '4', 'freestore' ),
            '5' => __( '5', 'freestore' )
        );
        $options['freestore-woocommerce-custom-cols'] = array(
            'id' => 'freestore-woocommerce-custom-cols',
            'label'   => __( 'Product Columns', 'freestore' ),
            'section' => $section,
            'type'    => 'select',
            'choices' => $choices,
            'default' => '4'
        );
        $options['freestore-woocommerce-products-per-page'] = array(
            'id' => 'freestore-woocommerce-products-per-page',
            'label'   => __( 'Products Per Page', 'freestore' ),
            'section' => $section,
            'type'    => 'number',
            'default' => 8
        );
        
        $options['freestore-woocommerce-shop-leftsidebar'] = array(
            'id' => 'freestore-woocommerce-shop-leftsidebar',
            'label'   => __( 'Shop Page Left Sidebar', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        $options['freestore-woocommerce-shop-archive-leftsidebar'] = array(
            'id' => 'freestore-woocommerce-shop-archive-leftsidebar',
            'label'   => __( 'Shop Archives/Categories Left Sidebar', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        $options['freestore-woocommerce-shop-single-leftsidebar'] = array(
            'id' => 'freestore-woocommerce-shop-single-leftsidebar',
            'label'   => __( 'Shop Single Pages Left Sidebar', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        $options['freestore-woocommerce-shop-fullwidth'] = array(
			'id' => 'freestore-woocommerce-shop-fullwidth',
			'label'   => __( 'Shop Page Full Width', 'freestore' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => 0,
		);
        $options['freestore-woocommerce-shop-archive-fullwidth'] = array(
            'id' => 'freestore-woocommerce-shop-archive-fullwidth',
            'label'   => __( 'Shop Archives/Categories Full Width', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        $options['freestore-woocommerce-shop-single-fullwidth'] = array(
            'id' => 'freestore-woocommerce-shop-single-fullwidth',
            'label'   => __( 'Shop Single Pages Full Width', 'freestore' ),
            'section' => $section,
            'type'    => 'checkbox',
            'default' => 0,
        );
        
    endif;
    
    
    $panel = 'freestore-panel-text';
    
    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Theme Fonts/Text', 'freestore' ),
        'priority' => '40'
    );
    
    $section = 'freestore-panel-text-section-fonts';
    $font_choices = customizer_library_get_font_choices();

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Fonts', 'freestore' ),
        'priority' => '20',
        'panel' => $panel
    );
	
    $options['freestore-body-font'] = array(
        'id' => 'freestore-body-font',
        'label'   => __( 'Body Font', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['freestore-body-font-color'] = array(
        'id' => 'freestore-body-font-color',
        'label'   => __( 'Body Font Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );

    $options['freestore-heading-font'] = array(
        'id' => 'freestore-heading-font',
        'label'   => __( 'Heading Font', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Lato'
    );
    $options['freestore-heading-font-color'] = array(
        'id' => 'freestore-heading-font-color',
        'label'   => __( 'Heading Font Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    $section = 'freestore-panel-text-section-title';
    $font_choices = customizer_library_get_font_choices();

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Title/Tagline', 'freestore' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['freestore-title-font'] = array(
        'id' => 'freestore-title-font',
        'label'   => __( 'Site Title Font', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Lato'
    );
    $options['freestore-title-font-size'] = array(
        'id' => 'freestore-title-font-size',
        'label'   => __( 'Site Title Size', 'freestore' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 48,
    );
    $options['freestore-tagline-font'] = array(
        'id' => 'freestore-tagline-font',
        'label'   => __( 'Site Tagline Font', 'freestore' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Lato'
    );
    $options['freestore-tagline-font-size'] = array(
        'id' => 'freestore-tagline-font-size',
        'label'   => __( 'Site Tagline Size', 'freestore' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 14,
    );
    $options['freestore-logo-padding-top'] = array(
        'id' => 'freestore-logo-padding-top',
        'label'   => __( 'Site Logo Top Padding', 'freestore' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 0,
    );
    $options['freestore-logo-padding-bottom'] = array(
        'id' => 'freestore-logo-padding-bottom',
        'label'   => __( 'Site Logo Bottom Padding', 'freestore' ),
        'section' => $section,
        'type'    => 'number',
        'default' => 0,
    );
    
    
    $section = 'freestore-panel-text-section-header';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header', 'freestore' ),
        'priority' => '40',
        'panel' => $panel
    );
    
    $options['freestore-website-site-add'] = array(
        'id' => 'freestore-website-site-add',
        'label'   => __( 'Address', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Cape Town, South Africa', 'freestore' ),
        'description' => __( 'This address is used in the Header top bar and in the Social footer layout', 'freestore' )
    );
    $options['freestore-website-head-no'] = array(
        'id' => 'freestore-website-head-no',
        'label'   => __( 'Phone Number', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Call Us: +2782 444 YEAH', 'freestore' )
    );
    
    $options['freestore-website-search-txt'] = array(
        'id' => 'freestore-website-search-txt',
        'label'   => __( 'Search Placeholder Text', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Search &amp; hit enter&hellip;', 'freestore' )
    );
    
    $section = 'freestore-panel-text-section-pages';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Error 404 / Search Results', 'freestore' ),
        'priority' => '50',
        'panel' => $panel
    );
    
    $options['freestore-website-error-head'] = array(
        'id' => 'freestore-website-error-head',
        'label'   => __( '404 Error Page Heading', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'freestore'),
        'description' => __( 'Enter the heading for the 404 Error page', 'freestore' )
    );
    $options['freestore-website-error-msg'] = array(
        'id' => 'freestore-website-error-msg',
        'label'   => __( 'Error 404 Message', 'freestore' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'freestore'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'freestore' )
    );
    $options['freestore-website-nosearch-head'] = array(
        'id' => 'freestore-website-nosearch-head',
        'label'   => __( 'No Results Heading', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Nothing Found', 'freestore'),
        'description' => __( 'Enter the header for when no search results are found', 'freestore' )
    );
    $options['freestore-website-nosearch-msg'] = array(
        'id' => 'freestore-website-nosearch-msg',
        'label'   => __( 'No Results Text', 'freestore' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'freestore'),
        'description' => __( 'Enter the default text for when no search results are found', 'freestore' )
    );
    
    $section = 'freestore-panel-text-section-footer';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer', 'freestore' ),
        'priority' => '60',
        'panel' => $panel
    );
    
    $options['freestore-website-txt-copy'] = array(
        'id' => 'freestore-website-txt-copy',
        'label'   => __( 'Attribution Text', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'freestore theme, by Kaira', 'freestore')
    );
    
    $options['freestore-help-donate'] = array(
        'id' => 'freestore-help-donate',
        'section' => $section,
        'type'    => 'donate',
        'description' => __( 'Donating to FreeStore will help with development of this theme and help turn it into a Power Theme', 'freestore' )
    );
    

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'freestore' ),
		'priority' => '50'
	);
    
    $options['freestore-boxed-bg-color'] = array(
        'id' => 'freestore-boxed-bg-color',
        'label'   => __( 'Boxed Background Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => '#FFFFFF',
    );
    
    $options['freestore-topbar-bg-color'] = array(
        'id' => 'freestore-topbar-bg-color',
        'label'   => __( 'Top Bar Background Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $topbar_bg_color,
    );
    $options['freestore-topbar-font-color'] = array(
        'id' => 'freestore-topbar-font-color',
        'label'   => __( 'Top Bar Font Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $topbar_font_color,
    );
	$options['freestore-header-bg-color'] = array(
		'id' => 'freestore-header-bg-color',
		'label'   => __( 'Header Background Color', 'freestore' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $header_bg_color,
	);
    $options['freestore-header-font-color'] = array(
        'id' => 'freestore-header-font-color',
        'label'   => __( 'Header Font Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $header_font_color,
    );
    
    $options['freestore-primary-color'] = array(
        'id' => 'freestore-primary-color',
        'label'   => __( 'Primary Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $primary_color,
    );

	$options['freestore-secondary-color'] = array(
		'id' => 'freestore-secondary-color',
		'label'   => __( 'Secondary Color', 'freestore' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    
    $options['freestore-footer-bg-color'] = array(
        'id' => 'freestore-footer-bg-color',
        'label'   => __( 'Footer Background Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $footer_bg_color,
    );
    $options['freestore-footer-font-color'] = array(
        'id' => 'freestore-footer-font-color',
        'label'   => __( 'Footer Font Color', 'freestore' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $footer_font_color,
    );
    
    
	// Social Settings
    $section = 'freestore-social-section';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'freestore' ),
        'priority' => '60'
    );
    
    $options['freestore-social-email'] = array(
        'id' => 'freestore-social-email',
        'label'   => __( 'Email Address', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-skype'] = array(
        'id' => 'freestore-social-skype',
        'label'   => __( 'Skype Name', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-facebook'] = array(
        'id' => 'freestore-social-facebook',
        'label'   => __( 'Facebook', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-twitter'] = array(
        'id' => 'freestore-social-twitter',
        'label'   => __( 'Twitter', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-google-plus'] = array(
        'id' => 'freestore-social-google-plus',
        'label'   => __( 'Google Plus', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-snapchat'] = array(
        'id' => 'freestore-social-snapchat',
        'label'   => __( 'SnapChat', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-etsy'] = array(
        'id' => 'freestore-social-etsy',
        'label'   => __( 'Etsy', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-yelp'] = array(
        'id' => 'freestore-social-yelp',
        'label'   => __( 'Yelp', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-youtube'] = array(
        'id' => 'freestore-social-youtube',
        'label'   => __( 'YouTube', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-instagram'] = array(
        'id' => 'freestore-social-instagram',
        'label'   => __( 'Instagram', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-pinterest'] = array(
        'id' => 'freestore-social-pinterest',
        'label'   => __( 'Pinterest', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-medium'] = array(
        'id' => 'freestore-social-medium',
        'label'   => __( 'Medium', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-behance'] = array(
        'id' => 'freestore-social-behance',
        'label'   => __( 'Behance', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-product-hunt'] = array(
        'id' => 'freestore-social-product-hunt',
        'label'   => __( 'Product Hunt', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-slack'] = array(
        'id' => 'freestore-social-slack',
        'label'   => __( 'Slack', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-linkedin'] = array(
        'id' => 'freestore-social-linkedin',
        'label'   => __( 'LinkedIn', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-tumblr'] = array(
        'id' => 'freestore-social-tumblr',
        'label'   => __( 'Tumblr', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-flickr'] = array(
        'id' => 'freestore-social-flickr',
        'label'   => __( 'Flickr', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-houzz'] = array(
        'id' => 'freestore-social-houzz',
        'label'   => __( 'Houzz', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-vk'] = array(
        'id' => 'freestore-social-vk',
        'label'   => __( 'VK', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-tripadvisor'] = array(
        'id' => 'freestore-social-tripadvisor',
        'label'   => __( 'TripAdvisor', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-github'] = array(
        'id' => 'freestore-social-github',
        'label'   => __( 'GitHub', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['freestore-social-custom-class'] = array(
        'id' => 'freestore-social-custom-class',
        'label'   => __( 'Add a Custom Social Link', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Add your own social icon by pasting the corrent <a href="http://fontawesome.io/icons/#brand" target="_blank">Font Awesome</a> class here<br />Eg: "fa-facebook"', 'freestore' ),
    );
    $options['freestore-social-custom-url'] = array(
        'id' => 'freestore-social-custom-url',
        'label'   => __( 'Add the URL', 'freestore' ),
        'section' => $section,
        'type'    => 'text',
    );
    
    
	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();
}
add_action( 'init', 'customizer_library_freestore_options' );
