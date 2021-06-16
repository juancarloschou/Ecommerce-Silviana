<?php
/**
 * beautiplus Theme Customizer
 *
 * @package Beautiplus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beautiplus_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class beautiplus_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#e80f6f',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','beautiplus'),			
			 'description'	=> __('More color options in PRO Version','beautiplus'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => __('Slider Settings', 'beautiplus'),
            'priority' => null,
			'description'	=> __('Featured Image Size Should be same ( 1400x600 ) More slider settings available in PRO Version.','beautiplus'),            			
        )
    );
	
	
	$wp_customize->add_setting('page-setting7',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','beautiplus'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','beautiplus'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','beautiplus'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('slider_readmore',array(
	 		'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	 ));
	 
	 $wp_customize->add_control('slider_readmore',array(
	 		'settings'	=> 'slider_readmore',
			'section'	=> 'slider_section',
			'label'		=> __('Add text for slide read more button','beautiplus'),
			'type'		=> 'text'
	 ));// Slider Read more	
	
	$wp_customize->add_setting('disabled_slides',array(
				'default' => true,
				'sanitize_callback' => 'sanitize_text_field',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_slides', array(
			   'settings' => 'disabled_slides',
			   'section'   => 'slider_section',
			   'label'     => __('Uncheck To Enable This Section','beautiplus'),
			   'type'      => 'checkbox'
	 ));//Disable Slider Section
	
	// Home Three Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> __('Homepage Three Boxes Section','beautiplus'),
		'description'	=> __('Select Pages from the dropdown for homepage three boxes section','beautiplus'),
		'priority'	=> null
	));	
	
	
	$wp_customize->add_setting('page-column1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column1',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));	
	
	
	$wp_customize->add_setting('page-column2',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column2',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column3',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));//end four column page boxes
	
	$wp_customize->add_setting('disabled_pgboxes',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_pgboxes', array(
			   'settings' => 'disabled_pgboxes',
			   'section'   => 'section_second',
			   'label'     => __('Uncheck To Enable This Section','beautiplus'),
			   'type'      => 'checkbox'
	 ));//Disable page boxes Section
	
	
	//Why Choose Us section
	$wp_customize->add_section('welcome_sec',array(
			'title'	=> __('Welcome Section','beautiplus'),
			'description'	=> __('Add your details here','beautiplus'),
			'priority'	=> null
	));	
	
	$wp_customize->add_setting('page-setting1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-setting1',array('type' => 'dropdown-pages',			
			'section' => 'welcome_sec',
	));
	
	$wp_customize->add_setting('disabled_welcomepage',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_welcomepage', array(
			   'settings' => 'disabled_welcomepage',
			   'section'   => 'welcome_sec',
			   'label'     => __('Uncheck To Enable This Section','beautiplus'),
			   'type'      => 'checkbox'
	 ));//Home Welcome Section 	
	
	
}
add_action( 'customize_register', 'beautiplus_customize_register' );

function beautiplus_custom_css(){
		?>
        	<style type="text/css"> 
					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,									
					.blog_lists h3 a:hover,
					.cols-4 ul li a:hover, .cols-4 ul li.current_page_item a,
					.recent-post h6:hover,					
					.fourbox:hover h3,
					.footer-icons a:hover,
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a, 
					.postmeta a:hover
					{ color:<?php echo esc_html( get_theme_mod('color_scheme','#e80f6f')); ?>;}
					 
					
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,					
					.nivo-controlNav a.active,
					.ReadMore:hover,
					.appbutton:hover,					
					.slide_info .slide_more,				
					h3.widget-title,									
					#sidebar .search-form input.search-submit,				
					.wpcf7 input[type='submit']					
					{ background-color:<?php echo esc_html( get_theme_mod('color_scheme','#e80f6f')); ?>;}
					
					
					.footer-icons a:hover							
					{ border-color:<?php echo esc_html( get_theme_mod('color_scheme','#e80f6f')); ?>;}					
					
					
			</style> 
<?php                       
}
         
add_action('wp_head','beautiplus_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beautiplus_customize_preview_js() {
	wp_enqueue_script( 'beautiplus_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'beautiplus_customize_preview_js' );