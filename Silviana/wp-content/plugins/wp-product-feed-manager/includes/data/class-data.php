<?php

/* * ******************************************************************
 * Version 3.1
 * Modified: 07-04-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Data_Class' ) ) :

	/**
	 * The WPPFM_Data_Class contains all functions for non-ajax database manipulations
	 * 
	 * @class WPPFM_Data_Class
	 * @version dev
	 * @category class
	 */
	class WPPFM_Data_Class {

		// @private storage for queries class
		private $_queries;
		private $_files;

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->_queries	 = new WPPFM_Queries ();
			$this->_files	 = new WPPFM_File_Class();
		}

		/**
		 * Public functions
		 */
		public function get_countries() { return $this->_queries->read_countries();	}

		public function get_channel_id_from_short_name( $channel_short_name ) { return $this->_queries->get_channel_id( $channel_short_name ); }

		public function get_channels() { return $this->_queries->read_channels(); }

		public function delete_channel( $channel_id ) { return $this->_queries->remove_channel( $channel_id ); }

		public function delete_channel_feeds( $channel_id ) {

			$feeds = $this->_queries->get_feeds_from_specific_channel( $channel_id );

			foreach ( $feeds as $feed_id ) {

				$this->_queries->delete_meta( $feed_id[ 'product_feed_id' ] );

				$this->_queries->delete_feed( $feed_id[ 'product_feed_id' ] );
			}
		}

		public function get_feed_files_from_channel( $channel_id ) { return $this->_queries->get_feed_file_names_from_channel( $channel_id ); }

		public function get_sources() { return $this->_queries->read_sources();	}

		public function get_country_id_from_short_code( $country_code ) {

			if ( $country_code !== '0' ) {

				return $this->_queries->get_country_id( $country_code );
			} else {

				$id				 = new stdClass();
				$id->country_id	 = '233';

				return $id;
			}
		}

		public function get_schedule_data() { return $this->_queries->read_active_schedule_data(); }
		
		public function get_failed_feeds() { return $this->_queries->read_failed_feeds(); }

		// 291217
		//public function get_status_id_from_status( $status ) { return $this->_queries->get_status_id( $status ); }

		public function get_feed_status( $feed_id ) { 
			$feed_status = $this->_queries->get_current_feed_status( $feed_id );
			return $feed_status[ 0 ]->status_id; 
		}

		public function set_nr_of_feed_products( $feed_id, $nr ) { return $this->_queries->set_nr_feed_products( $feed_id, $nr ); }
		
		public function get_nr_of_feed_products( $feed_id ) { return $this->_queries->get_nr_feed_products( $feed_id );	}

		public function update_feed_data( $feed_id, $feed_url, $nr_products ) { return $this->_queries->update_feed_update_data( $feed_id, $feed_url, $nr_products ); }

		public function update_feed_status( $feed_id, $status ) { return $this->_queries->update_feed_file_status( $feed_id, $status );	}

		/**
		 * Fills output fields with stored meta data
		 * 
		 * @access public
		 * @param type $feed_id
		 * @param type $outputs
		 * @return type
		 */
		public function fill_output_fields_with_metadata( $feed_id, $outputs ) {

			// read the meta data from the database
			$metadata = $this->_queries->read_metadata( $feed_id );

			// loop through the output rows
			for ( $i = 0; $i < count( $outputs ); $i ++ ) {

				// check if there is specific meta data for this output row
				if ( count( $metadata ) > 0 ) {

					foreach ( $metadata as $meta ) {

						// look for a match
						if ( $meta[ 'meta_key' ] === $outputs[ $i ]->field_label ) {

							// put the meta data in the value variable of the output row
							$outputs[ $i ]->value = $meta[ 'meta_value' ];
							break; // break is required to stop the foreach loop and prevent the following loop from clearing the value
						} else {

							// as long as there is no match, leave the value empty
							$outputs[ $i ]->value = "";
						}
					}
				} else {

					$outputs[ $i ]->value = "";
				}
			}

			return $outputs;
		}

		public function get_filter_query( $feed_id ) { return $this->_queries->get_product_filter_query( $feed_id ); }
		
		public function get_own_variation_data( $variation_id ) { return $this->_queries->get_own_variable_product_attributes( $variation_id );	}
		
		public function add_parent_data( &$product_data, $parent_id, $post_columns_query_string ) { 
			$parent_product_data = (array)$this->_queries->read_post_data( $parent_id, $post_columns_query_string );
			
			$colums = explode( ', ', $post_columns_query_string );

			foreach( $colums as $column ) {
				if( $product_data[$column] === '' && array_key_exists( $column, $parent_product_data ) && $parent_product_data[$column] !== '' ) {
					$product_data[$column] = $parent_product_data[$column];
				}
			}
		}

		public function get_custom_fields_with_metadata( $feed_id ) {

			// read the meta data from the database
			$metadata	 = $this->_queries->read_metadata( $feed_id );
			$outputs	 = array();

			// loop through the output rows
			for ( $i = 0; $i < count( $metadata ); $i ++ ) {

				$object = new stdClass();

				$object->field_id	 = $i + 1;
				$object->category_id = '5';
				$object->field_label = $metadata[ $i ][ 'meta_key' ];
				$object->value		 = $metadata[ $i ][ 'meta_value' ];

				array_push( $outputs, $object );
			}

			return $outputs;
		}

 		public function get_third_party_custom_fields() {
			
			$custom_fields = array();
			
			// YITH Brands plugin
			$yith_brand_label = get_option( 'yith_wcbr_brands_label' );
			if ( $yith_brand_label ) { array_push( $custom_fields, $yith_brand_label ); }
			
			// WooCommerce Brands
			if ( in_array( 'woocommerce-brands/woocommerce-brands.php', apply_filters( 'active_plugins', 
				get_option( 'active_plugins' ) ) ) ) { array_push( $custom_fields, 'Brand' ); }
			
			return $custom_fields;
		}
		
		/**
		 * Checks if other feeds than the active feed are still on processing status. If so, set these feeds to error
		 * 
		 * @since 1.10.0
		 * 
		 * @param string $active_feed_id
		 */
		public function check_for_failed_feeds( $active_feed_id ) {
			$processing_feeds = $this->_queries->get_feed_ids_with_specific_status( '3' );
			
			foreach( $processing_feeds as $feed ) {
				if( $active_feed_id !== $feed->product_feed_id ) {
					$this->_queries->update_current_feed_status( $feed->product_feed_id, 6);
				}
			}
		}

		public function get_feed_data( $feed_id ) {
			// get the main data
			$main_feed_data = $this->_queries->read_feed( $feed_id );
			$main_data = $this->convert_data_to_feed_data( $main_feed_data[ 0 ] );
			$main_data->attributes = array();
			
			$channel = $this->_queries->get_channel_short_name_from_db( $main_feed_data[ 0 ][ 'channel' ] );
			$is_custom = function_exists( 'channel_is_custom_channel' ) ? channel_is_custom_channel( $channel ) : false;

			// read the output fields
			if ( ! $is_custom ) {
				$outputs = $this->_files->get_output_fields_for_specific_channel( $channel );
			} else {
				$outputs = $this->get_custom_fields_with_metadata( $feed_id );
			}

			// add meta data to the feeds output fields
			$output_fields = $this->fill_output_fields_with_metadata( $feed_id, $outputs );
			$inputs = $this->get_advised_inputs( $main_data->channel, $main_data->dataSource );
			
			for ( $i = 0; $i < count( $output_fields ); $i++ ) {
				$output_title	 = $output_fields[ $i ]->field_label;
				$is_active		 = false;

				if ( $output_fields[ $i ]->category_id > 0 && $output_fields[ $i ]->category_id < 3 ) { $is_active = true; }
				if ( !empty( $output_fields[ $i ]->value ) && $output_fields[ $i ]->value !== 'undefined' ) { $is_active = true; }

				$advised_source	 = property_exists( $inputs, $output_title ) ? $advised_source	 = $inputs->{$output_title} : '';
				$this->add_attribute( $main_data->attributes, $i, $output_title, $advised_source, $output_fields[ $i ]->value, $output_fields[ $i ]->category_id, $is_active, 0, 0, 0 );
			}
			
			$this->set_output_attribute_levels( $main_data );
			
			return $main_data;
		}

		// ALERT has a relation with the wppfm_setOutputAttributeLevels() function in the logic.js file
		private function set_output_attribute_levels( &$main_data ) {
			$channel_base_class	 = new WPPFM_Channel();
			$channel_short_name	 = $channel_base_class->get_channel_short_name( $main_data->channel );

			if ( class_exists( 'WPPFM_' . ucfirst( $channel_short_name ) . '_Feed_Class' ) ) {
				$class_name	 = 'WPPFM_' . ucfirst( $channel_short_name ) . '_Feed_Class';
				$feed_class	 = new $class_name();
				
				if( method_exists( $feed_class, 'set_feed_output_attribute_levels' ) )
					$feed_class->set_feed_output_attribute_levels( $main_data );
			}
		}

		private function add_attribute( &$attribute, $id, $title, $advised_source, $value, $field_level, $is_active,
								  $nr_queries, $nr_value_edits, $nr_value_conditions ) {

			$attribute_object = new stdClass();

			$attribute_object->rowId			 = $id;
			$attribute_object->fieldName		 = $title;
			$attribute_object->advisedSource	 = $advised_source;
			$attribute_object->value			 = $value;
			$attribute_object->fieldLevel		 = $field_level;
			$attribute_object->isActive			 = $is_active;
			$attribute_object->nrQueries		 = $nr_queries;
			$attribute_object->nrValueEdits		 = $nr_value_edits;
			$attribute_object->nrValueConditions = $nr_value_conditions;

			array_push( $attribute, $attribute_object );
		}

		private function convert_data_to_feed_data( $data ) {
			$feed = new stdClass();

			$feed->feedId			 = $data[ 'product_feed_id' ];
			$feed->title			 = $data[ 'title' ];
			$feed->mainCategory		 = $data[ 'main_category' ];
			$feed->categoryMapping	 = $data[ 'category_mapping' ];
			$feed->isAggregator		 = $data[ 'is_aggregator' ];
			$feed->includeVariations = $data[ 'include_variations' ];
			$feed->feedTitle		 = $data[ 'feed_title' ] !== null ? $data[ 'feed_title' ] : '';
			$feed->feedDescription	 = $data[ 'feed_description' ] !== null ? $data[ 'feed_description' ] : '';
			$feed->url				 = $data[ 'url' ];
			$feed->dataSource		 = $data[ 'source' ];
			$feed->channel			 = $data[ 'channel' ];
			$feed->country			 = $data[ 'country' ];
			$feed->status			 = $data[ 'status_id' ];
			$feed->baseStatusId		 = $data[ 'base_status_id'];
			$feed->updateSchedule	 = $data[ 'schedule' ];
			$feed->language			 = $data[ 'language' ] !== null ? $data[ 'language' ] : '';

			return $feed;
		}

		// WPPFM_CHANNEL_RELATED
		private function get_advised_inputs( $channel, $source ) {
			if( ! $channel ) { 
				wppfm_write_log_file( 'Error 3821 - Could not identify the selected channel id' );
				return false;
			}
			
			$channel_base_class	 = new WPPFM_Channel();
			$channel_short_name	 = $channel_base_class->get_channel_short_name( $channel );
			
			$class_name	 = 'WPPFM_' . ucfirst( $channel_short_name ) . '_Feed_Class';
			$feed_class	 = new $class_name();

			// as long as only woocommerce is supported, I can get away with only switching on a specific channel
			return $feed_class->woocommerce_to_feed_fields();
		}

		public function register_channel( $channel_short_name, $channel_data ) {

			if ( !$this->_queries->get_channel_id( $channel_short_name ) ) { // make sure the channel is not yet registered
				$this->_queries->register_a_channel( $channel_short_name, $channel_data->channel_id, $channel_data->channel_name );
			}
		}

	}

	// end of WPPFM_Data_Class

endif;

$dataclass = new WPPFM_Data_Class();
