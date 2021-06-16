<?php
/**
 * Pleasant Lite Theme Customizer
 *
 * @package Pleasant Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pleasant_lite_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class pleasant_lite_Info extends WP_Customize_Control {
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
			'default'	=> '#00AADD',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','pleasant-lite'),			
			 'description'	=> __('More color options in PRO Version','pleasant-lite'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => __('Slider Settings', 'pleasant-lite'),
            'priority' => null,
            'description'	=> __('Featured Image Size Should be ( 1400x590 ) More slider settings available in PRO Version','pleasant-lite'),		
     ));	
	
	$wp_customize->add_setting('page-setting7',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','pleasant-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','pleasant-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','pleasant-lite'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('slider_readmore',array(
	 		'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	 ));
	 
	 $wp_customize->add_control('slider_readmore',array(
	 		'settings'	=> 'slider_readmore',
			'section'	=> 'slider_section',
			'label'		=> __('Add text for slide read more button','pleasant-lite'),
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
			   'label'     => __('Uncheck To Enable This Section','pleasant-lite'),
			   'type'      => 'checkbox'
	 ));//Disable Slider Section
	
	
	// Home What We Do Section 	
	$wp_customize->add_section('section_first',array(
		'title'	=> __('Homepage Welcome Section','pleasant-lite'),
		'description'	=> __('Select Page from the dropdown for welcome section','pleasant-lite'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('page-setting1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-setting1',array('type' => 'dropdown-pages',			
			'section' => 'section_first',
	));
	
	$wp_customize->add_setting('disabled_welcomepage',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_welcomepage', array(
			   'settings' => 'disabled_welcomepage',
			   'section'   => 'section_first',
			   'label'     => __('Uncheck To Enable This Section','pleasant-lite'),
			   'type'      => 'checkbox'
	 ));//Home Welcome Section 	
	
	// Home Three Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> __('Homepage Four Boxes Section','pleasant-lite'),
		'description'	=> __('Select Pages from the dropdown for homepage four boxes section','pleasant-lite'),
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
	));
	
	$wp_customize->add_setting('page-column4',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column4',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));	//end three column part
	
	$wp_customize->add_setting('disabled_pgboxes',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_pgboxes', array(
			   'settings' => 'disabled_pgboxes',
			   'section'   => 'section_second',
			   'label'     => __('Uncheck To Enable This Section','pleasant-lite'),
			   'type'      => 'checkbox'
	 ));//Disable page boxes Section	
    	
}
add_action( 'customize_register', 'pleasant_lite_customize_register' );

function pleasant_lite_custom_css(){
		?>
        	<style type="text/css"> 					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,								
					.cols-3 ul li a:hover, .cols-3 ul li.current_page_item a,									
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,					
					.headertop .left a:hover,
					.fourbox:hover h3,
					.headertop .left .fa,
					.headertop .social-icons a:hover,
					.contactdetail a:hover		
					{ color:<?php echo esc_html( get_theme_mod('color_scheme','#00AADD')); ?>;}
					 
					
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					h2.headingtitle:after,	
					.fourbox:hover .pagemore,
					.slidemore,				
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit']					
					{ background-color:<?php echo esc_html( get_theme_mod('color_scheme','#00AADD')); ?>;}
					
						
					.fourbox:hover .pagemore
					{ border-color:<?php echo esc_html( get_theme_mod('color_scheme','#00AADD')); ?>;}
					
			</style> 
<?php               
}
         
add_action('wp_head','pleasant_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pleasant_lite_customize_preview_js() {
	wp_enqueue_script( 'pleasant_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20161025', true );
}
add_action( 'customize_preview_init', 'pleasant_lite_customize_preview_js' );