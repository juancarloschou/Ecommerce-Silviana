<?php
/**
 * Pleasant Lite About Theme
 *
 * @package Pleasant Lite
 */

//about theme info
add_action( 'admin_menu', 'pleasant_lite_abouttheme' );
function pleasant_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'pleasant-lite'), __('About Theme Info', 'pleasant-lite'), 'edit_theme_options', 'pleasant_lite_guide', 'pleasant_lite_mostrar_guide');   
} 

//guidline for about theme
function pleasant_lite_mostrar_guide() { 
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php _e('About Theme Info', 'pleasant-lite'); ?></h3>
		   </div>
        <p><?php _e('Pleasant Lite is a clean and modern free multipurpose WordPress theme. It is perfect for business, corporate, restaurant, photography, industrial, hotels or any type of industry. This beautiful free WordPress theme lets you to show everything about your business. It has various home page sections including homepage slider, welcome and services section. This theme supports widget areas for sidebar and footer section and also supports featured images for blog posts. This theme has default right sidebar and full width page template. It is very light weight theme and very easy to use and customize. With its setting, you can control homepage sections, change colors, use your own logo, use images for header and background. The theme is fully responsive and mobile friendly. This theme is SEO friendly, translation ready and compatible with popular WordPress Plugins.','pleasant-lite'); ?></p>
<div class="heading-gt"> <?php _e('Theme Features', 'pleasant-lite'); ?></div>
 

<div class="col-2">
  <h4><?php _e('Theme Customizer', 'pleasant-lite'); ?></h4>
  <div class="description"><?php _e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'pleasant-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php _e('Responsive Ready', 'pleasant-lite'); ?></h4>
  <div class="description"><?php _e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'pleasant-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('Cross Browser Compatible', 'pleasant-lite'); ?></h4>
<div class="description"><?php _e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE8 and above.', 'pleasant-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('E-commerce', 'pleasant-lite'); ?></h4>
<div class="description"><?php _e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'pleasant-lite'); ?></div>
</div>
<div style="height:5px"></div>
</div><!-- .gt-left -->
	
	<div class="gt-right">			
			<div style="font-weight:bold;">				
				<a href="<?php echo pleasant_lite_live_demo; ?>" target="_blank"><?php _e('Live Demo', 'pleasant-lite'); ?></a> | 				
				<a href="<?php echo pleasant_lite_theme_doc; ?>" target="_blank"><?php _e('Documentation', 'pleasant-lite'); ?></a>
                <div style="height:5px"></div>
				<hr />  
                <ul>
                 <li><?php _e('Theme Customizer', 'pleasant-lite'); ?></li>
                 <li><?php _e('Responsive Ready', 'pleasant-lite'); ?></li>
                 <li><?php _e('Cross Browser Compatible', 'pleasant-lite'); ?></li>
                 <li><?php _e('E-commerce', 'pleasant-lite'); ?></li>
                 <li><?php _e('Contact Form 7 Plugin Compatible', 'pleasant-lite'); ?></li>  
                 <li><?php _e('User Friendly', 'pleasant-lite'); ?></li> 
                 <li><?php _e('Translation Ready', 'pleasant-lite'); ?></li>
                 <li><?php _e('Many Other Plugins  Compatible', 'pleasant-lite'); ?></li>   
                </ul>              
               
			</div>		
	</div><!-- .gt-right-->
    <div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>