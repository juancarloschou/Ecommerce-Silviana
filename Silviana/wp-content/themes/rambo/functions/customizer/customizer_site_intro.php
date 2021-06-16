<?php
function rambo_site_intro_customizer( $wp_customize ) {
/* Site Intro Panel */
	$wp_customize->add_panel( 'site_intro' , array(
			'title'      => __('Call to action top', 'rambo'),
			'priority'   => 520,
		) );
		
			
		//Site Intro Section
		$wp_customize->add_section('site_intro_settings' , array(
		'title'      => __('Settings', 'rambo'),
		'panel'  => 'site_intro',
		'priority'   => 1,
		) );
		
			// Site Intro Column Layout
			$wp_customize->add_setting('rambo_pro_theme_options[site_intro_column_layout]',array(
			'default' => 1,
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control('rambo_pro_theme_options[site_intro_column_layout]',array(
			'type' => 'select',
			'label' => __('Select column layout','rambo'),
			'section' => 'site_intro_settings',
			'choices' => array(1=>'1',2=>'2',3=>'3',4=>'4'),
			) );	
}
add_action( 'customize_register', 'rambo_site_intro_customizer' );
?>