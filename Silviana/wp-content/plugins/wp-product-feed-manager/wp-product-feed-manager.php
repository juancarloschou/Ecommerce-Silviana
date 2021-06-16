<?php
/**
 * Plugin Name: WP Product Feed Manager
 * Plugin URI: https://www.wpmarketingrobot.com
 * Description: An easy to use WordPress plugin that generates and submits your product feeds to merchant centres.
 * Version: 1.9.4
 * Modified: 08-07-2018
 * Author: Michel Jongbloed
 * Author URI: https://www.wpmarketingrobot.com
 * Requires at least: 4.6
 * Tested up to: 4.9
 *
 * Text Domain: wp-product-feed-manager
 * Domain Path: /languages/
 * 
 * WC requires at least: 3.0.0
 * WC tested up to: 3.4.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WP_Product_Feed_Manager' ) ) :

	/**
	 * The Main WP_Product_Feed_Manager Class
	 * 
	 * @class WP_Product_Feed_Manager
	 */
	final class WP_Product_Feed_Manager {
		/* --------------------------------------------------------------------------------------------------*
		 * Attributes
		 * -------------------------------------------------------------------------------------------------- */

		/**
		 * @var string containing the version number of the plugin
		 */
		public $version = '1.9.4';

		/**
		 * @var string countaining the authors name
		 */
		public $author = 'Michel Jongbloed';

		/**
		 * @var WP_Product_Feed_Manager single instance
		 */
		private static $instance = null;

		/**
		 * Returns the Singleton instance of this class
		 * 
		 * @static
		 * @access public
		 * @return WP_Product_Feed_Manager Main instance
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) { self::$instance = new self(); }
			return self::$instance;
		}

		/**
		 * Cloning is not allowed.
		 * @since 0.9.1
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cloning is not allowed', 'wp-product-feed-manager' ), '0.9.1' );
		}

		/**
		 * Unserializing instances of this class is not allowed.
		 * @since 0.9.1
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is not allowed', 'wp-product-feed-manager' ), '0.9.1' );
		}
		
		/**
		 * WP_Product_Feed_Manager Constructor
		 * @since 0.9.1
		 */
		private function __construct() {
			// TODO: Remove this error_handler when all users can be expected to have updated the Google and Zbozi channel code
			set_error_handler( function( $errno, $errstr ) {
				return strpos( $errstr, 'Declaration of' ) === 0;
			}, E_WARNING );
			
			// set the constants to be used in this plugin
			$this->define_constants();
			
			// hooks
			$this->hooks();

			// includes
			$this->includes();
			
			// register my version
			add_option( 'myplugin_version', WPPFM_VERSION_NUM );
			
			// register my schedule
			add_action( 'wppfm_feed_update_schedule', array( $this, 'activate_feed_update_schedules' ) );
			add_action( 'wp_ajax_dismiss_admin_notice', array( $this, 'dismiss_admin_notice' ) );
			
			// register the background process
			add_action( 'plugins_loaded', array( $this, 'initiate_background_process' ) );
			
			do_action( 'wp-product-feed-manager_loaded' );
		}

		/* --------------------------------------------------------------------------------------------------*
		 * Private functions
		 * -------------------------------------------------------------------------------------------------- */
		
		/**
		 * Defines a few important constants
		 */
		private function define_constants() {
			// Store the name of the plugin
			if ( ! defined( 'WPPFM_PLUGIN_NAME' ) ) { define( 'WPPFM_PLUGIN_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) ); }

			// Store the directory of the plugin
			if ( ! defined( 'WPPFM_PLUGIN_DIR' ) ) { define( 'WPPFM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }

			// Store the url of the plugin
			if ( ! defined( 'WPPFM_PLUGIN_URL' ) ) { define( 'WPPFM_PLUGIN_URL', plugins_url() . '/' . WPPFM_PLUGIN_NAME );	}

			// Store the version of my plugin
			if ( ! defined( 'WPPFM_VERSION_NUM' ) ) { define( 'WPPFM_VERSION_NUM', $this->version ); }
			
			// Store the transient alive time
			if ( ! defined( 'WPPFM_TRANSIENT_LIVE' ) ) { define( 'WPPFM_TRANSIENT_LIVE', 20*60 ); }

			// Store the url to wpmarketingrobot.com
			if ( ! defined( 'WPPFM_EDD_SL_STORE_URL' ) ) { define( 'WPPFM_EDD_SL_STORE_URL', 'https://www.wpmarketingrobot.com/' ); }

			// Store the plugin title
			if ( ! defined( 'WPPFM_EDD_SL_ITEM_NAME' ) ) { define( 'WPPFM_EDD_SL_ITEM_NAME', 'WP Product Feed Manager' ); }
			
			// Store the base uploads folder, should also work in a multisite environment
			if ( ! defined( 'WPPFM_UPLOADS_DIR' ) ) {
				$wp_upload_dir = wp_upload_dir();
				$upload_dir = is_multisite() && defined( 'UPLOADS' ) ? UPLOADS : $wp_upload_dir['basedir'];
				
				if ( ! file_exists( $upload_dir ) && ! is_dir( $upload_dir ) ) {
					define( 'WPPFM_UPLOADS_DIR', $wp_upload_dir['basedir'] );
				} else {
					define( 'WPPFM_UPLOADS_DIR', $upload_dir );
				}
			}
			
			if( ! defined( 'WPPFM_UPLOADS_URL' ) ) {
				$wp_upload_dir = wp_upload_dir();
				
				// correct baseurl for https if required
				if ( is_ssl() ) {
					$url = str_replace( 'http://', 'https://', $wp_upload_dir['baseurl'] );
				} else {
					$url = $wp_upload_dir['baseurl'];
				}
				
				define( 'WPPFM_UPLOADS_URL', $url );
			}

			// store the folder that contains the channels data
			if ( ! defined( 'WPPFM_CHANNEL_DATA_DIR' ) ) {
				define( 'WPPFM_CHANNEL_DATA_DIR', WPPFM_PLUGIN_DIR . 'includes/application' );
			}

			// store the folder that contains the backup files
			if ( ! defined( 'WPPFM_BACKUP_DIR' ) ) { define( 'WPPFM_BACKUP_DIR', WPPFM_UPLOADS_DIR . '/wppfm-backups' ); }

			// store the folder that contains the feeds
			if ( ! defined( 'WPPFM_FEEDS_DIR' ) ) { define( 'WPPFM_FEEDS_DIR', WPPFM_UPLOADS_DIR . '/wppfm-feeds' );	}
		}

		/**
		 * Sets the activation and deactivation hooks
		 */
		private function hooks() {
			// registeres the activation, deactivation and uninstall hooks
			register_activation_hook( __FILE__, array( &$this, 'on_activation' ) );
			register_deactivation_hook( __FILE__, array( &$this, 'on_deactivation' ) );
			register_shutdown_function( array( $this, 'log_errors' ) );
		}

		/**
		 * Includes the required files
		 */
		private function includes() {
			// include the wordpress pluggable.php file on forehand to prevent a "Call to undefined function wp_get_current_user()" error
			// https://wp-types.com/forums/topic/mandrill-wp_mail-has-been-declared-by-another-process-or-plugin-need-fix/
			if ( is_admin() && in_array (basename($_SERVER['PHP_SELF']), array('options-general.php') ) && isset( $_GET['page'] ) && $_GET['page'] == 'email_template' ) {
				require_once( ABSPATH . 'wp-includes/pluggable.php' );
			}

			if ( is_admin() ) {
				// include the admin menu and the includes file
				require_once ( 'includes/application/wppfm-feed-processing-support.php' );
				require_once ( 'includes/user-interface/wppfm-admin-menu.php' );
				require_once ( 'includes/data/wppfm-admin-functions.php' );
				require_once ( 'includes/user-interface/wppfm-messaging.php' );
				require_once ( 'includes/wppfm-wpincludes.php' );

				// include all required classes
				include_classes();
				include_channels();
			} else {
				require_once ( 'includes/user-interface/wppfm-messaging.php' );
				wppfm_show_wp_warning( __( 'You have insufficient rights to use ' . WPPFM_EDD_SL_ITEM_NAME, 'wp-product-feed-manager' ) );
			}
		}

		/* --------------------------------------------------------------------------------------------------*
		 * Public functions
		 * -------------------------------------------------------------------------------------------------- */

		public function activate_feed_update_schedules() {
			require_once ( __DIR__ . '/includes/application/wppfm-cron.php' );
			wppfm_update_feeds();
		}
		
		/**
		 * Registeres a dismiss notice action
		 * 
		 * @since 1.9.8
		 */
		public function dismiss_admin_notice() { 
			if ( is_admin() ) { update_option( 'wppfm_license_notice_surpressed', true ); }
		}

		/**
		 * Performs the required actions on activation of the plugin
		 * 
		 * @param none
		 * @return nothing
		 */
		public function on_activation() {
			// add the required tables to the database
			$wppfm_database = new WPPFM_Database();
			$wppfm_database->make();

			wp_schedule_event( time(), 'hourly', 'wppfm_feed_update_schedule' );
		}
		
		/**
		 * Sets the global background process
		 * 
		 * @since 1.10.0
		 * 
		 * @global WPPFM_Feed_Processor_Class $background_process
		 */
		public function initiate_background_process() {
			if ( class_exists( 'WPPFM_Feed_Processor_Class' ) ) {
				global $background_process;
				$background_process = new WPPFM_Feed_Processor_Class();
			}
		}

		/**
		 * Performs the required actions on deactivation of the plugin
		 * 
		 * @param none
		 * @return nothing
		 */
		public function on_deactivation() {
			// stop the scheduled feed update actions
			wp_clear_scheduled_hook( 'wppfm_feed_update_schedule' );
			// remove all keyed option items from the option table and clears any stuck feed processing data
			wppfm_clear_feed_process_data();
		}

		/**
		 * Gets triggered when the plugin quits and is used to fetch fatal errors
		 *
		 * @since 1.10.0
		 */
		public function log_errors() {
			$error = error_get_last();
			
			// fetch fatal errors
			if ( E_ERROR === $error['type'] ) {
				// clear the feed queue
				WPPFM_Feed_Controller_Class::clear_feed_queue();
				
				// the background process clearly has stopped
				WPPFM_Feed_Controller_Class::set_feed_processing_flag( false );
				
				// remove all keyed option items from the option table
				WPPFM_Db_Management::clean_options_table();
				
				wppfm_write_log_file( sprintf( "PHP Fatal error: %s in file %s on line %s", $error['message'], $error['file'], $error['line'] ) ); 
			} elseif( E_WARNING === $error['type'] ) {

				if ( (defined( 'WP_DEBUG' ) && WP_DEBUG) ) {
					wppfm_write_log_file( sprintf( "PHP Warning: %s in file %s on line %s", $error['message'], $error['file'], $error['line'] ) ); 
				}
			}
		}

	}

	// end of WP_Product_Feed_Manager class

endif;

WP_Product_Feed_Manager::get_instance();