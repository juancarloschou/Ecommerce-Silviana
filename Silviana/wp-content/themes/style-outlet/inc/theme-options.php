<?php
require_once get_template_directory() . '/inc/options-config.php';
	if( ! class_exists('Style_outlet_Customizer_API_Wrapper') ) {
		require_once get_template_directory() . '/admin/class.style-outlet-customizer-api-wrapper.php';
	}


Style_outlet_Customizer_API_Wrapper::getInstance($options);
