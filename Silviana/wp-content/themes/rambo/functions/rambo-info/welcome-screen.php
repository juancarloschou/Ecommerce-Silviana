<?php
/**
 * Welcome Screen Class
 */
class rambo_screen {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'rambo_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'rambo_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'rambo_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'rambo_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'rambo_info_screen', array( $this, 'rambo_getting_started' ), 	    10 );
		add_action( 'rambo_info_screen', array( $this, 'rambo_action_required' ), 	    20 );
		add_action( 'rambo_info_screen', array( $this, 'rambo_upgrade' ), 		        40 );
		add_action( 'rambo_info_screen', array( $this, 'rambo_welcome_free_pro' ), 		50 );
		add_action( 'rambo_info_screen', array( $this, 'rambo_child_themes' ), 		    50 );
		add_action( 'rambo_info_screen', array( $this, 'rambo_import_data' ), 			60 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_rambo_dismiss_required_action', array( $this, 'rambo_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_rambo_dismiss_required_action', array($this, 'rambo_dismiss_required_action_callback') );

	}

	public function rambo_register_menu() {
		add_theme_page( 'About Rambo Theme', 'About Rambo Theme', 'activate_plugins', 'rambo-info', array( $this, 'rambo_welcome_screen' ) );
	}

	public function rambo_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'rambo_admin_notice' ), 99 );
			add_action( 'admin_notices', array( $this, 'rambo_admin_video_notice' ), 99 );
			add_action( 'admin_notices', array( $this, 'rambo_admin_import_notice' ), 99 );
			
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @sfunctionse 1.8.2.4
	 */
	public function rambo_admin_notice() {
		?>
			<div class="updated notice notice-success notice-alt is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Rambo Theme! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'rambo' ), '<a href="' . esc_url( admin_url( 'themes.php?page=rambo-info' ) ) . '">', '</a>' ); ?></p>
			</div>
		<?php
	}
	
	function rambo_admin_import_notice(){
    ?>
    <div class="updated notice notice-success notice-alt is-dismissible">
        <p><?php printf( esc_html__( 'Save time by importing our demo data and make your site ready in minutes. %s', 'rambo' ), '<a class="button button-secondary" href="'.esc_url( add_query_arg( array( 'page' => 'rambo-info#demo_import' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Import Demo Data', 'rambo' ).'</a>'  ); ?></p>
    </div>
    <?php
}

public function rambo_admin_video_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__('Walkthrough our step by step video series for setting front page sections. %sClick here to watch%s', 'rambo' ), 
				'<a href="' . esc_url( 'http://webriti.com/rambo-theme-video-documentation/' ). '">', '</a>' ); ?></p>
			</div>
		<?php
}

	/**
	 * Load welcome screen css and javascript
	 * @sfunctionse  1.8.2.4
	 */
	public function rambo_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_rambo-info' == $hook_suffix ) {
			
			
			wp_enqueue_style( 'rambo-info-css', get_template_directory_uri() . '/functions/rambo-info/css/bootstrap.css' );
			
			wp_enqueue_style( 'rambo-info-screen-css', get_template_directory_uri() . '/functions/rambo-info/css/welcome.css' );

			wp_enqueue_script( 'rambo-info-screen-js', get_template_directory_uri() . '/functions/rambo-info/js/welcome.js', array('jquery') );

			global $rambo_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if( get_option('rambo_show_required_actions') ):
				$rambo_show_required_actions = get_option('rambo_show_required_actions');
			else:
				$rambo_show_required_actions = array();
			endif;

			if( !empty($rambo_required_actions) ):
				foreach( $rambo_required_actions as $rambo_required_action_value ):
					if(( !isset( $rambo_required_action_value['check'] ) || ( isset( $rambo_required_action_value['check'] ) && ( $rambo_required_action_value['check'] == false ) ) ) && ((isset($rambo_show_required_actions[$rambo_required_action_value['id']]) && ($rambo_show_required_actions[$rambo_required_action_value['id']] == true)) || !isset($rambo_show_required_actions[$rambo_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;

			wp_localize_script( 'rambo-info-screen-js', 'ramboLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','rambo' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @sfunctionse  1.8.2.4
	 */
	public function rambo_scripts_for_customizer() {

		wp_enqueue_style( 'rambo-info-screen-customizer-css', get_template_directory_uri() . '/functions/rambo-info/css/welcome_customizer.css' );
		wp_enqueue_script( 'rambo-info-screen-customizer-js', get_template_directory_uri() . '/functions/rambo-info/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $rambo_required_actions;

		$nr_actions_required = 0;

		/* get number of required actions */
		if( get_option('rambo_show_required_actions') ):
			$rambo_show_required_actions = get_option('rambo_show_required_actions');
		else:
			$rambo_show_required_actions = array();
		endif;

		if( !empty($rambo_required_actions) ):
			foreach( $rambo_required_actions as $rambo_required_action_value ):
				if(( !isset( $rambo_required_action_value['check'] ) || ( isset( $rambo_required_action_value['check'] ) && ( $rambo_required_action_value['check'] == false ) ) ) && ((isset($rambo_show_required_actions[$rambo_required_action_value['id']]) && ($rambo_show_required_actions[$rambo_required_action_value['id']] == true)) || !isset($rambo_show_required_actions[$rambo_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;

		wp_localize_script( 'rambo-info-screen-customizer-js', 'ramboLiteWelcomeScreenObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=rambo-info#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','rambo'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @sfunctionse 1.8.2.4
	 */
	public function rambo_dismiss_required_action_callback() {

		global $rambo_required_actions;

		$rambo_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $rambo_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($rambo_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('rambo_show_required_actions') ):

				$rambo_show_required_actions = get_option('rambo_show_required_actions');

				$rambo_show_required_actions[$rambo_dismiss_id] = false;

				update_option( 'rambo_show_required_actions',$rambo_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$rambo_show_required_actions_new = array();

				if( !empty($rambo_required_actions) ):

					foreach( $rambo_required_actions as $rambo_required_action ):

						if( $rambo_required_action['id'] == $rambo_dismiss_id ):
							$rambo_show_required_actions_new[$rambo_required_action['id']] = false;
						else:
							$rambo_show_required_actions_new[$rambo_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'rambo_show_required_actions', $rambo_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @sfunctionse 1.8.2.4
	 */
	public function rambo_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<ul class="rambo-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting Started','rambo'); ?></a></li>
			<li role="presentation"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions Required','rambo'); ?></a></li>
			<li role="presentation"><a href="#upgrade" aria-controls="upgrade" role="tab" data-toggle="tab"><?php esc_html_e( 'Why Upgrade Pro','rambo'); ?></a></li>
			<li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO','rambo'); ?></a></li>
			<li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Child Themes','rambo'); ?></a></li>
			<li role="presentation"><a href="#demo_import" aria-controls="demo_import" role="tab" data-toggle="tab"><?php esc_html_e( 'One Click Demo Import','rambo'); ?></a></li>
			
			
		</ul>
		</div>
		</div>
		</div>

		<div class="rambo-tab-content">

			<?php do_action( 'rambo_info_screen' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 *
	 */
	public function rambo_getting_started() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/getting-started.php' );
	}

	
	/**
	 * Action Requerd
	 *
	 */
	public function rambo_action_required() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/actions-required.php' );
	}
	
	
	/**
	 * Contribute
	 *
	 */
	public function rambo_upgrade() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/upgrade.php' );
	}
	/**
	 * Free vs PRO
	 * 
	 */
	public function rambo_welcome_free_pro() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/free_pro.php' );
	}
	
	/**
	 * Child themes
	 *
	 */
	 
	 public function rambo_child_themes() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/child-themes.php' );
	}
	 
	
	/**
	 * Import Data
	 *
	 */
	public function rambo_import_data() {
		require_once( get_template_directory() . '/functions/rambo-info/sections/import-data.php' );
	}
	
	
	
}

$GLOBALS['rambo_screen'] = new rambo_screen();