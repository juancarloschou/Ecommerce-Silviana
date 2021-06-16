<?php

trait WPPFM_Processing_Support {

	/**
	 * Returns the correct category for this specific product
	 * 
	 * @param string $id
	 * @param string $main_category
	 * @param string $category_mapping
	 * @return string
	 */
	protected function get_mapped_category( $id, $main_category, $category_mapping ) {
		$result = false;
		$support_class = new WPPFM_Feed_Support_Class();
		$yoast_primary_category = WPPFM_Taxonomies_Class::get_yoast_primary_cat( $id );
		$yoast_cat_is_selected = $yoast_primary_category ? $support_class->category_is_selected( $yoast_primary_category[0]->term_id, $category_mapping ) : false;

		$product_categories	= $yoast_primary_category && false !== $yoast_cat_is_selected ? $yoast_primary_category :
			wp_get_post_terms( $id, 'product_cat', array( 'taxonomy' => 'product_cat' ) ); // get the categories from a specific product in the shop
		
		if ( $product_categories && !is_wp_error( $product_categories ) ) {
			// loop through each category
			foreach ( $product_categories as $category ) {
				// check if this category is selected in the category mapping
				$shop_category_id = $support_class->category_is_selected( $category->term_id, $category_mapping );
				
				// only add this product when at least one of the categories is selected in the category mapping
				if ( $shop_category_id !== false ) {
					switch ( $category_mapping[ $shop_category_id ]->feedCategories ) {
						case 'wp_mainCategory':
							$result = $main_category;
							break;

						case 'wp_ownCategory':
							$result = WPPFM_Taxonomies_Class::get_shop_categories($id, ' > ');
							break;

						default:
							$result = $category_mapping[ $shop_category_id ]->feedCategories;
					}
				} else { // if this product was not selected in the category mapping, it is possible it has been filtered in so map to the default category
					$result = $main_category;
				}
			}
		} else {
			if ( is_wp_error( $product_categories ) ) {
				echo wppfm_handle_wp_errors_response( $product_categories, "Sorry but error 2131 occured. Please try to refreh the page and contact support@wpmarketingrobot.com for support if the issue persists." );
			}

			return false;
		}
		
		return $result;
	}

	/**
	 * Checks if this product has been filtered out of the feed
	 * 
	 * @param string $feed_filter_strings
	 * @param array $product_data
	 * @return boolean
	 */
	protected function is_product_filtered( $feed_filter_strings, $product_data ) {
		if ( $feed_filter_strings ) {
			return $this->filter_result( json_decode( $feed_filter_strings[0]['meta_value'] ), $product_data ) ? true : false;
		} else {
			return false;
		}
	}

	protected function get_meta_parent_ids( $feed_id ) {
		$queries_class = new WPPFM_Queries();

		$query_result	 = $queries_class->get_meta_parents( $feed_id );
		$ids			 = array();

		foreach ( $query_result as $result ) {
			array_push( $ids, $result[ 'ID' ] );
		}

		return $ids;
	}

	/**
	 * return an array with source column names from an attribute string
	 * 
	 * @param string $value_string
	 * @return array
	 */
	protected function get_source_columns_from_attribute_value( $value_string ) {
		$source_columns = array();

		$value_object = json_decode( $value_string );

		if ( property_exists( $value_object, 'm' ) ) {
			foreach ( $value_object->m as $source ) {
				// TODO: Volgens mij kan ik de volgende "if" loops nog verder combineren
				if ( property_exists( $source, 's' ) ) {
					if ( property_exists( $source->s, 'source' ) ) {
						if ( $source->s->source !== 'combined' ) {
							array_push( $source_columns, $source->s->source );
						} else {
							if ( property_exists( $source->s, 'f' ) ) {
								$source_columns = array_merge( $source_columns, $this->get_combined_sources_from_combined_string( $source->s->f ) );
							}
						}
					}
				}
			}
		}

		return $source_columns;
	}

	/**
	 * return an array with condition column names from an attribute string
	 * 
	 * @param string $value_string
	 * @return array
	 */
	protected function get_condition_columns_from_attribute_value( $value_string ) {
		$condition_columns = array();

		$value_object = json_decode( $value_string );

		if ( property_exists( $value_object, 'm' ) ) {
			foreach ( $value_object->m as $source ) {
				if ( property_exists( $source, 'c' ) ) {
					for ( $i = 0; $i < count( $source->c ); $i++ ) {
						array_push( $condition_columns, $this->get_names_from_string( $source->c[ $i ]->{$i + 1} ) );
					}
				}
			}
		}

		return $condition_columns;
	}

	/**
	 * return an array with query column names from an attribute string
	 * 
	 * @param type $value_string
	 * @return array
	 */
	protected function get_queries_columns_from_attribute_value( $value_string ) {
		$query_columns = array();

		$value_object = json_decode( $value_string );

		if ( property_exists( $value_object, 'v' ) ) {
			foreach ( $value_object->v as $changed_value ) {
				if ( property_exists( $changed_value, 'q' ) ) {
					for ( $i = 0; $i < count( $changed_value->q ); $i++ ) {
						array_push( $query_columns, $this->get_names_from_string( $changed_value->q[ $i ]->{$i + 1} ) );
					}
				}
			}
		}

		return $query_columns;
	}

	/**
	 * extract a column name from a string
	 * 
	 * @param string $string
	 * @return array
	 */
	protected function get_names_from_string( $string ) {
		$condition_string_array = explode( '#', $string );

		return $condition_string_array[ 1 ];
	}

