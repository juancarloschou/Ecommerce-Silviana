<?php

/* * ******************************************************************
 * Version 1.0
 * Modified: 12-03-2018
 * Copyright 2018 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Feed_Controller_Class' ) ) :

	/**
	 * The Feed Controller class contains the feed functions that are used to control the
	 * feed processing actions
	 * 
	 * @since 1.10.0
	 * 
	 * @class WPPFM_Feed_Controller_Class
	 */
	class WPPFM_Feed_Controller_Class {

		/**
		 * Removes a feed id from the feed queue
		 * 
		 * @param string $feed_id
		 */
		public static function remove_id_from_feed_queue( $feed_id ) {
			$feed_queue = self::get_feed_queue();
			
			if( ( $key = array_search( $feed_id, $feed_queue ) ) !== false ) {
				unset( $feed_queue[ $key ] );
				$feed_queue = array_values( $feed_queue ); // resort array after unset
				update_site_option( 'wppfm_feed_queue', $feed_queue );
			}
		}

		/**
		 * Adds an feed id to the feed queue
		 * 
		 * @param string $feed_id
		 */
		public static function add_id_to_feed_queue( $feed_id ) {
			$feed_queue = self::get_feed_queue();

			if( !in_array( $feed_id, $feed_queue ) ) {
				array_push( $feed_queue, $feed_id );
				update_site_option( 'wppfm_feed_queue', $feed_queue );
			}
		}

		/**
		 * Gets the next feed id from the feed queue
		 */
		public static function get_next_id_from_feed_queue() {
			$feed_queue = self::get_feed_queue();
			return count( $feed_queue ) > 0 ? $feed_queue[0] : false;
		}

		/**
		 * Empties the feed queue
		 */
		public static function clear_feed_queue() {
			update_site_option( 'wppfm_feed_queue', array() );
		}

		/**
		 * Checks if the feed queue is empty
		 * 
		 * @return bool
		 */
		public static function feed_queue_is_empty() {
			$queue = self::get_feed_queue();
			return ( count( $queue ) > 0 ) ? false : true;
		}

		/**
		 * Sets the background_process_is_running option
		 * 
		 * @param bool $set (default false)
		 */
		public static function set_feed_processing_flag( $set = false ) {
			$status = false === $set ? 'false' : 'true';
			update_site_option( 'wppfm_background_process_is_running', $status );
		}
		
		/** Get the background_process_is_running status
		 * 
		 * @return bool
		 */
		public static function feed_is_processing() {
			$status = get_option( 'wppfm_background_process_is_running', 'false' );
			return 'true' === $status ? true : false;
		}
		
		/**
		 * Returns the current feed queue
		 * 
		 * @global type $wpdb
		 * @return array
		 */
		protected static function get_feed_queue() {
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

			$query = $wpdb->get_row( $wpdb->prepare( "
			SELECT *
			FROM {$table}
			WHERE {$column} LIKE %s
			ORDER BY {$key_column} ASC
			LIMIT 1
			", '%wppfm_feed_queue%' ) );

			return null !== $query ? maybe_unserialize( $query->$value_column ) : array();
		}
	}
	
endif;