<?php
/*---------------------------------------------------------------------------------*
 * @file           theme_stup_data.php
 * @package        Rambopro
 * @copyright      2013 webriti
 * @license        license.txt
 * @author       :	webriti
 * @filesource     wp-content/themes/rambo-pro/theme_setup_data.php
 *	Admin  & front end defual data file 
 *-----------------------------------------------------------------------------------*/ 
function theme_data_setup()
{
	return $rambo_pro_theme_options  = array(
			//Logo and Fevicon header			
			'layout_selector' => 'wide',
			'rambopro_stylesheet'=>'default.css',			
			'upload_image_logo'=>'',
			'height'=>'50',
			'width'=>'150',
			'rambo_texttitle'=>true,
			'upload_image_favicon'=>'',
			'webrit_custom_css'=>'',
			'rambo_custom_css'=>'',
			
			//Home image section 	
			'home_banner_enabled'=>true,
			'home_custom_image' => '',								
			'home_image_title' => '',
			'home_image_description' => '',	
			'read_more_text' => '',
			'read_more_button_link' => '',
			'read_more_link_target' => true,
			
			// Site Intro Layout 
			'site_intro_column_layout' => 1,
			'site_intro_bottom_column_layout'=> 1,
			
			//Slide 	
			'home_slider_enabled'=>true,
			'slider_post' => '',
			
			// service
			'home_service_enabled'=>false,
			'service_list' => 4,
			
			// project 
			'home_projects_enabled' => false,
			'project_protfolio_enabled'=>false,
			'project_heading_one'=> '',
			'project_protfolio_tag_line'=>'',
			'project_tagline' =>'',
			// home project 
			 'project_list'=>4,
			
			//home latest news
			'post_display_count' => 3,
			'news_enable' => false,
			'home_slider_post_enable' => true,
			'blog_section_head' =>'',
			
			
			// site intro info 
			'site_info_enabled'=>true,
			'site_info_title'=>'',
			'site_info_descritpion' =>'',
			'site_info_button_text'=>'',
			'site_info_button_link'=>'#',
			'site_info_button_link_target' => true,
			
			
			// site intro info 			
			'site_intro_descritpion' =>'',
			'site_intro_button_text'=>'',
			'site_intro_button_link'=>'#',
			'intro_button_target'=>true,
			
			// Service section
			'service_section_title'=>'',
			'service_section_descritpion'=>'',
			
			/** footer customization **/
			'footer_copyright' => sprintf(__('Copyright @ 2014 - RAMBO. Designed by <a href="http://webriti.com" rel="nofollow" target="_blank"> Webriti</a>','rambo')),

			/* Footer social media */
			'footer_social_media_enabled'=>false,
			
			// footer customization
			'footer_widgets_enabled'=>'on',
			'rambo_copy_rights_text'=>'',			
			'rambo_designed_by_head'=>'',
			'rambo_designed_by_text'=>'',
			'rambo_designed_by_link'=>'',
			
			
			//Social media links
			'social_media_twitter_link' =>"#",
			'social_media_facebook_link' =>"#",
			'social_media_linkedin_link' =>"#",
			'social_media_google_plus' =>"#",
			
			//Service Layout
			'service_section_title'=> '',
			'service_section_description' => '',
			'service_column_layout'=> 4,
			
			//Project Layout
			'project_column_layout'  => 4,

			//News Column Layout
			'$news_column_layout' => 3,
			
			
			//Old Default Data
			
			// service
			'home_service_enabled'=>false,
			'home_service_one_icon'=>'',
			'home_service_one_title'=>'',
			'home_service_one_description'=> '',
			
			'home_service_two_icon'=>'',
			'home_service_two_title'=>'',
			'home_service_two_description'=> '',
			
			'home_service_three_icon'=>'',
			'home_service_three_title'=>'',
			'home_service_three_description'=>'',
			
			'home_service_fourth_icon'=>'',
			'home_service_fourth_title'=>'',
			'home_service_fourth_description'=>'',
			
			
			//Projects Section Settings
			'home_projects_enabled' => true,
			'project_one_thumb' => '',
			'project_one_title' => '',
			'project_one_text' => '',
		
		    'project_two_thumb' => '',
			'project_two_title' => '',
			'project_two_text' => '',
			
			'project_three_thumb' => '',
			'project_three_title' => '',
			'project_three_text' => '',
			
			'project_four_thumb' => '',
			'project_four_title' => '',
			'project_four_text' => '',

		);
}
?>