<?php
function rambo_scripts()
{	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	/*Template Color Scheme CSs*/
	/*Font Awesome CSS*/
	wp_enqueue_style('rambo-style', get_stylesheet_uri() );
	wp_enqueue_style ('bootstrap',WEBRITI_TEMPLATE_DIR_URI.'/css/bootstrap.css');
	//bootstrap css
	wp_enqueue_style('default', WEBRITI_TEMPLATE_DIR_URI . '/css/default.css');
	wp_enqueue_style ('font-awesome',WEBRITI_TEMPLATE_DIR_URI .'/css/font-awesome/css/font-awesome.css');

	wp_enqueue_style ('element',WEBRITI_TEMPLATE_DIR_URI.'/css/element.css');
	wp_enqueue_style ('bootstrap-responsive',WEBRITI_TEMPLATE_DIR_URI .'/css/bootstrap-responsive.css'); //boot rsp css
	wp_enqueue_style ('docs',WEBRITI_TEMPLATE_DIR_URI .'/css/docs.css'); //docs css
	
	/*Style Media Css*/
	wp_enqueue_style ('style-media',WEBRITI_TEMPLATE_DIR_URI .'/css/style-media.css'); //Style-Media
			
	//Template Color Scheme Js	
	wp_enqueue_script('bootstrap',WEBRITI_TEMPLATE_DIR_URI.'/js/menu/bootstrap.min.js',array('jquery'));
	wp_enqueue_script('Bootstrap-transtiton',WEBRITI_TEMPLATE_DIR_URI.'/js/menu/menu.js');
	
	wp_enqueue_script('Bootstrap-transtiton',WEBRITI_TEMPLATE_DIR_URI.'/js/bootstrap-transition.js');
	/*Color Schemes*/
	
	
	/******* webriti tab js*********/
	}
	add_action( 'wp_enqueue_scripts', 'rambo_scripts' );
	
	function rambo_registers() {

	wp_enqueue_script( 'rambo_customizer_script', get_template_directory_uri() . '/js/rambo_customizer.js', array("jquery"), '20120206', true  );
}
add_action( 'customize_controls_enqueue_scripts', 'rambo_registers' );	

add_action( 'admin_enqueue_scripts', 'rambo_enqueue_script_function' );
	function rambo_enqueue_script_function()
	{
	wp_enqueue_style('rambo-drag-drop',WEBRITI_TEMPLATE_DIR_URI.'/css/drag-drop.css');
	}
	
	add_action('wp_head','rambo_enqueue_custom_css');
	function rambo_enqueue_custom_css()
	{
	$rambo_theme_options = theme_data_setup();
	$rambo_current_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
	if($rambo_current_options['rambo_custom_css']!='') {  ?>
	<style type="text/css">
	<?php echo htmlspecialchars_decode($rambo_current_options['rambo_custom_css']); ?>
	</style>
	<?php } }?>