	/**
	 * split the combined string into single combination items
	 * 
	 * @param string $combined_string
	 * @return array
	 */
	protected function get_combined_sources_from_combined_string( $combined_string ) {
		$result					 = array();
		$combined_string_array	 = explode( '|', $combined_string );

		array_push( $result, $combined_string_array[ 0 ] );

		for ( $i = 1; $i < count( $combined_string_array ); $i++ ) {
			$a = explode( '#', $combined_string_array[ $i ] );
			if( array_key_exists( 1, $a) ) {array_push( $result, $a[ 1 ] ); }
		}

		return $result;
	}

	/**
	 * Gets the meta data from a specific field
	 * 
	 * @param string $field
	 * @param array $attributes
	 * @return variable attribute
	 */
	protected function get_meta_data_from_specific_field( $field, $attributes ) {
		$i = 0;

		while ( true ) {
			if ( $attributes[ $i ]->fieldName !== $field ) {
				$i++;
				if ( $i>1000 ) { break; }
			} else {
				return $attributes[ $i ];
			}
		}

		return false;
	}

	/**
	 * Generate the value of a field based on what the user has selected in filters, combined data, static data eg.
	 * 
	 * Returns an key=>value array of a specific product field where the key contains the field name and the value the field value
	 */
	protected function process_product_field( $product_data, $field_meta_data, 
									  $main_category_feed_title, $row_category, $feed_language, $relation_table ) {

		$product_object[ $field_meta_data->fieldName ] = $this->get_correct_field_value( $field_meta_data, $product_data,
			$main_category_feed_title, $row_category, $feed_language, $relation_table );

		return $product_object;
	}

	/**
	 * Processes a single field of a single product in the feed
	 */
	protected function get_correct_field_value( $field_meta_data, $product_data, $main_category_feed_title, $row_category, $feed_language, $relation_table ) {
		$end_row_value = '';
		$this->_nr_thats_selected = 0;

		// do not process category strings, but only fields that are requested
		if ( key_exists( 'fieldName', $field_meta_data ) && $field_meta_data->fieldName !== $main_category_feed_title 
			&& $this->meta_data_contains_category_data( $field_meta_data ) === false ) {

			$value_object = key_exists( 'value', $field_meta_data ) && $field_meta_data->value !== '' ? json_decode( $field_meta_data->value ) : new stdClass();

			if ( key_exists( 'value', $field_meta_data ) && $field_meta_data->value !== '' && key_exists( 'm', $value_object ) ) { // seems to be something we need to work on
				$advised_source = key_exists( 'advisedSource', $field_meta_data ) ? $field_meta_data->advisedSource : '';

				// get the end value depending on the filter settings
				$end_row_value = $this->get_correct_end_row_value( $value_object->m, $product_data, $advised_source );

			} else { // no queries, edit valies or alternative sources for this field

				if ( property_exists( $field_meta_data, 'advisedSource' ) && $field_meta_data->advisedSource !== '' ) {
					$db_title = $field_meta_data->advisedSource;
				} else {
					$support_class = new WPPFM_Feed_Support_Class();
					$source_title	 = key_exists( 'fieldName', $field_meta_data ) ? $field_meta_data->fieldName : '';
					$db_title		 = $support_class->find_relation( $source_title, $relation_table );
				}
				
				$end_row_value = array_key_exists( $db_title, $product_data ) ? $product_data[ $db_title ] : '';
			}

			// change value if requested
			if ( key_exists( 'value', $field_meta_data ) && $field_meta_data->value !== '' && key_exists( 'v', $value_object ) ) {
				$pos = $this->_nr_thats_selected;

				if ( key_exists( 'm', $value_object ) && key_exists( 's', $value_object->m[$pos] ) ) {
					$combination_string = key_exists( 'f', $value_object->m[$pos]->s ) ? $value_object->m[$pos]->s->f : false;
					$is_money = key_exists( 'source', $value_object->m[$pos]->s ) ?	meta_key_is_money( $value_object->m[$pos]->s->source ) : false;
				} else {
					$combination_string = false;
					$is_money = false;
				}

				$row_value = !$is_money ? $end_row_value : prep_money_values( $end_row_value. $feed_language );
				$end_row_value = $this->get_edited_end_row_value( $value_object->v, $row_value, $product_data, $combination_string, $feed_language );
			}
		} else {
			$end_row_value = $row_category;
		}

		return $end_row_value;
	}

	protected function get_correct_end_row_value( $value, $product_data, $advised_source ) {
		$end_row_value = '';
		$nr_values = count( $value ); // added @since 1.9.4
		$value_counter = 1; // added @since 1.9.4

		foreach ( $value as $filter ) {
			if ( $this->get_filter_status( $filter, $product_data ) === true && $end_row_value === '' ) {

				$end_row_value = $this->get_row_source_data( $filter, $product_data, $advised_source );
				break;
			} else {
				// no "or else" value seems to be selected
				if ( $value_counter >= $nr_values ) { return $end_row_value; } // added @since 1.9.4

				$this->_nr_thats_selected++;
			}

			$value_counter++; // added @since 1.9.4
		}

		// not found a condition that was correct so lets take the "for all other products" data to fetch the correct row_value
		if ( $end_row_value === '' ) {
			$end_row_value = $this->get_row_source_data( end( $value ), $product_data, $advised_source );
		}

		return $end_row_value;
	}

	protected function get_filter_status( $filter, $product_data ) {
		if ( key_exists( 'c', $filter ) ) {
			// check if the query is true for this field
			return $this->filter_result( $filter->c, $product_data );
		} else {
			// apparently there is no condition so the result is always true
			return true;
		}
	}

	protected function filter_result( $conditions, $product_data ) {
		$query_results = array();
		$support_class = new WPPFM_Feed_Support_Class();			

		// run each query on the data
		foreach ( $conditions as $condition ) {
			$condition_string = $support_class->get_query_string_from_query_object( $condition );

			$query_split = explode( '#', $condition_string );

			$row_result = $support_class->check_query_result_on_specific_row( $query_split, $product_data ) === true ? 'false' : 'true';

			array_push( $query_results, $query_split[ 0 ] . '#' . $row_result );
		}

		// return the final filter result, based on the specific results
		return $this->connect_query_results( $query_results );
	}

