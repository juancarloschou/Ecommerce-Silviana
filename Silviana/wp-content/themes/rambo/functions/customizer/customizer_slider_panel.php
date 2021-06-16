<?php
function rambo_home_slider_customizer($wp_customize){
	
	/* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts('posts_per_page=-1');
    $options_posts[''] = __( 'Choose Post','rambo' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
	
	
		
/* Header Section */
	$wp_customize->add_panel( 'slider_setting', array(
		'capability'     => 'edit_theme_options',
		'priority'   => 510,
		'title'      => __('Slider section', 'rambo'),
	) );

	$wp_customize->add_section(
        'slider_section_settings',
        array(
            'title' => __('Settings','rambo'),
            'description' => '',
			'panel'  => 'slider_setting',)
    );
	
			//Hide slider
			
			$wp_customize->add_setting(
			'rambo_pro_theme_options[home_banner_enabled]',
			array(
				'default' => true,
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type' => 'option',
			)	
			);
			$wp_customize->add_control(
			'rambo_pro_theme_options[home_banner_enabled]',
			array(
				'label' => __('Enable home slider','rambo'),
				'section' => 'slider_section_settings',
				'type' => 'checkbox',
				'description' => __('Enable slider on front page.','rambo'),
			));
			
			//Select Post One
			$wp_customize->add_setting('rambo_pro_theme_options[slider_post]',array(
				'capability'=>'edit_theme_options',
				'sanitize_callback'=>'sanitize_text_field',
				'type' => 'option',
			));
			
			$wp_customize->add_control('rambo_pro_theme_options[slider_post]',array(
				'label' => __('Select post','rambo'),
				'section'=>'slider_section_settings',
				'type'=>'select',
				'choices'=>$options_posts,
			));	
}
add_action( 'customize_register', 'rambo_home_slider_customizer' );
?>