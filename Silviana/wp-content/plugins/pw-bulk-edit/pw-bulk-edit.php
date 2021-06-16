<?php
/**
 * Plugin Name: PW WooCommerce Bulk Edit
 * Plugin URI: http://www.pimwick.com/pw-bulk-edit/
 * Description: A powerful way to update your WooCommerce product catalog. Finally, no more tedious clicking through countless pages making the same change to all products!
 * Version: 2.47
 * Author: Pimwick, LLC
 * Author URI: http://www.pimwick.com/pw-bulk-edit/
 * Text Domain: pimwick
 *
 * WC requires at least: 2.6.5
 * WC tested up to: 3.4.0
 *
*/
define('PWBE_VERSION', '2.47');

/*
Copyright (C) 2016-2018 Pimwick, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Only change this if you are comfortable with possible unexpected behavior!
if ( !defined( 'PWBE_MAX_RESULTS' ) ) {
	define( 'PWBE_MAX_RESULTS', '1000' );
}

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Verify this isn't called directly.
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if ( ! class_exists( 'PW_Bulk_Edit' ) ) :

register_uninstall_hook( __FILE__, array( 'PW_Bulk_Edit', 'plugin_uninstall' ) );

final class PW_Bulk_Edit {

	const NULL = '!!pwbe_null_value!!';

	static $options = array(
		'pwbe_help_dismiss_intro',
		'pwbe_help_minimize_filter_help',
		'pwbe_views',
		'pwbe_selected_view'
	);

	function __construct() {
        add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
        add_action( 'woocommerce_init', array( $this, 'woocommerce_init' ) );
	}

    function plugins_loaded() {
        load_plugin_textdomain( 'pimwick', false, basename( dirname( __FILE__ ) ) . '/languages' );
    }

    function woocommerce_init() {
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		if ( is_admin() ) {
			require( 'includes/columns.php' );
			require( 'includes/db.php' );
			require( 'includes/filters.php' );
			require( 'includes/select-options.php' );
			require( 'includes/sql-builder.php' );
			require( 'includes/views.php' );

			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 9999 );
			add_action( 'wp_ajax_pwbe_options', array( $this, 'ajax_options' ) );
			add_action( 'wp_ajax_pwbe_filter_results', array( $this, 'ajax_filter_results' ) );
			add_action( 'wp_ajax_pwbe_get_view', array( $this, 'ajax_get_view' ) );
			add_action( 'wp_ajax_pwbe_save_view', array( $this, 'ajax_save_view' ) );
			add_action( 'wp_ajax_pwbe_delete_view', array( $this, 'ajax_delete_view' ) );
			add_action( 'wp_ajax_pwbe_save_products', array( $this, 'ajax_save_products' ) );
			add_action( 'wp_ajax_pwbe_get_save_products_error', array( $this, 'ajax_get_save_products_error' ) );
		}
	}

    public static function wc_min_version( $version ) {
        return version_compare( WC()->version, $version, ">=" );
    }

	public static function plugin_uninstall() {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		foreach( PW_Bulk_Edit::$options as $option ) {
			delete_option( $option );
		}
	}

	function index() {
		$data = get_plugin_data( __FILE__ );
		$version = $data['Version'];
		$help_url = plugins_url( '/docs/index.html', __FILE__ );

		require( 'ui/index.php' );
	}

	function ajax_options() {
		$name = $_POST['option_name'];
		$value = $_POST['option_value'];

		if ( in_array( $name, PW_Bulk_Edit::$options ) ) {
			update_option( $name, $value );
		}
	}

	function ajax_filter_results() {
		require( 'ui/results.php' );
		wp_die();
	}

	function ajax_get_view() {
		$view_name = stripslashes( $_POST['name'] );

		update_option( 'pwbe_selected_view', $view_name );

		$views = PWBE_Views::get();
		$view = $views[ $view_name ];

		wp_send_json( $view );

		wp_die();
	}

	function ajax_save_view() {
		$option_value = get_option( 'pwbe_views' );
		$views = maybe_unserialize( $option_value );

		$clean_name = stripslashes( $_POST['name'] );

		$views[ $clean_name ] = stripslashes( $_POST['view_data'] );

		ksort( $views, SORT_NATURAL );

		update_option( 'pwbe_views', $views );
		update_option( 'pwbe_selected_view', $clean_name );

		wp_die();
	}

	function ajax_delete_view() {
		$option_value = get_option( 'pwbe_views' );
		$views = maybe_unserialize( $option_value );

		$view_name = stripslashes( $_POST['name'] );

		unset( $views[ $view_name ] );

		update_option( 'pwbe_views', $views );
		update_option( 'pwbe_selected_view', '' );

		wp_die();
	}

	function ajax_save_products() {
		register_shutdown_function( array( $this, 'save_products_exception' ) );

		require( 'includes/save-products.php' );

		if ( isset( $_POST['fields'] ) ) {
			$fields = $_POST['fields'];

			$save = new PWBE_Save_Products();
			$results = $save->save( $fields );

			require( 'ui/products-saved.php' );
		}

		wp_die();
	}

	function ajax_get_save_products_error() {
		$error_file = plugin_dir_path( __FILE__ ) . 'logs/save_products_exception.txt';

		echo 'Error while saving products: ' . file_get_contents( $error_file );

		wp_die();
	}

	public function save_products_exception() {
		$errfile = 'unknown file';
		$errstr  = 'shutdown';
		$errno   = E_CORE_ERROR;
		$errline = 0;

		$error = error_get_last();

		if ( $error !== NULL ) {
			$errno   = $error['type'];
			$errfile = $error['file'];
			$errline = $error['line'];
			$errstr  = $error['message'];

			if ( PW_Bulk_Edit::starts_with( plugin_dir_path( __FILE__ ), $errfile ) ) {
				$output_dir = plugin_dir_path( __FILE__ ) . 'logs';
				if ( ! file_exists( $output_dir ) ) {
					mkdir( $output_dir, 0777, true );
				}
				file_put_contents( $output_dir . '/save_products_exception.txt', "$errstr in $errfile on line $errline" );
			}
		}
	}

	function error( $message ) {
		?>
		<div class="error">
			<p><?php _e( $message, 'pimwick' ); ?></p>
		</div>
		<?php
	}

	function register_admin_menu() {
		if ( empty ( $GLOBALS['admin_page_hooks']['pimwick'] ) ) {
			add_menu_page(
				__( 'PW Bulk Edit', 'pimwick' ),
				__( 'Pimwick Plugins', 'pimwick' ),
				'manage_woocommerce',
				'pimwick',
				array( $this, 'index' ),
                plugins_url( '/assets/images/pimwick-icon-120x120.png', __FILE__ ),
				6
			);

			add_submenu_page(
				'pimwick',
				__( 'PW Bulk Edit', 'pimwick' ),
				__( 'Pimwick Plugins', 'pimwick' ),
				'manage_woocommerce',
				'pimwick',
				array( $this, 'index' )
			);

			remove_submenu_page('pimwick','pimwick');
		}

		add_submenu_page(
			'pimwick',
			__( 'PW Bulk Edit', 'pimwick' ),
			__( 'PW Bulk Edit', 'pimwick' ),
			'manage_woocommerce',
			'pw-bulk-edit',
			array( $this, 'index' )
		);

        add_submenu_page(
            'edit.php?post_type=product',
            __( 'PW Bulk Edit', 'pimwick' ),
            __( 'PW Bulk Edit', 'pimwick' ),
            'manage_woocommerce',
            'wc-pw-bulk-edit',
            array( $this, 'index' )
        );
	}

	function admin_scripts( $hook ) {
		if ( $hook === 'pimwick-plugins_page_pw-bulk-edit' || $hook == 'product_page_wc-pw-bulk-edit' ) {
			wp_register_style( 'pwbe-font-awesome', plugins_url( '/assets/css/font-awesome.min.css', __FILE__ ), array(), PWBE_VERSION ); // 4.6.3
			wp_enqueue_style( 'pwbe-font-awesome' );

			wp_register_style( 'pwbe-select2', plugins_url( '/assets/css/select2.min.css', __FILE__ ), array(), PWBE_VERSION ); // 4.0.3
			wp_enqueue_style( 'pwbe-select2' );

			wp_register_style( 'pwbe-context-menu', plugins_url( '/assets/css/jquery.contextMenu.min.css', __FILE__ ), array(), PWBE_VERSION );
			wp_enqueue_style( 'pwbe-context-menu' );

			wp_enqueue_script( 'pwbe-select2', plugins_url( '/assets/js/select2.min.js', __FILE__ ), array(), PWBE_VERSION ); // 4.0.3

			wp_register_style( 'pw-bulk-edit', plugins_url( '/assets/css/style.css', __FILE__ ), array(), PWBE_VERSION );
			wp_enqueue_style( 'pw-bulk-edit' );

			wp_enqueue_script( 'pwbe-context-menu', plugins_url( '/assets/js/jquery.contextMenu.min.js', __FILE__ ), array( 'jquery-ui-position' ), PWBE_VERSION ); // 2.2.3
			wp_enqueue_script( 'pwbe-filters', plugins_url( '/assets/js/filters.js', __FILE__ ), array( 'jquery-form', 'pwbe-select2', 'pwbe-context-menu' ), PWBE_VERSION );
			wp_enqueue_script( 'pwbe-results', plugins_url( '/assets/js/results.js', __FILE__ ), array( 'pwbe-filters' ), PWBE_VERSION );

			wp_enqueue_script( 'jquery-form' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-position' );
		}

		wp_register_style( 'pw-bulk-edit-icon', plugins_url( '/assets/css/icon-style.css', __FILE__ ), array(), PWBE_VERSION );
		wp_enqueue_style( 'pw-bulk-edit-icon' );
	}

	public static function starts_with( $needle, $haystack ) {
		$length = strlen( $needle );
		return ( substr( $haystack, 0, $length ) === $needle );
	}

	/**
	 * Source: http://wordpress.stackexchange.com/questions/14652/how-to-show-a-hierarchical-terms-list
	 * Recursively sort an array of taxonomy terms hierarchically. Child categories will be
	 * placed under a 'children' member of their parent term.
	 * @param Array   $cats     taxonomy term objects to sort
	 * @param Array   $into     result array to put them in
	 * @param integer $parentId the current parent ID to put them in
	 */
	function sort_terms_hierarchically( array &$cats, array &$into, $parentId = 0 ) {
		foreach ( $cats as $i => $cat ) {
			if ( $cat->parent == $parentId ) {
				$into[$cat->term_id] = $cat;
				unset( $cats[$i] );
			}
		}

		foreach ( $into as $topCat ) {
			$topCat->children = array();
			$this->sort_terms_hierarchically( $cats, $topCat->children, $topCat->term_id );
		}
	}

	function hierarchical_select($categories, $level = 0, $parent = NULL, $prefix = '') {
		$output = '';

		foreach ( $categories as $category ) {
			$output .= "<option value='{$category->slug}'>$prefix {$category->name}</option>\n";

			if ( $category->parent == $parent ) {
				$level = 0;
			}

			if ( count( $category->children ) > 0 ) {
				$output .= $this->hierarchical_select( $category->children, ( $level + 1 ), $category->parent, "$prefix {$category->name} &#8594;" );
			}
		}

		return $output;
	}
}

new PW_Bulk_Edit();

endif;

?>