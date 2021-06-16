<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Abstract WPPFM_Background_Process class, derived from https://github.com/A5hleyRich/wp-background-processing.
 *
 * @abstract
 * @package WPPFM-Background-Processing
 * @extends WPPFM_Async_Request
 */
abstract class WPPFM_Background_Process extends WPPFM_Async_Request {

	/**
	 * Action
	 *
	 * (default value: 'background_process')
	 *
	 * @var string
	 * @access protected
	 */
	protected $action = 'background_process';

	/**
	 * Start time of current process.
	 *
	 * (default value: 0)
	 *
	 * @var int
	 * @access protected
	 */
	protected $start_time = 0;

	/**
	 * Cron_hook_identifier
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $cron_hook_identifier;

	/**
	 * Cron_interval_identifier
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $cron_interval_identifier;
	
	/**
	 * Keeps track of the number of products that where added to the feed
	 * 
	 * @var int 
	 */
	protected $processed_products;

	/**
	 * Initiate new background process
	 */
	public function __construct() {
		parent::__construct();

		$this->cron_hook_identifier     = $this->identifier . '_cron';
		$this->cron_interval_identifier = $this->identifier . '_cron_interval';
		$this->processed_products = get_option( 'wppfm_processed_products' ) ? explode( ', ', get_option( 'wppfm_processed_products' ) ) : array();

		add_action( $this->cron_hook_identifier, array( $this, 'handle_cron_health_check' ) );
		add_filter( 'cron_schedules', array( $this, 'schedule_cron_health_check' ) );
	}
	
	/**
	 * Dispatch
	 *
	 * @access public
	 * @return void
	 */
	public function dispatch() {
		// Schedule the cron health check.
		$this->schedule_event();
		// Perform remote post.
		return parent::dispatch();
	}

	/**
	 * Push to queue
	 *
	 * @param mixed $data Data.
	 * @return $this
	 */
	public function push_to_queue( $data ) {
		$this->data[] = $data;

		return $this;
	}
	
	/**
	 * Clears the queue
	 * 
	 * @return $this
	 */
	public function clear_the_queue() {
		$this->data = null;
		
		return $this;
	}
	
	/**
	 * Set the path to the feed file
	 * 
	 * @param string $file_path
	 * @return $this
	 */
	public function set_file_path( $file_path ) {
		$this->file_path = $file_path;
		
		return $this;
	}
	
	/**
	 * Set the language of the feed
	 * 
	 * @param type $language
	 * @return $this
	 */
	public function set_feed_data( $feed_data ) {
		$this->feed_data = $feed_data;
		
		return $this;
	}
	
	/**
	 * Set the feed pre data
	 * 
	 * @param array $pre_data
	 * @return $this
	 */
	public function set_pre_data( $pre_data ) {
		$this->pre_data = $pre_data;
		
		return $this;
	}
	
	/**
	 * Set the channel specific main category title and description title
	 * 
	 * @param array $channel_details
	 * @return $this
	 */
	public function set_channel_details( $channel_details ) {
		$this->channel_details = $channel_details;
		
		return $this;
	}
	
	/**
	 * Sets the relation table
	 * 
	 * @param array $relations_table
	 * @return $this
	 */
	public function set_relations_table( $relations_table ) {
		$this->relations_table = $relations_table;
		
		return $this;
	}

	/**
	 * Save queue
	 *
	 * @return $this
	 */
	public function save( $feed_id ) {
		$key = $this->generate_key( $feed_id );

		if ( ! empty( $this->data ) ) {
			update_site_option( 'wppfm_background_process_key', $key );
			update_site_option( $key, $this->data );
			update_site_option( 'feed_data_'.$key, $this->feed_data );
			update_site_option( 'file_path_'.$key, $this->file_path );
			update_site_option( 'pre_data_'.$key, $this->pre_data );
			update_site_option( 'channel_details_'.$key, $this->channel_details );
			update_site_option( 'relations_table_'.$key, $this->relations_table );
		}

		return $this;
	}

	/**
	 * Update queue
	 *
	 * @param string $key Key.
	 * @param array  $data Data.
	 *
	 * @return $this
	 */
	public function update( $key, $data ) {
		if ( ! empty( $data ) ) {
			update_site_option( 'wppfm_background_process_key', $key );
			update_site_option( $key, $data );
		}

		return $this;
	}

	/**
	 * Delete queue and properties stored in the options table
	 *
	 * @param string $key Key.
	 *
	 * @return $this
	 */
	public function delete( $key ) {
		delete_site_option( $key );

		return $this;
	}

	/**
	 * Generate key
	 *
	 * Generates a unique key based on microtime. Queue items are
	 * given a unique key so that they can be merged upon save.
	 *
	 * @param int $length Length.
	 *
	 * @return string
	 */
	protected function generate_key( $feed_id, $length = 64 ) {
		$unique  = md5( microtime() . rand() );
		$prepend = $this->identifier . '_batch_' . $feed_id . '_';

		return substr( $prepend . $unique, 0, $length );
	}