	/**
	 * Recieves an array with condition results and generates a single end result based on the "and" or "or"
	 * connection between the conditions
	 * 
	 * @param array with $results
	 * @return boolean
	 */
	protected function connect_query_results( $results ) {
		$and_results = array();
		$end_result	 = true;
		$or_results	 = array();

		if ( count( $results ) > 0 ) {
			foreach ( $results as $query_result ) {
				$result_split = explode( '#', $query_result );

				if ( $result_split[ 0 ] === '2' ) {
					array_push( $or_results, $and_results ); // store the current "and" result for processing as "or" result

					$and_results = array(); // clear the "and" array
				}

				$and_result = $result_split[ 1 ]; // === 'false' ? 'false' : 'true';

				array_push( $and_results, $and_result );
			}

			if ( count( $and_results ) > 0 ) {
				array_push( $or_results, $and_results );
			}

			if ( count( $or_results ) > 0 ) {
				$end_result = false;

				foreach ( $or_results as $or_result ) {
					$a = true;

					foreach ( $or_result as $and_array ) {
						if ( $and_array === 'false' ) {
							$a = false;
						}
					}

					if ( $a ) {
						$end_result = true;
					}
				}
			} else { // no "or" results found
				$end_result = false;
			}
		} else {
			$end_result = false;
		}

		return $end_result;
	}

	/**
	 * register the update in the database
	 * 
	 * @param string $feed_name
	 * @param string $status
	 */
	protected function register_feed_update( $feed_id, $feed_name, $nr_products, $status = null ) {
		$data_class = new WPPFM_Data_Class();
		
		// register the update and update the feed Last Change time
		$data_class->update_feed_data( $feed_id, $this->get_file_url( $feed_name ), $nr_products );

		$actual_status = $status ? $status : $data_class->get_feed_status( $feed_id );

		if ( $actual_status !== '4' && $actual_status !== '5' && $actual_status !== '6' ) { // no errors
			$data_class->update_feed_status( $feed_id, $status ); // put feed on status hold if no errors are reported
		}
	}

	/**
	 * returns the url to the feed file including feed name and extension
	 * 
	 * @param string $feed_name
	 * @return string
	 */
	protected function get_file_url( $feed_name ) {
		// previous to plugin version 1.3.0 feeds where stored in the plugins but after that version they are stored in the upload folder
		if( file_exists( WP_PLUGIN_DIR . '/wp-product-feed-manager-support/feeds/' . $feed_name ) ) {
			$file_url = plugins_url() . '/wp-product-feed-manager-support/feeds/' . $feed_name;
		} elseif( file_exists( WPPFM_FEEDS_DIR . '/' . $feed_name ) ) {
			$file_url = WPPFM_UPLOADS_URL . '/wppfm-feeds/' . $feed_name;
		} else { // as of version 1.5.0 all spaces in new filenames are replaced by a dash
			$forbitten_name_chars = array( ' ', '<', '>', ':', '?', ',' ); // characters that are not allowed in a feed file name
			$file_url = WPPFM_UPLOADS_URL . '/wppfm-feeds/' . str_replace( $forbitten_name_chars, '-', $feed_name);
		}
		
		return apply_filters( 'wppfm_feed_url', $file_url, $feed_name );
	}

	protected function get_row_source_data( $filter, $product_data, $advised_source ) {
		$row_source_data = '';

		if ( key_exists( 's', $filter ) ) {
			if ( key_exists( 'static', $filter->s ) ) {
				$row_source_data = $filter->s->static;
			} elseif ( key_exists( 'source', $filter->s ) ) {
				if ( $filter->s->source !== 'combined' ) {
					$row_source_data = array_key_exists( $filter->s->source, $product_data ) ? $product_data[ $filter->s->source ] : '';
				} else {
					$row_source_data = $this->generate_combined_string( $filter->s->f, $product_data );
				}
			}
		} else {
			// return the advised source data
			if ( $advised_source !== '' ) {
				$row_source_data = array_key_exists( $advised_source, $product_data ) ? $product_data[ $advised_source ] : '';
			}
		}

		return $row_source_data;
	}

	protected function generate_combined_string( $combined_sources, $row ) {
		$source_selectors_array = explode( '|', $combined_sources ); //split the combined source string in an array containing every single source
		$values_class = new WPPFM_Feed_Value_Editors_Class();
		$separators = $values_class->combination_separators(); // array with all possible separators

		// if one of the row results is an array, the final output needs to be an array
		$result_is_array = $this->check_if_any_source_has_array_data( $source_selectors_array, $row );
		$result = $result_is_array ? array() : '';

		if ( ! $result_is_array ) {
			$result = $this->make_combined_string( $source_selectors_array, $separators, $row, false );
		} else {
			for( $i = 0; $i < count( $result_is_array ); $i++ ) {
				$combined_string = $this->make_combined_string( $source_selectors_array, $separators, $row, $i );
				array_push( $result, $combined_string );				
			}
		}

		return $result;
	}

	/**
	 * Distracts the keys from the $sources string (separated by a #) and looks if any of these keys
	 * are linked to an array in the $data_row
	 * 
	 * @param string $sources
	 * @param array $data_row
	 * @return false or an array from the data_row
	 */
	protected function check_if_any_source_has_array_data( $sources, $data_row ) {
		foreach( $sources as $source ) {
			$split_source = explode( '#', $source );

			if ( count( $split_source ) > 1 && $split_source[1] === 'static' ) {
				$last_key = 'static';
			} elseif ( $split_source[0] === 'static' ) {
				$last_key = 'static';
			} else {
				$last_key = array_pop( $split_source );
			}

			if( array_key_exists($last_key, $data_row) && is_array( $data_row[ $last_key ] ) ) { return $data_row[ $last_key ]; } 
		}

		return false;
	}
		
