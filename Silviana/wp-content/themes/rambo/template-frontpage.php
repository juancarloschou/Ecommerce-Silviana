<?php
/*
Template Name: Business Template
*/	
	get_header();
  
  	/****** get index banner  ********/
  	get_template_part('index', 'banner') ;
  	
  	/****** get top callout  ********/
	get_template_part('index', 'theme-introduction-top');
	
	/****** get index service  ********/
  	get_template_part('index', 'service') ;
	
	/****** get index Projects  ********/
  	get_template_part('index', 'projects') ;
	
	/****** get index blog  ********/
  	echo '<div class="for_mobile">';
	get_template_part('index', 'recentblog') ;
	echo '</div>';
  	
  	/****** get footer section *********/
  	get_footer();  

?>