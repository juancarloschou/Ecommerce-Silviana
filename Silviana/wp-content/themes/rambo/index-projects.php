<?php
/**
* @Theme Name	:	Rambopro
* @file         :	index-project.php
* @package      :	Busiprof
* @author       :	Hari Maliya
* @license      :	license.txt
* @filesource   :	wp-content/themes/rambopro/index-project.php
*/
$rambo_pro_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
if($current_options['project_protfolio_enabled']==false)
{
?>
<!-- Recent Work Section -->
<div class="portfolio_main_content">	
	<div class="container">	
	<?php
	$rambo_pro_theme_options = theme_data_setup();
	$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
	if($current_options['project_heading_one'] || $current_options['project_tagline'] ) { ?>
	
		<div class="row-fluid featured_port_title">
			
			<?php if($current_options['project_heading_one']!='') { ?>
				<h1><?php echo $current_options['project_heading_one']; ?></h1>
			<?php } ?>
			
			<?php if($current_options['project_tagline']!='') { ?>
				<p><?php echo $current_options['project_tagline']; ?></p>
			<?php } ?>
			
		</div>
		
		<?php  } 
		else
		{ 
		$rambo_theme_options = theme_data_setup();
		$old_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
	?>
			<div class="row-fluid featured_port_title">
			<?php if($old_options['project_heading_one']) { ?>
			<h1><?php echo $old_options['project_heading_one']; ?></h1>
			<?php } ?>
			<?php if($old_options['project_tagline']) { ?>
			<p><?php echo $old_options['project_tagline']; ?></p>
			<?php } ?>
		</div>
		<?php }
		if(is_active_sidebar('sidebar-project'))
		{
			echo '<div id="sidebar-project " class="row sidebar-project">';
			dynamic_sidebar('sidebar-project');
			echo '</div>';
		}
			else
			{
				$rambo_theme_options = theme_data_setup();
				$current_options = wp_parse_args(  get_option( 'rambo_theme_options', array() ), $rambo_theme_options );
				
				echo '<div id="sidebar-project" class="row">';
				if(!empty($current_options)) {
					get_template_part('index','projectold');
				}	
				echo '</div>';
			}
		?>	
	</div>	
</div>
<?php } ?>	
<!-- /Recent Work Section -->	