	protected function meta_data_contains_category_data( $meta_data ) {
		if( !key_exists( 'value', $meta_data ) || empty( $meta_data->value ) ) return false;

		$meta_obj = json_decode( $meta_data->value );
		return property_exists( $meta_obj, 't' ) ? true : false;
	}

	protected function get_edited_end_row_value( $change_parameters, $origional_output, $product_data, $combination_string, $feed_language ) {
		$result_is_filtered = false;
		$support_class = new WPPFM_Feed_Support_Class();
		$y = 0;

		for ( $i = 0; $i < ( count( $change_parameters ) - 1 ); $i++ ) {
			if ( key_exists( 'q', $change_parameters[ $i ] ) ) {
				$filter_result = $this->filter_result( $change_parameters[ $i ]->q, $product_data );

				if ( $filter_result === true ) {
					$combined_data_elements = $combination_string ? $this->get_combined_elements( $product_data, $combination_string ) : '';
					$final_output = $support_class->edit_value( $origional_output, $change_parameters[ $i ]->{$i + 1}, $combination_string, 
						$combined_data_elements, $feed_language );

					$result_is_filtered = true;
				}
			}

			$y++;
		}

		if ( $result_is_filtered === false ) {
			$combined_data_elements = $combination_string ? $this->get_combined_elements( $product_data, $combination_string ) : '';
			$final_output = $support_class->edit_value( $origional_output, $change_parameters[ $y ]->{$y + 1}, $combination_string, 
				$combined_data_elements, $feed_language );
		}

		return $final_output;
	}

	protected function get_combined_elements( $product_data, $combination_string ) {
		$result = array();
		$found_all_data = true;

		$combination_elements = explode( '|', $combination_string );

		if ( false === strpos( $combination_elements[0], 'static#' ) ) {
			if ( array_key_exists( $combination_elements[0], $product_data ) ) {
				array_push( $result, $product_data[$combination_elements[0]] );
			} else {
				$found_all_data = false;
			}
		} else {
			$element = explode( '#', $combination_elements[0] );
			array_push( $result, $element[1] );
		}

		for ( $i = 1; $i <= count($combination_elements) - 1; $i++ ) {
			$pos = strpos( $combination_elements[$i], '#');
			$selector = substr( $combination_elements[$i], ($pos !== false ? $pos + 1 : 0 ));

			if ( substr( $selector, 0, 7 ) === 'static#' ) {
				$selector = explode( '#', $selector );
				array_push( $result, $selector[1] );
			} elseif ( array_key_exists( $selector, $product_data ) ) {
				array_push( $result, $product_data[$selector] );
			} else {
				//array_push( $result, $selector );
				$found_all_data = false;
			}
		}

		return $found_all_data ? $result : '';
	}

	protected function make_combined_string( $source_selectors_array, $separators, $row, $array_pos ) {
		$combined_string = '';

		foreach ( $source_selectors_array as $source ) {
			$split_source = explode( '#', $source );

			// get the separator
			$separators_id = count( $split_source ) > 1 && $split_source[ 0 ] !== 'static' ? $split_source[ 0 ] : 0;
			$sep = $separators[ $separators_id ];

			$data_key = count( $split_source ) > 1 && $split_source[ 0 ] !== 'static' ? $split_source[ 1 ] : $split_source[ 0 ] ;

			if ( ( array_key_exists( $data_key, $row ) && $row[ $data_key ] ) || $data_key === 'static' ) {
				if ( $data_key !== 'static' && ! is_array( $row[ $data_key ] ) ) { // not static and no array
					$combined_string .= $sep;
					$combined_string .= $data_key !== 'static' ? $row[ $data_key ] : $split_source[ 2 ];
				} elseif ( $data_key === 'static' ) { // static inputs
					$static_string = count( $split_source ) > 2 ? $split_source[ 2 ] : $split_source[ 1 ];
					$combined_string .= $sep . $static_string;
				} else { // array inputs
					$input_array = $row[ $data_key ][$array_pos];
					$combined_string .= $sep . $input_array;
				}
			}
		}

		return $combined_string;
	}

	/**
	 * get an array with the relations between the woocommerce fields and the channel fields
	 * 
	 * @param array $attributes
	 * @return array
	 */
	public function get_channel_to_woocommerce_field_relations() {
		$relations = array();

		foreach ( $this->_feed->attributes as $attribute ) {

			// get the source name except for the category_mapping field
			if ( $attribute->fieldName !== 'category_mapping' ) {
				$source = $this->get_source_from_attribute( $attribute );
			}

			if ( ! empty( $source ) ) {
				// correct googles product category source
				if ( $attribute->fieldName === 'google_product_category' ) {
					$source = 'google_product_category';
				}

				// correct googles identifier exists source
				if ( $attribute->fieldName === 'identifier_exists' ) {
					$source = 'identifier_exists';
				}

				// fill the relations array
				$a = array( 'field' => $attribute->fieldName, 'db' => $source );
				array_push( $relations, $a );
			}
		}

		if ( empty( $relations ) ) { wppfm_write_log_file( "Function get_channel_to_woocommerce_field_relations returned zero relations." ); }

		return $relations;
	}

