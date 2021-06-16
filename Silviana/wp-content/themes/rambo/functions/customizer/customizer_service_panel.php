<?php
// customizer serive panel
function service_customizer_service_panel( $wp_customize ) {

$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

	//Service panel
	$wp_customize->add_panel( 'service_panel' , array(
	'title'      => __('Service section', 'rambo'),
	'capability'     => 'edit_theme_options',
	'priority'   => 530,
   	) );
	
		//Service panel
		$wp_customize->add_section( 'service_settings' , array(
		'title'      => __('Settings', 'rambo'),
		'panel'  => 'service_panel',
		'priority'   => 1,
		) );
			
			// enable service section
			$wp_customize->add_setting('rambo_pro_theme_options[home_service_enabled]',array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[home_service_enabled]',array(
			'label' => __('Hide service section','rambo'),
			'section' => 'service_settings',
			'type' => 'checkbox',
			) );
			
			// Number of services
			$wp_customize->add_setting('rambo_pro_theme_options[service_column_layout]',array(
			'default' => 4,
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control('rambo_pro_theme_options[service_column_layout]',array(
			'type' => 'select',
			'label' => __('Select column layout','rambo'),
			'section' => 'service_settings',
			'choices' => array(1=>'1',2=>'2',3=>'3',4=>'4'),
			) );
		
		// headings
		$wp_customize->add_section( 'service_headings' , array(
		'title'      => __('Section Header', 'rambo'),
		'panel'  => 'service_panel',
		'priority'   => 2,
		) );
			
			// Service title
			$wp_customize->add_setting('rambo_pro_theme_options[service_section_title]',array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_service_sanitize_html',
			'type' => 'option',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[service_section_title]',array(
			'label' => __('Title','rambo'),
			'section' => 'service_headings',
			'type' => 'text',
			) );
			
			// service description
			$wp_customize->add_setting('rambo_pro_theme_options[service_section_descritpion]',array(
			'default' => '',
			'sanitize_callback' => 'rambo_service_sanitize_html',
			'type' => 'option',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[service_section_descritpion]',array(
			'label' => __('Description','rambo'),
			'section' => 'service_headings',
			'type' => 'textarea',
			) );
			
			
			
			function rambo_service_sanitize_html( $input ) {
				return force_balance_tags( $input );
			}
			
			
}
add_action( 'customize_register', 'service_customizer_service_panel' );

/**
 * Add selective refresh for service title section controls.
 */
function rambo_register_service_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[service_section_title]', array(
		'selector'            => '.home_service_section .featured_port_title h1',
		'settings'            => 'rambo_pro_theme_options[service_section_title]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[service_section_descritpion]', array(
		'selector'            => '.home_service_section .featured_port_title p',
		'settings'            => 'rambo_pro_theme_options[service_section_descritpion]',
	
	) );
}
add_action( 'customize_register', 'rambo_register_service_section_partials' );
?>