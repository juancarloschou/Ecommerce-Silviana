<?php
//Adding CSS inline style to an existing CSS stylesheet
function comley_add_inline_css() {
	     $comley_custom_css='';
        //All the user input CSS settings as set in the plugin settings
		if(get_theme_mod('bgimg-upload' )){
        $comley_custom_css.= "
            #banner{ display:block; text-align:center; position: relative; background:url(".esc_url(get_theme_mod('bgimg-upload')).") center top no-repeat; background-size:cover; height:490px;  }";
		}if(get_theme_mod('bgcolor-setting'))
		{
			$comley_custom_css.= "body{background-color:".esc_html(get_theme_mod('bgcolor-setting'))."}";
		}else 
		{
		   $comley_custom_css.= "body{background-color:#fff}";	
		}
		$header_image = get_header_image(); if($header_image!=''){
			$comley_custom_css.= ".main-header { background-image:url(".esc_url($header_image).");}";
		}
  //Add the above custom CSS via wp_add_inline_style
  wp_add_inline_style('comley-style', $comley_custom_css); //Pass the variable into the main style sheet ID
}
add_action('wp_enqueue_scripts', 'comley_add_inline_css'); //Enqueue the CSS style
?>