	/**
	 * extract the source name from the attribute string
	 * 
	 * @param string $attribute
	 * @return string
	 */
	protected function get_source_from_attribute( $attribute ) {

		$source = '';

		$value_source = property_exists( $attribute, 'value' ) ? $this->get_source_from_attribute_value( $attribute->value ) : '';

		if ( ! empty( $value_source ) ) {
			$source = $value_source;
		} elseif ( array_key_exists( 'advisedSource', $attribute ) && $attribute->advisedSource !== '' ) {
			$source = $attribute->advisedSource;
		} else {
			$source = $attribute->fieldName;
		}

		return $source;
	}

	/**
	 * extract the source value from the attribute string
	 * 
	 * @param string $value
	 * @return string
	 */
	protected function get_source_from_attribute_value( $value ) {
		$source = '';

		if ( $value ) {
			$value_string = $this->get_source_string( $value );

			$value_object = json_decode( $value_string );

			if ( is_object( $value_object ) && property_exists( $value_object, 'source' ) ) { $source = $value_object->source; }
		}

		return $source;
	}

	/**
	 * get the value
	 * 
	 * @param string $value_string
	 * @return string
	 */
	protected function get_source_string( $value_string ) {
		$source_string = '';

		if ( ! empty( $value_string ) ) {
			$value_object = json_decode( $value_string );

			if ( property_exists( $value_object, 'm' ) && property_exists( $value_object->m[ 0 ], 's' ) ) {
				$source_string = json_encode( $value_object->m[ 0 ]->s );
			}
		}

		return $source_string;
	}

	/**
	 * makes an xml string of one product including its variations
	 * 
	 * @param array $data
	 * @param string $category_name
	 * @param string $description_name
	 * @return string
	 */
	protected function convert_data_to_xml( $data, $category_name, $description_name, $channel ) {
		return $data ? $this->make_xml_string_row( $data, $category_name, $description_name, $channel ) : '';
	}

	/**
	 * makes an xml string for one product
	 * 
	 * @param array $product
	 * @param string $category_name
	 * @param string $description_name
	 * @return string
	 */
	protected function make_xml_string_row( $product, $category_name, $description_name, $channel ) {
		$product_node_name = function_exists( 'product_node_name' ) ? product_node_name( $channel ) : 'item';
		$node_pre_tag_name = function_exists( 'get_node_pretag' ) ? get_node_pretag( $channel ) : 'g:';
		$product_node = apply_filters( 'wppfm_xml_product_node_name', $product_node_name, $channel );
		$node_pre_tag = apply_filters( 'wppfm_xml_product_pre_tag_name', $node_pre_tag_name, $channel );
		$tags_with_sub_tags = $this->_channel_class->keys_that_have_sub_tags();
		$tags_repeated_fields = $this->_channel_class->keys_that_can_be_used_more_than_once();
		$sub_keys_for_subs = $this->_channel_class->sub_keys_for_sub_tags();
		
		$this->_channel_class->add_xml_sub_tags( $product, $sub_keys_for_subs, $tags_with_sub_tags, $node_pre_tag );
		$xml_string = "<$product_node>";

		// for each product value item
		foreach ( $product as $key => $value ) {
			if ( !is_array( $value ) ) {
				$xml_string .= $this->make_xml_string( $key, $value, $category_name, $description_name, $node_pre_tag, $tags_with_sub_tags, $tags_repeated_fields, $channel );
			} else {
				$xml_string .= $this->make_array_string( $key, $value, $node_pre_tag, $channel );
			}
		}

		$xml_string .= "</$product_node>";

		return $xml_string;
	}

	/**
	 * makes an csv string of one product including its variations
	 * 
	 * @param array $data
	 * @return string
	 */
	protected function convert_data_to_csv( $data, $active_fields, $csv_separator ) {
		if ( $data ) {
			if( count( $data ) > count( $active_fields ) ) {
				$support_class = new WPPFM_Feed_Support_Class();
				$support_class->correct_active_fields_list( $active_fields );
			}
			// the first row in a csv file should contain the index, the following rows the data
			return $this->make_comma_separated_string_from_data_array( $data, $active_fields, $csv_separator );
		} else { return ''; }
	}

	protected function convert_data_to_txt( $data ) {
		if ( $data ) {
			return $this->make_tab_delimited_string_from_data_array( $data );
		} else { return ''; }
	}

	/**
	 * takes one row data and converts it to a tab delimited string
	 * 
	 * @param array $row_data
	 * @return string
	 */
	protected function make_tab_delimited_string_from_data_array( $row_data ) {
		$row_string = '';

		foreach ( $row_data as $row_item ) {
			$a_row_item = !is_array( $row_item ) ? preg_replace( "/\r|\n/", "", $row_item ) : implode( ', ', $row_item );
			$clean_row_item = strip_tags( $a_row_item );
			$row_string .= $clean_row_item . "\t";
		}

		$row = trim( $row_string ); // removes the tab at the end of the line

		return $row . "\r\n";
	}

	/**
	 * takes one row data and converts it to a comma separated string
	 * 
	 * @param object $row_data
	 * @param array $active_fields
	 * @return string
	 */
	protected function make_comma_separated_string_from_data_array( $row_data, $active_fields, $separator = ',' ) {
		$row_string = '';

		foreach ( $active_fields as $row_item ) {
			if( array_key_exists( $row_item, $row_data ) ) {
				$clean_row_item = !is_array( $row_data[$row_item] ) ? preg_replace( "/\r|\n/", "", $row_data[$row_item] ) : implode( ', ', $row_data[$row_item] );
			} else {
				$clean_row_item = '';
			}

			$no_double_quote_item = str_replace( '"', "'", $clean_row_item );
			$row_string .= '"'.$no_double_quote_item.'"' . $separator;
		}

		$row = rtrim( $row_string, $separator ); // removes the comma at the end of the line

		return $row . "\r\n";
	}

	/**
	 * makes the header string for a csv file
	 * 
	 * @param array $active_fields
	 * @return string
	 */
	protected function make_csv_header_string( $active_fields, $separator ) {
		$header = implode( $separator, $active_fields );
		return $header . "\r\n";
	}

