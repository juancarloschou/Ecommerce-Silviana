<?php	
  /**
  * @Theme Name	:	rambo
  * @file         :	home.php
  * @package      :	rambo
  * @author       :	webriti
  * @license      :	license.txt
  * @filesource   :	wp-content/themes/rambo/home.php
  */ 
  		
	$rambo_pro_theme_options = theme_data_setup();
	$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
	
	if ( isset($current_options['front_page']) && $current_options['front_page'] == true ) {
	get_template_part('template','frontpage');
	}
  	else {
		get_template_part('index');
	}
  ?>