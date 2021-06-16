<?php
/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function rambo_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport = 'postMessage';
	
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.logo-title',
			'container_inclusive' => false,
			
		) );
		
		$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
			'selector' => '.navbar .brand',
			'settings' => 'custom_logo',
		));
		
	

	
}
add_action( 'customize_register', 'rambo_customize_register', 11 );