	/**
	 * make an array of product element strings
	 * 
	 * @param string $key
	 * @param string $value
	 * @param string $google_node_pre_tag
	 * @param string $channel
	 * @return string
	 */
	protected function make_array_string( $key, $value, $google_node_pre_tag, $channel ) {
		$xml_strings = '';
		$tags_with_sub_tags = $this->_channel_class->keys_that_have_sub_tags();
		$tags_repeated_fields = $this->_channel_class->keys_that_can_be_used_more_than_once();
		
		for ( $i = 0; $i < count( $value ); $i++ ) {
			$xml_key = $key === 'Extra_Afbeeldingen' ? 'Extra_Image_' . ( $i + 1 ) : $key; // required for Beslist.nl
			$xml_strings .= $this->make_xml_string( $xml_key, $value[ $i ], '', '', $google_node_pre_tag, $tags_with_sub_tags, $tags_repeated_fields, $channel );
		}

		return $xml_strings;
	}

	/**
	 * Generates an xml node.
	 * 
	 * Returns an xml node for a product tag and uses the product data to make the node.
	 * 
	 * @since	1.1.0
	 * @access	public
	 * 
	 * @param string	$key					Note id.
	 * @param string	$value					Note value.
	 * @param string	$category_name			Category name.
	 * @param string	$description_name		Description name.
	 * @param string	$google_node_pre_tag	Pre node tag.
	 * @param array		$tags_with_sub_tags		Array with tags that have a sub tag construction.
	 * @param array		$tags_repeated_fields	Array with tags that are allowed to be placed in the feed more than once
	 * @param string	$channel				Selected channel id.
	 * 
	 * @return string	Node string in xml format eg. <id>43</id>.
	 */
	protected function make_xml_string( $key, $value, $category_name, $description_name, $google_node_pre_tag, $tags_with_sub_tags, $tags_repeated_fields, $channel ) {
		$xml_string = '';
		$xml_value = ! in_array( $key, $tags_with_sub_tags ) ? $this->convert_to_xml_value( $value ) : $value;
		$repeated_field = ! in_array( $key, $tags_repeated_fields ) ? false : true;
		$subtag_sep = apply_filters( 'wppfm_sub_tag_separator', '||' );

		if ( substr( $xml_value, 0, 5 ) === '!sub:' ) {
			$sub_array = explode( "|", $xml_value );
			$sa = $sub_array[0];
			$st = explode( ":", $sa );
			$sub_tag = $st[1];
			$xml_value = "<$google_node_pre_tag$sub_tag>$sub_array[1]</$google_node_pre_tag$sub_tag>";
		}

		if( $repeated_field && ! is_array( $xml_value ) ) {
			$xml_value = explode( $subtag_sep, $xml_value );
		}

		// LET OP!! Meer keys in de datastring zetten!!!
		if ( $key === $category_name || $key === $description_name || $key === 'title' ) { // put the category and description in a ![CDATA[...]] bracket
			$xml_value = $this->convert_to_character_data_string( $xml_value );
		}

		// as of October 2016 google removed the need for a g: suffix only for title and link. Facebook still requires it
		if ( $key === 'title' || $key === 'link' ) { $google_node_pre_tag = $channel === '1' ? '' : $google_node_pre_tag; }

		if ( $key !== '' ) {
			if( is_array( $xml_value ) && $repeated_field ) {
				foreach( $xml_value as $value_item ) {
					$xml_string .= $this->add_xml_string( $key, $value_item, $google_node_pre_tag );
				}
			} else {
				$xml_string = $this->add_xml_string( $key, $xml_value, $google_node_pre_tag );
			}
		}

		return $xml_string;
	}

	/**
	 * Generates a single xml line string
	 * 
	 * @since 1.9.0
	 * 
	 * @param string $key
	 * @param string $xml_value
	 * @param string $google_node_pre_tag
	 * @return string
	 */
	protected function add_xml_string( $key, $xml_value, $google_node_pre_tag ) {
		$not_allowed_characters	 = array( ' ', '-' );
		$clean_key = str_replace( $not_allowed_characters, '_', $key );
		return "<$google_node_pre_tag$clean_key>$xml_value</$google_node_pre_tag$clean_key>";
	}

	/**
	 * converts an ordinary xml string into a CDATA string
	 * 
	 * @param string $string
	 * @return string
	 */
	protected function convert_to_character_data_string( $string ) { return "<![CDATA[ $string ]]>"; }

	/**
	 * can be overridden by a channel specific function in its class-feed.php
	 * 
	 * @since 1.9.0
	 * 
	 * @return array
	 */
	public function add_xml_sub_tags( &$product, $sub_keys_for_subs, $tags_repeated_fields, $node_pre_tag ) {
		$subtags = array_intersect_key( $product, array_flip( $sub_keys_for_subs ) );

		if ( count( $subtags ) < 1 ) { return $product; }

		$subtag_sep = apply_filters( 'wppfm_sub_tag_separator', '||' );
		$tags_value = array();

		foreach ( $subtags as $key => $value ) {
			$split = explode( '-', $key );

			if ( in_array( $split[0], $tags_repeated_fields ) ) {
				$tags_counter = 0;
				$value_array = is_array( $value ) ? $value : explode( $subtag_sep, $value );

				foreach( $value_array as $sub_value ) {
					$tags_value[$tags_counter] .= '<' . $node_pre_tag . $split[1] . '>' . $sub_value . '</' . $node_pre_tag . $split[1] . '>';
					$tags_counter++;
				}
			} else {
				$tags_value = array_key_exists( $split[0], $product ) ? $product[$split[0]] : '';
				$tags_value .= '<' . $node_pre_tag . $split[1] . '>' . $value . '</' . $node_pre_tag . $split[1] . '>';
			}

			unset($product[$key]);
			$product[$split[0]] = $tags_value;
		}

		return $product;
	}
		
