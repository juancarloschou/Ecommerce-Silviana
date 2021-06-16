<?php
function comley_themes_customizer($wp_customize) {
$comley_cat_array = array('');
	$get_categories=get_categories();
	if ($get_categories) {
		$comley_cat_array[] = '';
		foreach ( $get_categories as $get_categoriesvalues ) {
			$comley_cat_array[$get_categoriesvalues->term_id] = $get_categoriesvalues->name;
		}
	} else {
		$comley_cat_array["No content blocks found"] = 0;
	}
$wp_customize->add_section(
    'theme_setting_section',
    array(
        'title' => __('Themes Settings', 'comley'),
        'description' => esc_html__('This is a Themes Settings section.', 'comley'),
        'priority' => 35,
    )
);
$wp_customize->add_setting(
'front_placement',
array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh',
			)
);
 
$wp_customize->add_control(
'front_placement',
array(
    'type' => 'radio',
    'label' =>__('Front placement', 'comley'),
    'section' => 'theme_setting_section',
    'choices' => array(
        'banner' => esc_html__('Banner', 'comley'),
        'slider' => esc_html__('Slider', 'comley'),
    ),
)
);
/* Start Blog Setting Section */
$wp_customize->add_section(
    'blog_setting_section',
    array(
        'title' => __('Blog Settings', 'comley'),
        'description' => esc_html__('This is a Blog Settings section.', 'comley'),
        'priority' => 36,
    )
);
$wp_customize->add_setting(
'blog_layouts',
array(
'default' => 'blogwithrightsidebar',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
 
$wp_customize->add_control(
'blog_layouts',
array(
    'type' => 'radio',
    'label' => __('Blog Full Width', 'comley'),
    'section' => 'blog_setting_section',
    'choices' => array(
        'blogfullwidth' => esc_html__('Blog Full Width', 'comley'),
        'blogwithrightsidebar' => esc_html__('Blog with Right Sidebar', 'comley'),
        'blogwithleftsidebar' => esc_html__('Blog with Left Sidebar', 'comley')
    ),
)
);
$wp_customize->add_setting(
'blog_posts_layouts',
array(
'default' => 'postlayout',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
 
$wp_customize->add_control(
'blog_posts_layouts',
array(
    'type' => 'radio',
    'label' => __('Post Layout', 'comley'),
    'section' => 'blog_setting_section',
    'choices' => array(
        'gridlayout' => esc_html__('Grid Layout', 'comley'),
        'postlayout' => esc_html__('Standard Layout', 'comley'),
		'listlayout' => esc_html__('List Layout', 'comley')
    ),
)
);
/* End Blog Setting Section */
$wp_customize->add_setting(
'copyright_textbox',
array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'copyright_textbox',
array(
    'label' => __('Copyright text', 'comley'),
    'section' => 'theme_setting_section',
    'type' => 'textarea',
)
);
$wp_customize->add_setting(
'hide_copyright', array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'hide_copyright',
array(
    'type' => 'checkbox',
    'label' => __('Hide copyright text', 'comley'),
    'section' => 'theme_setting_section',
)
);
$wp_customize->add_setting(
'logo_placement',
array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
 
$wp_customize->add_control(
'logo_placement',
array(
    'type' => 'radio',
    'label' => __('Logo placement', 'comley'),
    'section' => 'theme_setting_section',
    'choices' => array(
        'left' => esc_html__('Left', 'comley'),
        'right' => esc_html__('Right', 'comley'),
        'center' => esc_html__('Center', 'comley'),
    ),
)
);
$wp_customize->add_setting(
'bgcolor-setting',
array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
    $wp_customize,
    'bgcolor-setting',
    array(
        'label' => __('Background Color Setting', 'comley'),
        'section' => 'theme_setting_section',
        'settings' => 'bgcolor-setting',
    )
)
);
$wp_customize->add_setting('bgimg-upload',array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
) );
 
$wp_customize->add_control(
new WP_Customize_Upload_Control(
    $wp_customize,
    'bgimg-upload',
    array(
        'label' => __('Banner Image Change', 'comley'),
        'section' => 'banner_section',
        'settings' => 'bgimg-upload'
    )
)
);
$wp_customize->add_setting(
'banner_title',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'banner_title',
array(
    'type' => 'text',
    'label' => __('Banner Title', 'comley'),
    'section' => 'banner_section',
)
);
$wp_customize->add_setting(
'banner_text',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));
$wp_customize->add_control(
'banner_text',
array(
    'type' => 'textarea',
    'label' => __('Banner Text', 'comley'),
    'section' => 'banner_section',
)
);
$wp_customize->add_section(
    'slider_section',
    array(
        'title' => __( 'Slider Section ', 'comley'),
        'description' => esc_html__('This is a Slider Settings section.', 'comley'),
        'priority' => 10,
    )
);
$wp_customize->add_section(
    'banner_section',
    array(
        'title' => __( 'Banner Section ', 'comley'),
        'description' => esc_html__('This is a Banner Settings section.', 'comley'),
        'priority' => 10,
    )
);
// Slide Image 03
$wp_customize->add_setting(
'slider_category',array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh',
			)
);
$wp_customize->add_control(
'slider_category',
array(
    'type' => 'select',
    'label' =>__('Slider Category', 'comley'),
	'choices' =>$comley_cat_array,
	'section' => 'slider_section',
)
);
}
add_action('customize_register', 'comley_themes_customizer');
function comley_customizer_social_media_array() {
 
	/* store social site names in array */
	$social_sites = array( 'facebook','twitter', 'linkedin', 'instagram','google-plus', 'flickr', 'pinterest', 'youtube', 'tumblr', 'dribbble', 'rss',  'email');
 
	return $social_sites;
}
/* add settings to create various social media text areas. */
add_action('customize_register', 'comley_add_social_sites_customizer');
function comley_add_social_sites_customizer($wp_customize) {
	$wp_customize->add_section('my_social_settings', array(
			'title'    => __('Social Media Icons', 'comley'),
			'priority' => 35,
	) );
	$social_sites = comley_customizer_social_media_array();
	$priority = 5;
	foreach($social_sites as $social_site) {
		$wp_customize->add_setting( "$social_site", array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control($social_site, array(
				'label'    =>$social_site.' '.__("url:", 'comley'),
				'section'  => 'my_social_settings',
				'type'     => 'text',
				'priority' => $priority,
		) );
		$priority = $priority + 5;
	}
}
?>