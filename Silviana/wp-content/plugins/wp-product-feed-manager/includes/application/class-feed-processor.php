<?php

/* * ******************************************************************
 * Version 1.0
 * Modified: 11-11-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Feed_Processor_Class' ) ) :

	/**
	 * The WPPFM_Feed_Processor_Class contains the functions that actually get performed in the background process
	 * 
	 * @since 1.10.0
	 */
	class WPPFM_Feed_Processor_Class extends WPPFM_Background_Process {

		use WPPFM_Processing_Support;
		
		/**
		 * Action identifier
		 * 
		 * @var string
		 */
		protected $action = 'feed_generation_process';
		
		/**
		 * Path to the feed file
		 * 
		 * @var string
		 */
		private $_feed_file_path;
		
		/**
		 * General feed data
		 * 
		 * @var string
		 */
		private $_feed_data;
		
		/**
		 * Required pre feed generation data
		 * 
		 * @var array
		 */
		private $_pre_data;
		
		/**
		 * Contains the channel specific main category title and description title
		 * 
		 * @var array
		 */
		private $_channel_details;
		
		/**
		 * Contains the relations between WooCommerce and channel fields
		 * 
		 * @var array
		 */
		private $_relation_table;

		/**
		 * Placeholder for the correct channel class
		 * 
		 * @var class
		 */
		private $_channel_class;
		
		/**
		 * Task
		 * 
		 * Starts a single feed update task
		 * 
		 * @param object product
		 * @param string feed file path
		 * @return boolean
		 */
		protected function task( $task_data, $feed_data, $feed_file_path, $pre_data, $channel_details, $relation_table ) {
			if( !$task_data ) { return false; }
			
			$this->_feed_data = $feed_data;
			$this->_feed_file_path = $feed_file_path;
			$this->_pre_data = $pre_data;
			$this->_channel_details = $channel_details;
			$this->_relation_table = $relation_table;
			
			// instantiate the correct channel class
			$this->_channel_class = new WPPFM_Google_Feed_Class();
			
			return $this->do_task( $task_data );
		}

		/**
		 * Complete
		 */
		protected function complete() {
			parent::complete();

			// remove the properties from the options table
			$properties_key = get_site_option( 'wppfm_background_process_key' );
			delete_site_option( 'wppfm_background_process_key' );
			delete_site_option( 'file_path_'.$properties_key );
			delete_site_option( 'feed_data_'.$properties_key );
			delete_site_option( 'pre_data_'.$properties_key );
			delete_site_option( 'channel_details_'.$properties_key );
			delete_site_option( 'relations_table_'.$properties_key );
			
			$feed_status = $this->_feed_data->status !== '0' && $this->_feed_data->status !== '3' && $this->_feed_data->status !== '4' ? $this->_feed_data->status : $this->_feed_data->baseStatusId;
			$feed_title = $this->_feed_data->title . '.' . pathinfo( $this->_feed_file_path, PATHINFO_EXTENSION );
			$this->register_feed_update( $this->_feed_data->feedId, $feed_title, count( $this->processed_products ), $feed_status );

			// now the feed is ready to go, remove the feed id from the feed queue
			WPPFM_Feed_Controller_Class::remove_id_from_feed_queue( $this->_feed_data->feedId );
			WPPFM_Feed_Controller_Class::set_feed_processing_flag( false );

			if ( !WPPFM_Feed_Controller_Class::feed_queue_is_empty() ) {
				// so there is another feed in the queue
				$feed_master_class = new WPPFM_Feed_Master_Class();
				$feed_master_class->update_feed_file();
			}
		}
		
		/**
		 * Task action
		 * Selects the required action
		 * 
		 * @param array $task_data
		 * @return boolean
		 */
		private function do_task( $task_data ) {
			if ( array_key_exists( 'product_id', $task_data ) ) {
				return $this->add_product_to_feed( $task_data['product_id'] );
			} elseif ( array_key_exists( 'file_format_line', $task_data ) ) {
				return $this->add_file_format_line_to_feed( $task_data );
			} elseif ( array_key_exists( 'error_message', $task_data ) ) {
				return $this->add_error_message_to_feed( $task_data );
			} else {
				return false;
			}
		}
		
		/**
		 * Ads a single product based on a product id to the feed file
		 * 
		 * @param type $product_data
		 */
		private function add_product_to_feed( $product_id ) {
			$wc_product = wc_get_product( $product_id );
			
			if ( false === $wc_product ) {
				wppfm_write_log_file( sprintf( 'Failed to get the WooCommerce product data from product with id %s.', $product_id ) );
				return false;
			}
			
			$class_data = new WPPFM_Data_Class();
			
			$product_placeholder = array();
			$post_columns_query_string = $this->_pre_data['database_fields']['post_column_string'] ? substr( $this->_pre_data['database_fields']['post_column_string'], 0, -2 ) : '';
			$product_parent_id = $product_id;
			$product_data = (array)$this->get_products_main_data( $product_id, $wc_product->get_parent_id(), $post_columns_query_string );
			
			if( ( $wc_product instanceof WC_Product_Variation && $this->_pre_data['include_vars'] ) 
				|| ( $wc_product instanceof WC_Product_Variable ) && $this->_pre_data['include_vars'] ) {

				$product_parent_id = $wc_product->get_parent_id();
				
				// add parent data when this item is not available in the variation
				$class_data->add_parent_data( $product_data, $product_parent_id, $post_columns_query_string );
				
				$wpmr_variation_data = $class_data->get_own_variation_data( $product_id );

				// get correct variation data
				WPPFM_Variations_Class::fill_product_data_with_variation_data( $product_data, $wc_product, $wpmr_variation_data, $this->_feed_data->language );
			}

			$row_category = $this->get_mapped_category( $product_parent_id, $this->_feed_data->mainCategory, json_decode( $this->_feed_data->categoryMapping ) );
			$row_filtered = $this->is_product_filtered( $this->_pre_data['filters'], $product_data );
			
			// only process the product if its not filtered out
			if ( ! $row_filtered ) {
				// for each row loop through each field
				foreach ( $this->_pre_data['active_fields'] as $field ) {
					$field_meta_data = $this->get_meta_data_from_specific_field( $field, $this->_feed_data->attributes );
					
					// get the field data based on the user settings
					$feed_object = $this->process_product_field( $product_data, $field_meta_data, $this->_channel_details['category_name'], 
						$row_category, $this->_feed_data->language, $this->_relation_table );
					
					$key = key( $feed_object );
					
					// for an xml file only add fields that contain data
					if ( ( !empty( $feed_object[ $key ] ) || $feed_object[ $key ] === '0' ) || 'xml' !== pathinfo( $this->_feed_file_path, PATHINFO_EXTENSION ) ) {
						
						// catch the DraftImages key for the Ricardo.ch channel
						if ( 'DraftImages' !== $key  ) {
							$product_placeholder[ $key ] = $feed_object[ $key ];
						} else {
							$support_class = new WPPFM_Feed_Support_Class();
							$support_class->process_ricardo_draftimages( $product_placeholder, $feed_object[ $key ] );
						}
					}
				}
			} elseif ( $row_filtered ) {
				return false;
			} elseif ( ! $row_category ) {
				echo wppfm_show_wp_error( sprintf( __( "Could not identify the correct categorymap for the product with ID: %s! 
					Please check the category settings of this product.", 'wp-product-feed-manager' ), $product_data['ID'] ) );
				return false;
			}
			
			if ( $product_placeholder ) {
				// The wppfm_feed_item_value filter allows users to modify the data that goes into the feed. The $data variable contains an array
				// with all the data that goes into the feed, with the items name as key
				$product_placeholder = apply_filters( 'wppfm_feed_item_value', $product_placeholder, $this->_feed_data->feedId, $product_id );
				
				return $this->write_product_object( $product_placeholder );
			} else {
				return false;
			}
		}
		
		private function get_products_main_data( $product_id, $parent_product_id, $post_columns_query_string ) {
			$queries_class = new WPPFM_Queries();
			$prep_meta_class = new WPPFM_Feed_Value_Editors_Class();
			
			$product_data = $queries_class->read_post_data( $product_id, $post_columns_query_string );
			
			// WPML support
			if( has_filter( 'wpml_translation' ) ) {
				$product_data = apply_filters( 'wpml_translation', $product_data, $this->_feed_data->language );
			}
			
			// parent ids are required to get the main data from product variations
			$meta_parent_ids = $parent_product_id !== 0 ? array( $parent_product_id ) : $this->get_meta_parent_ids( $product_id );
			
			array_unshift( $meta_parent_ids, $product_id ); // add the product id to the parent ids
			
			$meta_data = $queries_class->read_meta_data( $product_id, $parent_product_id, $meta_parent_ids, $this->_pre_data['database_fields']['meta_fields'] );
			
			foreach ( $meta_data as $meta ) {
				$meta_value = $prep_meta_class->prep_meta_values( $meta, $this->_feed_data->language );
				
				if ( array_key_exists( $meta->meta_key, $product_data ) ) {
					$meta_key = $meta->meta_key;

					if ( $product_data->$meta_key === '' ) {
						$product_data = (object) array_merge( (array) $product_data, array( $meta->meta_key => $meta_value ) );
					}
				} else {
					$product_data = (object) array_merge( (array) $product_data, array( $meta->meta_key => $meta_value ) );
				}
			}
			
			foreach ( $this->_pre_data['database_fields']['active_custom_fields'] as $field ) {
				$product_data->{$field} = $this->get_custom_field_data( $product_data->ID, $parent_product_id, $field );
			}
			
			foreach ( $this->_pre_data['database_fields']['third_party_custom_fields'] as $third_party_field ) {
				$product_data->{$third_party_field} = $this->get_third_party_custom_field_data( $product_data->ID, $parent_product_id, $third_party_field );
			}
			
			$this->add_procedural_data( $product_data, $this->_pre_data['column_names'], $this->_feed_data->language );
			
			return $product_data;
		}
		
		/**
		 * Adds a string to the feed
		 * 
		 * @param string $line_data
		 */
		private function add_file_format_line_to_feed( $line_data ) {
			return false !== file_put_contents( $this->_feed_file_path, $line_data['file_format_line'], FILE_APPEND ) ? true : false;
		}
		
		/**
		 * Adds an error message to the feed
		 * 
		 * @param string $error_message_data
		 */
		private function add_error_message_to_feed( $error_message_data ) {
			return false !== file_put_contents( $this->_feed_file_path, $error_message_data['feed_line_message'], FILE_APPEND ) ? true : false;
		}
		
		/**
		 * Appends a product to the feed
		 * 
		 * @param object $feed_product_object
		 */
		private function write_product_object( $feed_product_object ) {
			$product_text = $this->generate_feed_text( $feed_product_object );
			return false !== file_put_contents( $this->_feed_file_path, $product_text, FILE_APPEND ) ? 'product added' : false;
		}

		/**
		 * convert the feed data of a single product into xml or csv text depending on the channel
		 * 
		 * @param array $data
		 * @param array $channel_details
		 * @param string $file_extension
		 * @param array $active_fields
		 * @return string
		 */
		protected function generate_feed_text( $data ) {
			switch ( pathinfo( $this->_feed_file_path, PATHINFO_EXTENSION ) ) {
				case 'xml':
					return $this->convert_data_to_xml( $data, $this->_channel_details['category_name'], $this->_channel_details['description_name'], $this->_channel_details['channel_id'] );

				case 'txt':
					return $this->convert_data_to_txt( $data );

				case 'csv':
					$csv_sep = apply_filters( 'wppfm_csv_separator', get_correct_csv_separator( $this->_channel_details['channel_id'] ) );
					return $this->convert_data_to_csv( $data, $this->_pre_data['active_fields'], $csv_sep );
			}
		}
	
	}
	
endif;