	/**
	 * can be overridden by a channel specific function in its class-feed.php
	 * 
	 * @since 1.9.0
	 * 
	 * @return array
	 */
	public function keys_that_have_sub_tags() { return array(); }

	/**
	 * can be overridden by a channel specific function in its class-feed.php
	 * 
	 * @since 2.1.0
	 * 
	 * @return array
	 */
	public function sub_keys_for_sub_tags() { return array(); }
	
	/**
	 * can be overridden by a channel specific function in its class-feed.php
	 * 
	 * @since 1.9.0
	 * 
	 * @return array
	 */
	public function keys_that_can_be_used_more_than_once() { return array(); }

	/**
	 * replaces certain characters to get a valid xml value
	 * 
	 * @param string $value_string
	 * @return string
	 */
	protected function convert_to_xml_value( $value_string ) {
		$string_without_tags = strip_tags( $value_string );
		$prep_string = str_replace( array( '&amp;', '&lt;', '&gt;', '&apos;', '&quot;', '&nbsp;' ), array( '&', '<', '>', '\'', '"', 'nbsp;' ), $string_without_tags );
		$clean_xml_string = str_replace( array( '&', '<', '>', '\'', '"', 'nbsp;', '`' ), array( '&amp;', '&lt;', '&gt;', '&apos;', '&quot;', '&nbsp;', '' ), $prep_string );

		return $clean_xml_string;
	}

	/**
	 * get formal woocommerce custom fields data
	 * 
	 * @param string $id
	 * @param string $parent_product_id @since 2.0.9
	 * @param string $field
	 * @return string
	 */
	protected function get_custom_field_data( $id, $parent_product_id, $field ) {
		$custom_string	 = '';
		$taxonomy		 = 'pa_' . $field;
		$custom_values	 = get_the_terms( $id, $taxonomy );

		if( !$custom_values && $parent_product_id !== 0 ) {
			$custom_values	 = get_the_terms( $parent_product_id, $taxonomy );
		}
		
		if ( $custom_values ) {
			foreach ( $custom_values as $custom_value ) { $custom_string .= $custom_value->name . ', ';	}
		}
		
		return $custom_string ? substr( $custom_string, 0, -2 ) : '';
	}
		
	/**
	 * get third party custom field data
	 * 
	 * @since 1.6.0
	 * 
	 * @param string $feed_id
	 * @param string $parent_product_id @since 2.0.9
	 * @param string $field
	 * @return string
	 */
	protected function get_third_party_custom_field_data( $feed_id, $parent_product_id, $field ) {
		$result = '';

		// YITH Brands plugin
		if ( $field === get_option( 'yith_wcbr_brands_label' ) ) { // YITH Brands plugin active
			if ( has_term( '', 'yith_product_brand', $feed_id ) ) {
				$product_brand = get_the_terms( $feed_id, 'yith_product_brand' );
			}

			if ( ! $product_brand && $parent_product_id !== 0 && has_term( '', 'yith_product_brand', $parent_product_id ) ) {
				$product_brand = get_the_terms( $parent_product_id, 'yith_product_brand' );
			}

			foreach ( $product_brand as $brand ) { $result .= $brand->name . ', ';	}
		}

		// WooCommerce Brands plugin
		if ( in_array( 'woocommerce-brands/woocommerce-brands.php', apply_filters( 'active_plugins', 
			get_option( 'active_plugins' ) ) ) ) { 

			if ( has_term( '', 'product_brand', $feed_id ) ) {
				$product_brand = get_the_terms( $feed_id, 'product_brand' );
			}

			if ( ! $product_brand && $parent_product_id !== 0 && has_term( '', 'product_brand', $parent_product_id ) ) {
				$product_brand = get_the_terms( $parent_product_id, 'product_brand' );
			}

			foreach ( $product_brand as $brand ) { $result .= $brand->name . ', '; }
		}

		return $result ? substr( $result, 0, -2 ) : '';
	}
		
