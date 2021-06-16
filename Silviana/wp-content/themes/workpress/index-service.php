<?php
/**
* @Theme Name	:	Rambopro
* @file         :	index-service.php
* @package      :	Rambopro
* @author       :	Hari Maliya
* @license      :	license.txt
* @filesource   :	wp-content/themes/rambopro/index-service.php
*/
$rambo_pro_theme_options = workpress_theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
if($current_options['workpress_service_enabled']==false)
{
?>
<div class="home_service_section">
	<div class="container">
	 <?php
		$rambo_pro_theme_options = theme_data_setup();
		$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
		if( $current_options['service_section_title'] != '' || $current_options['service_section_descritpion'] != ''){ ?>
		<div class="row-fluid featured_port_title">
		
		<?php if( $current_options['service_section_title'] != '') { ?>
			<h1><?php echo esc_attr($current_options['service_section_title']); ?></h1>
		<?php } ?>
		
		<?php if( $current_options['service_section_descritpion'] != '') { ?>	
			<p><?php echo esc_attr($current_options['service_section_descritpion']); ?></p>
	 <?php } ?>
		
		</div>
	 <?php }?>
		<!-- /Home Service Section -->
		<?php
		if(is_active_sidebar('workpress-sidebar-service'))
		{
			echo '<div id="sidebar-service" class="row sidebar-service">';
			dynamic_sidebar( 'workpress-sidebar-service' );
			echo '</div>';
		}
		?>
		<!-- /Home Service Section -->	
	</div>
</div>
<?php } ?>