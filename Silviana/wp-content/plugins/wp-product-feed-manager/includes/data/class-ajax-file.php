<?php

/* * ******************************************************************
 * Version 2.6
 * Modified: 05-05-2018
 * Copyright 2018 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Ajax_File_Class' ) ) :

	/**
	 * The WPPFM_Ajax_File_Class contains all functions for file manipulation ajax calls
	 * 
	 * @class		WPPFM_Ajax_File_Class
	 * @version		2.5
	 * @category	Class
	 * @author		Michel Jongbloed
	 */
	class WPPFM_Ajax_File_Class extends WPPFM_Ajax_Calls {

		/**
		 * Class constructor
		 */
		public function __construct() {

			parent::__construct();

			// hooks
			add_action( 'wp_ajax_myajax-get-next-categories', array( $this, 'myajax_read_next_categories' ) );
			add_action( 'wp_ajax_myajax-get-category-lists', array( $this, 'myajax_read_category_lists' ) );
			add_action( 'wp_ajax_myajax-delete-feed-file', array( $this, 'myajax_delete_feed_file' ) );
			add_action( 'wp_ajax_myajax-update-feed-file', array( $this, 'myajax_update_feed_file' ) );
			add_action( 'wp_ajax_myajax-log-message', array( $this, 'myajax_log_message' ) );
			add_action( 'wp_ajax_myajax-auto-feed-fix-mode-selection', array( $this, 'myajax_auto_feed_fix_mode_selection' ) );
			add_action( 'wp_ajax_myajax-background-processing-mode-selection', array( $this, 'myajax_background_processing_mode_selection' ) );
			add_action( 'wp_ajax_myajax-debug-mode-selection', array( $this, 'myajax_debut_mode_selection' ) );
			add_action( 'wp_ajax_myajax-third-party-attribute-keywords', array( $this, 'myajax_set_third_party_attribute_keywords' ) );
			add_action( 'wp_ajax_myajax-clear-feed-process-data', array( $this, 'myajax_clear_feed_process_data' ) );
			add_action( 'wp_ajax_myajax-reinitiate-plugin', array( $this, 'myajax_reinitiate_plugin' ) );
		}

		/* --------------------------------------------------------------------------------------------------*
		 * Public functions
		 * -------------------------------------------------------------------------------------------------- */

		/**
		 * Returns the sub-categories from a selected category
		 */
		public function myajax_read_next_categories() {
			
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'nextCategoryNonce' ), 'myajax-next-category-nonce' ) ) {
				$file_class = new WPPFM_File_Class();

				$channel_id		 = filter_input( INPUT_POST, 'channelId' );
				$requested_level = filter_input( INPUT_POST, 'requestedLevel' );
				$parent_category = filter_input( INPUT_POST, 'parentCategory' );
				$file_language	 = filter_input( INPUT_POST, 'fileLanguage' );
				$categories = $file_class->get_categories_for_list( $channel_id, $requested_level, $parent_category, $file_language );

				if ( !is_array( $categories ) ) {
					if ( substr( $categories, -1 ) === "0" ) {
						chop( $categories, '0' );
					}
				}

				echo json_encode( $categories );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * 
		 */
		public function myajax_read_category_lists() {
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'categoryListsNonce' ), 'myajax-category-lists-nonce' ) ) {
				$file_class = new WPPFM_File_Class();
				
				$channel_id				 = filter_input( INPUT_POST, 'channelId' );
				$main_categories_string	 = filter_input( INPUT_POST, 'mainCategories' );
				$file_language			 = filter_input( INPUT_POST, 'fileLanguage' );
				$categories_array = explode( ' > ', $main_categories_string );
				$categories = array();
				$required_levels = count( $categories_array ) > 0 ? ( count( $categories_array ) + 1 ) : count( $categories_array );
				
				for ( $i = 0; $i < $required_levels; $i ++ ) {
					$parent_category = $i > 0 ? $categories_array[ $i - 1 ] : '';
					$c = $file_class->get_categories_for_list( $channel_id, $i, $parent_category, $file_language );
					if ( $c ) { array_push( $categories, $c  ); }
				}

				echo json_encode( $categories );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * Delete a specific feed file
		 */
		public function myajax_delete_feed_file() {

			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'deleteFeedNonce' ), 'myajax-delete-feed-nonce' ) ) {
				$file_name = filter_input( INPUT_POST, 'fileTitle' );
				
				if ( file_exists( WP_PLUGIN_DIR . '/wp-product-feed-manager-support/feeds/' . $file_name ) ) {
					$file = WP_PLUGIN_DIR . '/wp-product-feed-manager-support/feeds/' . $file_name;
				} else {
					$file = WPPFM_FEEDS_DIR . '/' . $file_name;
				}

				// only return results when the user is an admin with manage options
				if ( is_admin() ) {
					echo file_exists( $file ) ? unlink( $file ) : wppfm_show_wp_error( __( "Could not find file $file.", 'wp-product-feed-manager' ) );
				} else {
					echo wppfm_show_wp_error( __( 'Error deleting the feed. You do not have the correct authorities to delete the file.', 'wp-product-feed-manager' ) );
				}
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * This function fetches the posted data and triggers the update of the feed file on the server.
		 */
		public function myajax_update_feed_file() {

			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'updateFeedFileNonce' ), 'myajax-update-feed-file-nonce' ) ) {
				// fetch the data from $_POST
				$feed_id	 = filter_input( INPUT_POST, 'feedId' );
				
				// only return results when the user is an admin with manage options
				if ( is_admin() ) {
					WPPFM_Feed_Controller_Class::add_id_to_feed_queue($feed_id);
					
					// if there is no feed processing in progress, start updating the current feed
					if( ! WPPFM_Feed_Controller_Class::feed_is_processing() ) {
						$feed_master_class = new WPPFM_Feed_Master_Class();
						$feed_master_class->update_feed_file( false );
					} else {
						$data_class = new WPPFM_Data_Class();
						$data_class->update_feed_status( $feed_id, 4 ); // feed status to waiting in queue
						echo __( 'Pushed the feed to the background queue. Processing starts after all other feeds are processed.', 'wp-product-feed-manager' );
					}
				} else {
					echo wppfm_show_wp_error( __( 'Error writing the feed. You do not have the correct authorities to write the file.', 'wp-product-feed-manager' ) );
				}
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * Logs a message from a javascript call to the server
		 */
		public function myajax_log_message() {

			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'logMessageNonce' ), 'myajax-log-message-nonce' ) ) {
				// fetch the data from $_POST
				$message		 = filter_input( INPUT_POST, 'messageList' );
				$fileName		 = filter_input( INPUT_POST, 'fileName' );
				$text_message	 = strip_tags( $message );

				// only return results when the user is an admin with manage options
				if ( is_admin() ) {
					echo wppfm_write_log_file( $text_message, $fileName );
				} else {
					echo wppfm_show_wp_error( __( 'Error writing the feed. You do not have the correct authorities to write the file.', 'wp-product-feed-manager' ) );
				}
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * Changes the Auto Feed Fix setting from the Settings page
		 * 
		 * @since 1.7.0
		 */
		public function myajax_auto_feed_fix_mode_selection() {
			
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'updateAutoFeedFixNonce' ), 'myajax-auto-feed-fix-nonce' ) ) {
				$selection = filter_input( INPUT_POST, 'fix_selection' );
				update_option( 'wppfm_auto_feed_fix', $selection );
				
				echo get_option( 'wppfm_auto_feed_fix' );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}

		/**
		 * Changes the Disable Background processing setting from the Settings page
		 * 
		 * @since 2.0.7
		 */
		public function myajax_background_processing_mode_selection() {
			
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'backgroundModeNonce' ), 'myajax-background-mode-nonce' ) ) {
				$selection = filter_input( INPUT_POST, 'mode_selection' );
				update_option( 'wppfm_disabled_background_mode', $selection );
				
				echo get_option( 'wppfm_disabled_background_mode' );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}
		
		/**
		 * Changes the Debug setting from the Settings page
		 * 
		 * @since 1.9.0
		 */
		public function myajax_debug_mode_selection() {
			
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'debugNonce' ), 'myajax-debug-nonce' ) ) {
				$selection = filter_input( INPUT_POST, 'debug_selection' );
				update_option( 'wppfm_debug_mode', $selection );
				
				echo get_option( 'wppfm_debug_mode' );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}
		
		/**
		 * Stores the third party attribute keywords
		 * 
		 * @since 1.8.0
		 */
		public function myajax_set_third_party_attribute_keywords() {
			// make sure this call is legal
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'thirdPartyKeywordsNonce' ), 'myajax-set-third-party-keywords-nonce' ) ) {
				$keywords = filter_input( INPUT_POST, 'keywords' );
				update_option( 'wppfm_third_party_attribute_keywords', $keywords );
				
				echo get_option( 'wppfm_third_party_attribute_keywords' );
			}

			// IMPORTANT: don't forget to exit
			exit;
		}
		
		/**
		 * Re-initiates the plugin, updates the database and loads all cron jobs
		 * 
		 * @since 1.9.0
		 */
		public function myajax_reinitiate_plugin() {
			
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'reInitiateNonce' ), 'myajax-reinitiate-nonce' ) ) {
				
				if ( wppfm_reinitiate_plugin() ) {
					echo "Plugin re-initiated";
				} else {
					echo "Re-initiation failed!";
				}
			}

			// IMPORTANT: don't forget to exit
			exit;
		}
		
		/**
		 * Clears all option data that is related to the feed processing
		 * 
		 * @since 1.10.0
		 */
		public function myajax_clear_feed_process_data() {
			
			if ( $this->safe_ajax_call( filter_input( INPUT_POST, 'clearFeedNonce' ), 'myajax-clear-feed-nonce' ) ) {
				
				if ( wppfm_clear_feed_process_data() ) {
					echo "Feed processing data cleared";
				} else {
					echo "Clearing failed!";
				}
			}

			// IMPORTANT: don't forget to exit
			exit;
		}
	}

	// End of WPPFM_Ajax_File_Class

endif;

$myajaxfileclass = new WPPFM_Ajax_File_Class();