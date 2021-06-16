<?php
function rambo_copyright_customizer( $wp_customize ) {
	
/* copyright */
	$wp_customize->add_panel( 'copyrightpanel', array(
		'priority'       => 610,
		'capability'     => 'edit_theme_options',
		'title'      => __('Footer copyright settings', 'rambo'),
	) );
	
	//Custom css
	$wp_customize->add_section( 'copyrightsection' , array(
		'title'      => __('Copyright text', 'rambo'),
		'panel'  => 'copyrightpanel',
		'priority'   => 1,
   	) );
	
	$wp_customize->add_setting('rambo_pro_theme_options[footer_copyright]', array(
        'sanitize_callback' => 'rambo_copyright_sanitize_html',
		'default'        => sprintf(__('Copyright @ 2014 - RAMBO. Designed by <a href="http://webriti.com" rel="nofollow" target="_blank"> Webriti</a>','rambo')),
        'capability'     => 'edit_theme_options',
		'type'=> 'option',
		
    ));
	
    $wp_customize->add_control( 'rambo_pro_theme_options[footer_copyright]', array(
        'label'   => __('Copyright text','rambo'),
        'section' => 'copyrightsection',
        'type' => 'textarea',
    ));
	
	function rambo_copyright_sanitize_html( $input ) {
					return force_balance_tags( $input );
				}
	
}
add_action( 'customize_register', 'rambo_copyright_customizer' );


/**
 * Add selective refresh for Copyright section controls.
 */
function rambo_register_copyright_section_partials( $wp_customize ) {
	
				 $wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[footer_copyright]', array(
		'selector'            => '.footer-section .span8 p',
		'settings'            => 'rambo_pro_theme_options[footer_copyright]',
	
	) );				 
}		 
add_action( 'customize_register', 'rambo_register_copyright_section_partials' );