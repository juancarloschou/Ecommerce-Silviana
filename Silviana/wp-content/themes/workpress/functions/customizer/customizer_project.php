<?php
function Workpress_project_customizer( $wp_customize ) {
//Project panel
	$wp_customize->add_panel( 'project_panel' , array(
	'title'      => __('Project section', 'workpress'),
	'capability'     => 'edit_theme_options',
	'priority'   => 540,
   	) );

		//Project panel
				$wp_customize->add_section( 'Workpress_project_settings' , array(
				'title'      => __('Settings', 'workpress'),
				'panel'  => 'project_panel',
				'priority'   => 2,
				) );
			
			
			
			// enable project section
			$wp_customize->add_setting('rambo_pro_theme_options[workpress_project_protfolio_enabled]',array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'workpress_project_sanitize_checkbox',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[workpress_project_protfolio_enabled]',array(
			'label' => __('Hide Project section','workpress'),
			'section' => 'Workpress_project_settings',
			'type' => 'checkbox',
			) );
			
			// Number of services
			$wp_customize->add_setting('rambo_pro_theme_options[Workpress_project_column_layout]',array(
			'default' => 3,
			'type' => 'option',
			'sanitize_callback' => 'workpress_sanitize_select',
			) );

			$wp_customize->add_control('rambo_pro_theme_options[Workpress_project_column_layout]',array(
			'type' => 'select',
			'label' => __('Select column layout','workpress'),
			'section' => 'Workpress_project_settings',
			'choices' => array(1=>'1',2=>'2',3=>'3'),
			) );

}
add_action( 'customize_register', 'Workpress_project_customizer' );

function workpress_project_sanitize_checkbox( $input ){
	return ( isset( $input ) && true == $input ? true : false );
}

function workpress_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
?>