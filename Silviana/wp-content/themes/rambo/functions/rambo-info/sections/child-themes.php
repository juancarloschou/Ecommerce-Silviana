<?php
/**
 * Child themes template
 */
?>
<div id="child_themes" class="rambo-tab-pane">

	<?php
		$current_theme = wp_get_theme();
	?>
<div class="container-fluid">
		<div class="row">	

	<div class="rambo-pane-center">

		<h1><?php esc_html_e( 'Install & Use Rambo Child Themes', 'rambo' ); ?></h1>

		<p><?php esc_html_e( 'Below you will find a selection of Rambo child themes that will totally transform the look of your site.', 'rambo' ); ?></p>

	</div>

	<div class="col-md-4">
		<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
			<!-- rambo Blue -->
			<div class="rambo-child-theme-container">
				<div class="rambo-child-theme-image-container">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/rambo-info/img/redify.png'; ?>" alt="<?php esc_html_e( 'Redify Child Theme', 'rambo' ); ?>" />
					<div class="rambo-child-theme-description">
						<h2><?php esc_html_e( 'Redify', 'rambo' ); ?></h2>
					</div>
				</div>
				<div class="rambo-child-theme-details">
					<?php if ( 'redify' != $current_theme['Name'] ) { ?>
						<div class="theme-details">
							<span class="theme-name"><?php _e('Redify','rambo'); ?></span>
							<span class="theme-btn">
							<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=redify' ), 'install-theme_redify' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'rambo' ), '<span class="screen-reader-text">redify</span>' ); ?></a>
							<a class="button button-secondary" target="_blank" href="http://webriti.com/demo/wp/lite/dreamspa/"><?php esc_html_e( 'Live Preview','rambo'); ?></a>
							</span>
							<div class="rambo-clear"></div>
						</div>
						<?php } else { ?>
						<div class="theme-details active">
							<span class="theme-name"><?php echo esc_html_e( 'redify - Current theme', 'rambo' ); ?></span>
							<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','rambo'); ?></a>
							<div class="rambo-clear"></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
			<!-- rambo Blue -->
			<div class="rambo-child-theme-container">
				<div class="rambo-child-theme-image-container">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/rambo-info/img/mambo.png'; ?>" alt="<?php esc_html_e( 'Mambo Child Theme', 'rambo' ); ?>" />
					<div class="rambo-child-theme-description">
						<h2><?php esc_html_e( 'Mambo', 'rambo' ); ?></h2>
					</div>
				</div>
				<div class="rambo-child-theme-details">
					<?php if ( 'mambo' != $current_theme['Name'] ) { ?>
						<div class="theme-details">
							<span class="theme-name"><?php _e('Mambo','rambo'); ?></span>
							<span class="theme-btn">
							<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=mambo' ), 'install-theme_mambo' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'rambo' ), '<span class="screen-reader-text">mambo</span>' ); ?></a>
							<a class="button button-secondary" target="_blank" href="http://webriti.com/demo/wp/lite/dreamspa/"><?php esc_html_e( 'Live Preview','rambo'); ?></a>
							</span>
							<div class="rambo-clear"></div>
						</div>
						<?php } else { ?>
						<div class="theme-details active">
							<span class="theme-name"><?php echo esc_html_e( 'mambo - Current theme', 'rambo' ); ?></span>
							<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','rambo'); ?></a>
							<div class="rambo-clear"></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
			<!-- rambo Blue -->
			<div class="rambo-child-theme-container">
				<div class="rambo-child-theme-image-container">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/rambo-info/img/spicy.png'; ?>" alt="<?php esc_html_e( 'Spicy Child Theme', 'rambo' ); ?>" />
					<div class="rambo-child-theme-description">
						<h2><?php esc_html_e( 'Spicy', 'rambo' ); ?></h2>
					</div>
				</div>
				<div class="rambo-child-theme-details">
					<?php if ( 'spicy' != $current_theme['Name'] ) { ?>
						<div class="theme-details">
							<span class="theme-name"><?php _e('Spicy','rambo'); ?></span>
							<span class="theme-btn">
							<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=spicy' ), 'install-theme_spicy' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'rambo' ), '<span class="screen-reader-text">spicy</span>' ); ?></a>
							<a class="button button-secondary" target="_blank" href="https://wp-themes.com/spicy/"><?php esc_html_e( 'Live Preview','rambo'); ?></a>
							</span>
							<div class="rambo-clear"></div>
						</div>
						<?php } else { ?>
						<div class="theme-details active">
							<span class="theme-name"><?php echo esc_html_e( 'spicy - Current theme', 'rambo' ); ?></span>
							<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','rambo'); ?></a>
							<div class="rambo-clear"></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-md-4">
		<div class="rambo-tab-pane-half rambo-tab-pane-first-half">
			<!-- rambo Blue -->
			<div class="rambo-child-theme-container">
				<div class="rambo-child-theme-image-container">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/functions/rambo-info/img/WorkPress.png'; ?>" alt="<?php esc_html_e( 'WorkPress', 'rambo' ); ?>" />
					<div class="rambo-child-theme-description">
						<h2><?php esc_html_e( 'WorkPress', 'rambo' ); ?></h2>
					</div>
				</div>
				<div class="rambo-child-theme-details">
					<?php if ( 'workpress' != $current_theme['Name'] ) { ?>
						<div class="theme-details">
							<span class="theme-name"><?php _e('WorkPress','rambo'); ?></span>
							<span class="theme-btn">
							<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-theme&theme=workpress' ), 'install-theme_workpress' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %s now', 'rambo' ), '<span class="screen-reader-text">workpress</span>' ); ?></a>
							<a class="button button-secondary" target="_blank" href="https://wp-themes.com/workpress/"><?php esc_html_e( 'Live Preview','rambo'); ?></a>
							</span>
							<div class="rambo-clear"></div>
						</div>
						<?php } else { ?>
						<div class="theme-details active">
							<span class="theme-name"><?php echo esc_html_e( 'workPress - Current theme', 'rambo' ); ?></span>
							<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','rambo'); ?></a>
							<div class="rambo-clear"></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	</div>
</div>	
	</div>