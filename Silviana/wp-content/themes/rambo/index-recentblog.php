<?php
$rambo_pro_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
if( $current_options['news_enable'] == false )
{
?>
<div class="container">
		<?php
			if( is_active_sidebar('sidebar-news') )
			{
				dynamic_sidebar('sidebar-news');
			}
		?>
</div>	
<?php } ?>
<!-- /Latest News Section -->	