<!-- Widgets Section -->
<?php if ( is_active_sidebar( 'footer-widget-area' ) ){ ?>
<div class="hero-widgets-section">
	<div class="container">
		<div class="row">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>			
		</div>
	</div>
</div>
<?php } ?>
<!-- /Widgets Section -->
<?php
$rambo_pro_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options ); ?>
<!-- Footer Section -->
<div class="footer-section">
	<div class="container">
		<div class="row">
			<div class="span8">
				<?php if( isset( $current_options['footer_copyright'] ) && $current_options['footer_copyright'] != '' ) { ?>
				<p><?php echo wp_kses_data( $current_options['footer_copyright'] ); ?></p>	
				<?php } else{ ?> 
				<p><?php _e('Copyright @ 2014 - RAMBO Powered By ','workpress');?> <a target="_blank" href="<?php echo esc_url ( 'http://wordpress.org/') ; ?>"> <?php _e('WordPress','workpress');?></a>&nbsp;&nbsp;<?php } ?>
			</div>
			<div class="span4">
				<?php  
					if( is_active_sidebar('footer-social-icon-sidebar-area'))
					{
					dynamic_sidebar('footer-social-icon-sidebar-area');
					}
					?>
			</div>		
		</div>
	</div>		
</div>		
<!-- Footer Section-->

<?php
// custom css
if ( version_compare( $GLOBALS['wp_version'], '4.6', '>=' ) ) {
}
else{
	$rambo_pro_theme_options = theme_data_setup();
	$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
	if($current_options['webrit_custom_css']!='') {
		echo '<style>'.wp_filter_nohtml_kses($current_options['webrit_custom_css']).'</style>';
	}
}
wp_footer(); ?>
</div>
</body>
</html>