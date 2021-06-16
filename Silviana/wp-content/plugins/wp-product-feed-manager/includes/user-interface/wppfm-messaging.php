<?php
/**
 * WP Product Feed Manager Messaging functions
 *
 * Functions for handling messages
 *
 * @author 		Michel Jongbloed
 * @category 	Messages
 * @package 	User-interface
 * @version     2.3
 */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Returns the html for a standard WordPress error message
 * 
 * @param string $message
 * @param bool $dismissible (default false)
 * @param string $permanent_dismissible_id (default '')
 * @return html string
 */
function wppfm_show_wp_error( $message, $dismissible = false, $permanent_dismissible_id = '' ) {
	return wppfm_show_wp_message( $message, 'error', $dismissible, $permanent_dismissible_id );
}

/**
 * Returns the html for a standard WordPress warning message
 * 
 * @param string $message
 * @param bool $dismissible (default false)
 * @param string $permanent_dismissible_id (default '')
 * @return html string
 */
function wppfm_show_wp_warning( $message, $dismissible = false, $permanent_dismissible_id = '' ) {
	return wppfm_show_wp_message( $message, 'warning', $dismissible, $permanent_dismissible_id );
}

/**
 * Returns the html for a standard WordPress success message
 * 
 * @param string $message
 * @param bool $dismissible (default false)
 * @param string $permanent_dismissible_id (default '')
 * @return html string
 */
function wppfm_show_wp_success( $message, $dismissible = false, $permanent_dismissible_id = '' ) {
	return wppfm_show_wp_message( $message, 'success', $dismissible, $permanent_dismissible_id );
}

/**
 * Returns the html for a standard WordPress info message
 * 
 * @param string $message
 * @param bool $dismissible (default false)
 * @param string $permanent_dismissible_id (default '')
 * @return html string
 */
function wppfm_show_wp_info( $message, $dismissible = false, $permanent_dismissible_id = '' ) {
	return wppfm_show_wp_message( $message, 'info', $dismissible, $permanent_dismissible_id );
}

/**
 * Returns the html for a standard WordPress message
 * 
 * @param string $message
 * @param string $type
 * @param bool $dismissible
 * @param string $permanent_dismissible_id
 * @return html string
 */
function wppfm_show_wp_message( $message, $type, $dismissible, $permanent_dismissible_id ) {
	$dism = $dismissible ? ' is-dismissible' : '';
	$perm_dism = $permanent_dismissible_id ? ' id="disposible-warning-message"' : '';
	$dismiss_permanently = '' !== $permanent_dismissible_id ? '<p id=dismiss-permanently>dismiss permanently<p>' : '';
	
	return '<div' . $perm_dism . ' class="notice notice-' . $type . $dism . '"><p>'  . $message . '</p>' . $dismiss_permanently . '</div>';
}

/**
 * Shows an error message to the user and writes an error log based on the wp_error given
 * 
 * @since 1.9.3
 * 
 * @param wp_error object $response
 * @param string $message
 * @return html string
 */
function wppfm_handle_wp_errors_response( $response, $message ) {
	$err_msgs = method_exists( $response, 'get_error_messages' ) ? $response->get_error_messages() : array( 'Error unknown' );
	$err_msg = method_exists( $response, 'get_error_message' ) ? $response->get_error_message() : 'Error unknown';
	$err_txt = !empty( $err_msgs ) ? implode( ' :: ', $err_msgs ) : 'error unknown!';

	wppfm_write_log_file( $message . $err_txt );
	return wppfm_show_wp_error( $message . " Error message: " . $err_msg );
}

/**
 * enables writing log files in the plugin folder
 * 
 * @since 1.5.1
 * 
 * @param string $error_message
 * @param string $filename (default 'error')
 */
function wppfm_write_log_file( $error_message, $filename = 'error' ) {
	$file = fopen( WPPFM_PLUGIN_DIR . $filename . '.log', "a");

	if ( $file ) {
		if ( is_null( $error_message ) || is_string( $error_message ) || is_int( $error_message ) || is_bool( $error_message ) || is_float( $error_message ) ) {
			$message_line = $error_message;
		} elseif ( is_array( $error_message ) || is_object( $error_message ) ) {
			$message_line = json_encode( $error_message );
		} else {
			$message_line = "ERROR! Could not write messages of type " . gettype( $error_message ) ;
		}

		fwrite( $file, date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) . ' - ' . ucfirst($filename) . ' Message: ' . $message_line . PHP_EOL );
		
		fclose($file);
	} else {
		wppfm_show_wp_error( __( "There was an error but I was unable to store the error message in the log file. The message was $error_message", 'wp-product-feed-manager' ) );
	}
}

/**
 * Writes a http_requests_error.log file in the plugin folder when there is a http request failed
 * 
 * @since 1.9.0
 * 
 * @param string $response
 * @param array $args
 * @param string $url
 * @return string
 */
function wppfm_log_http_requests( $response, $args, $url ) {
	if ( is_wp_error( $response ) && stripos( $this->_uri, '/wp-admin/admin.php?page=' . WPPFM_PLUGIN_NAME ) !== false ) {
		$logfile = WPPFM_PLUGIN_DIR . 'http_request_error.log';
		file_put_contents( $logfile, sprintf( "### %s, URL: %s\nREQUEST: %sRESPONSE: %s\n", date( 'c' ), $url, print_r( $args, true ), print_r( $response, true ) ), FILE_APPEND );
	}
	
	return $response;
}

// hook into WP_Http::_dispatch_request()
add_filter( 'http_response', 'wppfm_log_http_requests', 10, 3 );

/**
 * allows safe debugging on a operational server of a user
 */
class MJ {

	static function log( $var ) {
		?>
		<style>
			.mj_debug { word-wrap: break-word; white-space: pre; text-align: left; position: relative; 
					   background-color: rgba(0, 0, 0, 0.8); font-size: 11px; color: #a1a1a1; margin: 10px; 
					   padding: 10px; margin: 0 auto; width: 80%; overflow: auto; -moz-box-shadow:0 10px 40px rgba(0, 0, 0, 0.75); 
					   -webkit-box-shadow:0 10px 40px rgba(0, 0, 0, 0.75); -moz-border-radius: 5px; -webkit-border-radius: 5px; text-shadow: none; }
		</style>
		<br /><pre class="mj_debug">

		<?php
		if ( is_null( $var ) || is_string($var) || is_int( $var ) || is_bool($var) || is_float( $var ) ) :
			var_dump( $var );

		else :
			print_r( $var );

		endif;

		echo '</pre><br />';
	}
	
	static function log_channel_table() {
		$queries_class = new WPPFM_Queries();
		self::log( $queries_class->get_feedmanager_channel_table() );
	}
	
	static function log_product_feed_table() {
		$queries_class = new WPPFM_Queries();
		self::log( $queries_class->get_feedmanager_product_feed_table() );
	}
	
	static function log_product_feedmeta_table() {
		$queries_class = new WPPFM_Queries();
		self::log( $queries_class->get_feedmanager_product_feedmeta_table() );
	}
}