	/**
	 * adds data to the product that require a procedure to get
	 * 
	 * @param object $product
	 * @param array $active_field_names
	 */
	protected function add_procedural_data( &$product, $active_field_names, $selected_language ) {
		$woocommerce_product = wc_get_product( $product->ID );

		if ( false === $woocommerce_product ) {
			wppfm_write_log_file( sprintf( 'Failed to get the WooCommerce product data from product with id %s.', $product->ID ) );
			return false;
		}
		
		$woocommerce_parent_id = $woocommerce_product->get_parent_id();
		$woocommerce_product_parent = $woocommerce_product && ( $woocommerce_product->is_type( 'variable' ) || $woocommerce_product->is_type( 'variation' ) ) ? wc_get_product( $woocommerce_parent_id ) : null;
		
		if ( false === $woocommerce_product_parent ) {
			// this product has no parent id so it is possible this is the main of a variable product
			// So to make sure the general variation data like min_variation_price are availiable, copy the product 
			// in the parent product
			$woocommerce_product_parent = $woocommerce_product;
		}

		if ( in_array( 'shipping_class', $active_field_names ) ) {
			if( $woocommerce_product_parent ) { 
				$product->shipping_class = $woocommerce_product_parent->get_shipping_class(); 
			} elseif ( $woocommerce_product ) {
				$product->shipping_class = $woocommerce_product->get_shipping_class(); 
			}
		}
		
		$woocommerce_product = null;
		
		if ( in_array( 'permalink', $active_field_names ) ) {
			$product->permalink = get_permalink( $product->ID );
			if( false === $product->permalink && $woocommerce_parent_id !== 0 ) {
				$product->permalink = get_permalink( $woocommerce_parent_id );
			}
		}

		if ( in_array( 'attachment_url', $active_field_names ) ) {
			$product->attachment_url = wp_get_attachment_url( get_post_thumbnail_id( $product->ID ) );
			if( false === $product->attachment_url && $woocommerce_parent_id !== 0 ) {
				$product->attachment_url = wp_get_attachment_url( get_post_thumbnail_id( $woocommerce_parent_id ) );
			}
		}

		if ( in_array( 'product_cat', $active_field_names ) ) {
			$product->product_cat = WPPFM_Taxonomies_Class::get_shop_categories( $product->ID );
			if( $product->product_cat === '' && $woocommerce_parent_id !== 0 ) {
				$product->product_cat = WPPFM_Taxonomies_Class::get_shop_categories( $woocommerce_parent_id );
			}
		}

		if ( in_array( 'product_cat_string', $active_field_names ) ) {
			$product->product_cat_string = WPPFM_Taxonomies_Class::make_shop_taxonomies_string( $product->ID );
			if( $product->product_cat_string === '' && $woocommerce_parent_id !== 0 ) {
				$product->product_cat_string = WPPFM_Taxonomies_Class::make_shop_taxonomies_string( $woocommerce_parent_id );
			}
		}

		if ( in_array( 'last_update', $active_field_names ) ) {
			$product->last_update = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
		}

		if ( in_array( '_wp_attachement_metadata', $active_field_names ) ) {
			$attachement_id = $woocommerce_parent_id === 0 ? $product->ID : $woocommerce_parent_id;
			$product->_wp_attachement_metadata = $this->get_product_image_galery( $attachement_id );
		}

		if ( in_array( 'product_tags', $active_field_names ) ) {
			$product->product_tags = $this->get_product_tags( $product->ID );
		}

		if ( in_array( 'wc_currency', $active_field_names ) ) {
			// WPML support
			$product->wc_currency = has_filter( 'wppfm_get_wpml_currency' ) 
				? apply_filters( 'wppfm_get_wpml_currency', get_woocommerce_currency(), $selected_language ) : get_woocommerce_currency();
		}

		if ( in_array( '_min_variation_price', $active_field_names ) ) {
			$product->_min_variation_price = $woocommerce_product_parent ? prep_money_values( $woocommerce_product_parent->get_variation_price(), $selected_language ) : '';
		}

		if ( in_array( '_max_variation_price', $active_field_names ) ) {
			$product->_max_variation_price = $woocommerce_product_parent ? prep_money_values( $woocommerce_product_parent->get_variation_price( 'max' ), $selected_language ) : '';
		}

		if ( in_array( '_min_variation_regular_price', $active_field_names ) ) {
			$product->_min_variation_regular_price = $woocommerce_product_parent ? prep_money_values( $woocommerce_product_parent->get_variation_regular_price(), $selected_language ) : '';
		}

		if ( in_array( '_max_variation_regular_price', $active_field_names ) ) {
			$product->_max_variation_regular_price = $woocommerce_product_parent ? prep_money_values( $woocommerce_product_parent->get_variation_regular_price( 'max' ), $selected_language ) : '';
		}

		if ( in_array( '_min_variation_sale_price', $active_field_names ) ) {
			$product->_min_variation_sale_price = $woocommerce_product_parent ? prep_money_values( $woocommerce_product_parent->get_variation_sale_price(), $selected_language ) : '';
		}

		if ( in_array( '_max_variation_sale_price', $active_field_names ) ) {
			$product->_max_variation_sale_price = $woocommerce_product_parent ? prep_money_values(  $woocommerce_product_parent->get_variation_sale_price( 'max' ), $selected_language ) : '';
		}

		if ( in_array( 'item_group_id', $active_field_names ) ) {
			$parent_sku = $woocommerce_product_parent ? $woocommerce_product_parent->get_sku() : '';
			
			if( $parent_sku ) {
				$product->item_group_id = $parent_sku; // best practise
			} elseif ( $woocommerce_product_parent && $woocommerce_parent_id ) {
				$product->item_group_id = 'GID' . $woocommerce_parent_id;
			} else {
				$product->item_group_id = '';
			}
		}

		// @since 2.1.4
		if ( in_array( 'empty', $active_field_names ) ) {
			$product->empty = '';
		}
	}

	/**
	 * get additional images
	 * 
	 * @param string $post_id
	 * @return array
	 */
	protected function get_product_image_galery( $post_id ) {
		$image_urls		 = array();
		$images			 = 1;
		$max_nr_images	 = 10;

		$prdct = wc_get_product( $post_id );
		$attachment_ids = $prdct->get_gallery_image_ids();

		foreach( $attachment_ids as $attachment ) {
			$image_link = wp_get_attachment_url( $attachment );

			// correct baseurl for https if required
			if ( is_ssl() ) { $url = str_replace( 'http://', 'https://', $image_link );
			} else { $url = $image_link; }
			
			array_push( $image_urls, $url );
			$images++;

			if ( $images > $max_nr_images ) { break; }
		}

		return $image_urls;
	}

	protected function get_product_tags( $id ) {
		$product_tags_string = '';
		$product_tag_values	 = get_the_terms( $id, 'product_tag' );
		$post_tag_values	 = get_the_tags( $id );

		if ( $product_tag_values ) {
			foreach ( $product_tag_values as $product_tag ) {
				$product_tags_string .= $product_tag->name . ', ';
			}
		}

		if ( $post_tag_values ) {
			foreach ( $post_tag_values as $post_tag ) {
				$product_tags_string .= $post_tag->name . ', ';
			}
		}

		return $product_tags_string ? substr( $product_tags_string, 0, -2 ) : '';
	}
}