	/**
	 * Maybe process queue
	 *
	 * Checks whether data exists within the queue and that
	 * the process is not already running.
	 */
	public function maybe_handle() {
		// Don't lock up other requests while processing
		session_write_close();
		
		$background_mode_disabled = get_option( 'wppfm_disabled_background_mode', 'false' );
		
		if ( $background_mode_disabled === 'false' && $this->is_process_running() ) {
			// Background process already running.
			wp_die();
		}

		if ( $this->is_queue_empty() ) {
			// No data to process.
			wp_die();
		}

		if ( $background_mode_disabled === 'false' )
			check_ajax_referer( $this->identifier, 'nonce' );
		
		$this->handle();

		wp_die();
	}

	/**
	 * Is queue empty
	 *
	 * @return bool
	 */
	protected function is_queue_empty() {
		global $wpdb;

		$table  = $wpdb->options;
		$column = 'option_name';

		if ( is_multisite() ) {
			$table  = $wpdb->sitemeta;
			$column = 'meta_key';
		}

		$key = $wpdb->esc_like( $this->identifier . '_batch_' ) . '%';

		$count = $wpdb->get_var( $wpdb->prepare( "
		SELECT COUNT(*)
		FROM {$table}
		WHERE {$column} LIKE %s
	", $key ) );

		return ( $count > 0 ) ? false : true;
	}

	/**
	 * Is process running
	 *
	 * Check whether the current process is already running
	 * in a background process.
	 */
	public function is_process_running() {
		if ( get_site_transient( $this->identifier . '_process_lock' ) ) {
			// Process already running.
			return true;
		}

		return false;
	}
	
	/**
	 * Lock process
	 *
	 * Lock the process so that multiple instances can't run simultaneously.
	 * Override if applicable, but the duration should be greater than that
	 * defined in the time_exceeded() method.
	 */
	protected function lock_process() {
		$this->start_time = time(); // Set start time of current process.

		$lock_duration = ( property_exists( $this, 'queue_lock_time' ) ) ? $this->queue_lock_time : 60; // 1 minute
		$lock_duration = apply_filters( $this->identifier . '_queue_lock_time', $lock_duration );

		set_site_transient( $this->identifier . '_process_lock', microtime(), $lock_duration );
	}

	/**
	 * Unlock process
	 *
	 * Unlock the process so that other instances can spawn.
	 *
	 * @return $this
	 */
	protected function unlock_process() {
		delete_site_transient( $this->identifier . '_process_lock' );
		return $this;
	}
	
	/**
	 * Get batch
	 *
	 * @return stdClass Return the first batch from the queue
	 */
	protected function get_batch() {
		global $wpdb;

		$table        = $wpdb->options;
		$column       = 'option_name';
		$key_column   = 'option_id';
		$value_column = 'option_value';

		if ( is_multisite() ) {
			$table        = $wpdb->sitemeta;
			$column       = 'meta_key';
			$key_column   = 'meta_id';
			$value_column = 'meta_value';
		}

		$key = $wpdb->esc_like( $this->identifier . '_batch_' ) . '%';

		$query = $wpdb->get_row( $wpdb->prepare( "
		SELECT *
		FROM {$table}
		WHERE {$column} LIKE %s
		ORDER BY {$key_column} ASC
		LIMIT 1
		", $key ) );
		
		$batch       = new stdClass();
		$batch->key  = $query->$column;
		$batch->data = maybe_unserialize( $query->$value_column );

		return $batch;
	}

	/**
	 * Handle
	 *
	 * Pass each queue item to the task handler, while remaining
	 * within server memory and time limit constraints.
	 */
	protected function handle() {
		$this->lock_process();
		
		do {
			$batch = $this->get_batch();

			$properties_key = get_site_option( 'wppfm_background_process_key' );
			$feed_file_path = get_site_option( 'file_path_'.$properties_key );
			$feed_data = get_site_option( 'feed_data_'.$properties_key );
			$pre_data = get_site_option( 'pre_data_'.$properties_key );
			$channel_details = get_site_option( 'channel_details_'.$properties_key );
			$relations_table = get_site_option( 'relations_table_'.$properties_key );
			
			foreach ( $batch->data as $key => $value ) {
				// prevent doubles in the feed
				if( is_array( $value ) && array_key_exists( 'product_id', $value ) && in_array( $value['product_id'], $this->processed_products ) ) { continue; }

				$task = $this->task( $value, $feed_data, $feed_file_path, $pre_data, $channel_details, $relations_table );
				
				if ( false === $task ) {
					if ( ! $value ) {
						unset( $batch->data[ $key ] );
					} else {
						$batch->data[ $key ] = $task;
					}
				} else {
					unset( $batch->data[ $key ] );
					if( 'product added' === $task && array_key_exists( 'product_id', $value ) ) { array_push( $this->processed_products, $value['product_id'] ); }
				}

				if ( $this->time_exceeded() || $this->memory_exceeded() ) {
					// Batch limits reached.
					$this->delete( $batch->key );
					break;
				}
			}

			// Update or delete current batch.
			if ( ! empty( $batch->data ) ) {
				$this->update( $batch->key, $batch->data );
			} else {
				$this->delete( $batch->key );
			}
		} while ( ! $this->time_exceeded() && ! $this->memory_exceeded() && ! $this->is_queue_empty() );

		$this->unlock_process();

		// Start next batch or complete process.
		if ( ! $this->is_queue_empty() ) {
			update_option( 'wppfm_processed_products', implode( ', ', $this->processed_products ) );
			$this->dispatch();
		} else {
			$this->complete();
		}
	}

	/**
	 * Memory exceeded
	 *
	 * Ensures the batch process never exceeds 90%
	 * of the maximum WordPress memory.
	 *
	 * @return bool
	 */
	protected function memory_exceeded() {
		$memory_limit   = $this->get_memory_limit() * 0.9; // 90% of max memory
		$current_memory = memory_get_usage( true );
		$return         = false;

		if ( $current_memory >= $memory_limit ) {
			$return = true;
		}

		return apply_filters( $this->identifier . '_memory_exceeded', $return );
	}

	/**
	 * Get memory limit
	 *
	 * @return int
	 */
	protected function get_memory_limit() {
		if ( function_exists( 'ini_get' ) ) {
			$memory_limit = ini_get( 'memory_limit' );
		} else {
			// Sensible default.
			$memory_limit = '128M';
		}

		if ( ! $memory_limit || -1 === intval( $memory_limit ) ) {
			// Unlimited, set to 32GB.
			$memory_limit = '32000M';
		}

		return intval( $memory_limit ) * 1024 * 1024;
	}

	/**
	 * Time exceeded.
	 *
	 * Ensures the batch never exceeds a sensible time limit.
	 * A timeout limit of 30s is common on shared hosting.
	 *
	 * @return bool
	 */
	protected function time_exceeded() {
		$finish = $this->start_time + apply_filters( $this->identifier . '_default_time_limit', 20 ); // 20 seconds
		$return = false;

		if ( time() >= $finish ) {
			$return = true;
		}

		return apply_filters( $this->identifier . '_time_exceeded', $return );
	}

	/**
	 * Complete.
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {
		delete_option( 'wppfm_processed_products' );

		// Unschedule the cron health check.
		$this->clear_scheduled_event();
		$this->unlock_process();
	}

	/**
	 * Schedule cron health check
	 *
	 * @access public
	 * @param mixed $schedules Schedules.
	 * @return mixed
	 */
	public function schedule_cron_health_check( $schedules ) {
		$interval = apply_filters( $this->identifier . '_cron_interval', 5 );

		if ( property_exists( $this, 'cron_interval' ) ) {
			$interval = apply_filters( $this->identifier . '_cron_interval', $this->cron_interval_identifier );
		}

		// Adds every 5 minutes to the existing schedules.
		$schedules[ $this->identifier . '_cron_interval' ] = array(
			'interval' => MINUTE_IN_SECONDS * $interval,
			'display'  => sprintf( __( 'Every %d minutes', 'woocommerce' ), $interval ),
		);

		return $schedules;
	}

	/**
	 * Handle cron health check
	 *
	 * Restart the background process if not already running
	 * and data exists in the queue.
	 */
	public function handle_cron_health_check() {
		if ( $this->is_process_running() ) {
			// Background process already running.
			exit;
		}

		if ( $this->is_queue_empty() ) {
			// No data to process.
			$this->clear_scheduled_event();
			exit;
		}

		$this->handle();

		exit;
	}

	/**
	 * Schedule event
	 */
	protected function schedule_event() {
		if ( ! wp_next_scheduled( $this->cron_hook_identifier ) ) {
			wp_schedule_event( time(), $this->cron_interval_identifier, $this->cron_hook_identifier );
		}
	}

	/**
	 * Clear scheduled event
	 */
	protected function clear_scheduled_event() {
		$timestamp = wp_next_scheduled( $this->cron_hook_identifier );

		if ( $timestamp ) {
			wp_unschedule_event( $timestamp, $this->cron_hook_identifier );
		}
	}

	/**
	 * Cancel Process
	 *
	 * Stop processing queue items, clear cronjob and delete batch.
	 *
	 */
	public function cancel_process() {
		if ( ! $this->is_queue_empty() ) {
			$batch = $this->get_batch();

			$this->delete( $batch->key );

			wp_clear_scheduled_hook( $this->cron_hook_identifier );
		}

	}

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param mixed $item Queue item to iterate over.
	 * @param array $feed_data
	 * @param string $feed_file_path
	 *
	 * @return mixed
	 */
	abstract protected function task( $item, $feed_data, $feed_file_path, $pre_data, $channel_details, $relation_table );

}
