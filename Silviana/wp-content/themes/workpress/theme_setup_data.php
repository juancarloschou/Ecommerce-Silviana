<?php
/*---------------------------------------------------------------------------------*
 * @file           theme_stup_data.php
 * @package        Rambopro
 * @copyright      2013 webriti
 * @license        license.txt
 * @author       :	webriti
 * @filesource     wp-content/themes/workpress/theme_setup_data.php
 *	Admin  & front end defual data file 
 *-----------------------------------------------------------------------------------*/ 
function workpress_theme_data_setup()
{
	return $workpress_theme_options  = array(
			
			 // Service
			 'workpress_service_enabled' => false,
 			 'workpress_service_column_layout' => 3,
			
			// Project
			 'workpress_project_protfolio_enabled' => false,
			 'workpress_project_column_layout'=> 3,

		);
}
?>