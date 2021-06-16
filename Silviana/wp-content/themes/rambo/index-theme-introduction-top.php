<?php
/**
* @Theme Name	:	Rambopro
* @file         :	index-theme-introdunction-top.php
* @package      :	Busiprof
* @author       :	Hari Maliya
* @license      :	license.txt
* @filesource   :	wp-content/themes/rambopro/index-theme-introdunction-top.php
*/
$rambo_pro_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
?>
<!-- Purchase Now Section -->
<?php if( is_active_sidebar( 'site-intro-area' ) ): ?>
<div class="purchase_main_content">
	<div class="container">
	
		<?php
		
			echo '<div class="row purchase_now_content">';
			
				dynamic_sidebar( 'site-intro-area' );
				
			echo '</div>';
				
		?>
				
	
	</div>
	
</div>
<?php endif; ?>


<!-- /Purchase Now Section -->
