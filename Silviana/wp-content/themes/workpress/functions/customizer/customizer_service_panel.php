<?php
// customizer serive panel
function workpress_customizer_service_panel( $wp_customize ) {

	//Service panel
	$wp_customize->add_panel( 'service_panel' , array(
	'title'      => __('Service section', 'workpress'),
	'capability'     => 'edit_theme_options',
	'priority'   => 530,
   	) );
	
		//Service panel
		$wp_customize->add_section( 'workpress_service_settings' , array(
		'title'      => __('Settings', 'workpress'),
		'panel'  => 'service_panel',
		'priority'   => 1,
		) );
			
			
			// enable service section
			$wp_customize->add_setting('rambo_pro_theme_options[workpress_service_enabled]',array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'workpress_sanitize_service_checkbox',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[workpress_service_enabled]',array(
			'label' => __('Hide Service section','workpress'),
			'section' => 'workpress_service_settings',
			'type' => 'checkbox',
			) );
			
			// Number of services
			$wp_customize->add_setting('rambo_pro_theme_options[workpress_service_column_layout]',array(
			'default' => 3,
			'type' => 'option',
			'sanitize_callback' => 'workpress_service_sanitize_select',
			) );

			$wp_customize->add_control('rambo_pro_theme_options[workpress_service_column_layout]',array(
			'type' => 'select',
			'label' => __('Select column layout','workpress'),
			'section' => 'workpress_service_settings',
			'choices' => array(1=>'1',2=>'2',3=>'3'),
			) );
}
add_action( 'customize_register', 'workpress_customizer_service_panel' );

function workpress_sanitize_service_checkbox( $input ){
	return ( isset( $input ) && true == $input ? true : false );
}

function workpress_service_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
?>