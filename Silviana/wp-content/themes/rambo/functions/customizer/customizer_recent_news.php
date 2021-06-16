<?php
// customizer Recent News panel
function customizer_recent_news_panel( $wp_customize ) {

	//Recent News panel
	$wp_customize->add_panel( 'news_panel' , array(
	'title'      => __('News section', 'rambo'),
	'capability'     => 'edit_theme_options',
	'priority'   => 540,
   	) );
	
		//Recent News panel
		$wp_customize->add_section( 'news_settings' , array(
		'title'      => __('Settings', 'rambo'),
		'panel'  => 'news_panel',
		'priority'   => 1,
		) );
			
			// enable Recent News section
			$wp_customize->add_setting('rambo_pro_theme_options[news_enable]',array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[news_enable]',array(
			'label' => __('Hide news section','rambo'),
			'section' => 'news_settings',
			'type' => 'checkbox',
			) );
			
			
			//hide slider post 
			$wp_customize->add_setting(
			'rambo_pro_theme_options[home_slider_post_enable]',
			array(
				'default' => true,
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type' => 'option'
			)	
			);
			$wp_customize->add_control(
			'rambo_pro_theme_options[home_slider_post_enable]',
			array(
				'label' => __('Show slider post in latest news','rambo'),
				'section' => 'news_settings',
				'type' => 'checkbox',
			)
			);
}
add_action( 'customize_register', 'customizer_recent_news_panel' );