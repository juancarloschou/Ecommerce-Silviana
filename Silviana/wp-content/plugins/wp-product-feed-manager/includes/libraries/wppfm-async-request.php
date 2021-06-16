<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Abstract WPPFM_Async_Request class derived from https://github.com/A5hleyRich/wp-background-processing.
 *
 * @package WPPFM-Background-Processing
 * @abstract
 */
abstract class WPPFM_Async_Request {

	/**
	 * Prefix
	 *
	 * (default value: 'wppfm')
	 *
	 * @var string
	 * @access protected
	 */
	protected $prefix = 'wppfm';

	/**
	 * Action
	 *
	 * (default value: 'async_request')
	 *
	 * @var string
	 */
	protected $action = 'async_request';

	/**
	 * Identifier
	 *
	 * @var mixed
	 */
	protected $identifier;

	/**
	 * Data
	 *
	 * (default value: array())
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * File Path
	 * 
	 * (default value: empty string)
	 * 
	 * @var string
	 */
	protected $file_path = '';
	
	/**
	 * Contains the general data of the feed
	 * 
	 * (default value: empty string)
	 * 
	 * @var string
	 */
	protected $feed_data = '';
	
	/**
	 * Contains general pre feed production data
	 * 
	 * @var array
	 */
	protected $pre_data;
	
	/**
	 * Contains the channels category title and description title
	 * 
	 * @var array
	 */
	protected $channel_details;
	
	/**
	 * Contains the relations between the WooCommerce and channel fields
	 * 
	 * @var array
	 */
	protected $relations_table;

	/**
	 * Initiate new async request
	 */
	public function __construct() {
		$this->identifier = $this->prefix . '_' . $this->action;
		
		add_action( 'wp_ajax_' . $this->identifier, array( $this, 'maybe_handle' ) );
		add_action( 'wp_ajax_nopriv_' . $this->identifier, array( $this, 'maybe_handle' ) );
	}
	
	/**
	 * Set data used during the request
	 *
	 * @param array $data Data.
	 * @return $this
	 */
	public function data( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * Dispatch the async request
	 *
	 * @return array|WP_Error
	 */
	public function dispatch() {
		if ( get_option( 'wppfm_disabled_background_mode', 'false' ) === 'false' ) {
			// start the background process
			$url  = add_query_arg( $this->get_query_args(), $this->get_query_url() );
			$args = $this->get_post_args();
			return wp_remote_post( esc_url_raw( $url ), $args );
		} else {
			// start a foreground proces
			return $this->maybe_handle();
		}
	}

	/**
	 * Get query args
	 *
	 * @return array
	 */
	protected function get_query_args() {
		if ( property_exists( $this, 'query_args' ) ) {
			return $this->query_args;
		}

		return array(
			'action' => $this->identifier,
			'nonce'  => wp_create_nonce( $this->identifier ),
		);
	}

	/**
	 * Get query URL
	 *
	 * @return string
	 */
	protected function get_query_url() {
		if ( property_exists( $this, 'query_url' ) ) {
			return $this->query_url;
		}

		return admin_url( 'admin-ajax.php' );
	}

	/**
	 * Get post args
	 *
	 * @return array
	 */
	protected function get_post_args() {
		if ( property_exists( $this, 'post_args' ) ) {
			return $this->post_args;
		}

		return array(
			'timeout'   => 0.01,
			'blocking'  => false,
			'body'      => $this->data,
			'cookies'   => $_COOKIE,
			'sslverify' => apply_filters( 'https_local_ssl_verify', false ),
		);
	}

	/**
	 * Maybe handle
	 *
	 * Check for correct nonce and pass to handler.
	 */
	public function maybe_handle() {
		// Don't lock up other requests while processing
		session_write_close();

		check_ajax_referer( $this->identifier, 'nonce' );

		$this->handle();

		wp_die();
	}

	/**
	 * Handle
	 *
	 * Override this method to perform any actions required
	 * during the async request.
	 */
	abstract protected function handle();
}
