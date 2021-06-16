<?php

/* * ******************************************************************
 * Version 1.7
 * Modified: 03-03-2018
 * Copyright 2018 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Variations_Class' ) ) :

	/**
	 * The WPPFM_Variations Class contains the functions required to work with product variations
	 * 
	 * @class WPPFM_Variations
	 * @version dev
	 * @category class
	 */
	class WPPFM_Variations_Class {

		/**
		 * Takes the product data and fills its items with the correct variation data
		 * 
		 * @param type $product_data
		 * @param type $woocommerce_variation_data
		 * @param type $wpmr_variation_data
		 */
		public static function fill_product_data_with_variation_data( &$product_data, $woocommerce_variation_data, $wpmr_variation_data, $feed_language ) {
			$permalink = array_key_exists( 'permalink' , $product_data ) ? $product_data['permalink'] : ''; // some channels don't require permalinks
			$conversions = self::variation_conversion_table( $woocommerce_variation_data, $permalink, $feed_language );
			$third_party_attribute_keywords = explode( ',', get_option( 'wppfm_third_party_attribute_keywords', '%wpmr%,%cpf%,%unit%,%bto%,%yoast%' ) );
			$variation_attributes = $woocommerce_variation_data->get_variation_attributes();
			
			foreach( $product_data as $key => $field_value ) {
				if ( in_array( $key, array_keys($conversions) ) && $field_value !== $conversions[ $key ] && $conversions[ $key ] ) {
					$product_data[$key] = $conversions[ $key ];
				}
				
				if ( array_key_exists( $key, $variation_attributes ) && $variation_attributes[$key] ) {
					$product_data[$key] = $variation_attributes[$key];
					continue;
				}
				
				if ( array_key_exists( 'attribute_pa_'.$key, $variation_attributes ) && $variation_attributes['attribute_pa_'.$key] ) {
					$product_data[$key] = $variation_attributes['attribute_pa_'.$key];
					continue;
				}
				
				// process the wpmr variation data
				if ( $wpmr_variation_data && array_key_exists( $key, $wpmr_variation_data ) ) {
					$product_data[$key] = $wpmr_variation_data[$key];
				} else {
					foreach( $third_party_attribute_keywords as $keyword ) {
						$search_str = str_replace( '%', '*', trim( $keyword ) ); // change sql wildcard % to normal wildcard *
						if ( fnmatch( $search_str, $key ) ) $product_data[$key] = '';
					}
				}
			}
		}
		
		private static function variation_conversion_table( $variation_data, $main_permalink, $feed_language ) {
			return array(
				'ID'						=> (string)$variation_data->get_id(),
				'_downloadable'				=> $variation_data->get_downloadable( 'feed' ),
				'_virtual'					=> $variation_data->get_virtual( 'feed' ),
				'_manage_stock'				=> $variation_data->get_manage_stock( 'feed' ),
				'_stock'					=> $variation_data->get_stock_quantity( 'feed' ),
				'_backorders'				=> $variation_data->get_backorders( 'feed' ),
				'_stock_status'				=> $variation_data->get_stock_status( 'feed' ),
				'_sku'						=> $variation_data->get_sku( 'feed' ),
				'_weight'					=> $variation_data->get_weight( 'feed' ),
				'_length'					=> $variation_data->get_length( 'feed' ),
				'_width'					=> $variation_data->get_width( 'feed' ),
				'_height'					=> $variation_data->get_height( 'feed' ),
				'post_content'				=> $variation_data->get_description( 'feed' ),
				'_regular_price'			=> prep_money_values( $variation_data->get_regular_price( 'feed' ), $feed_language ),
				'_sale_price'				=> prep_money_values( $variation_data->get_sale_price( 'feed' ), $feed_language ),
				'_sale_price_dates_from'	=> $variation_data->get_date_on_sale_from( 'feed' ) && ( $date = $variation_data->get_date_on_sale_from( 'feed' )->getTimestamp() ) ? convert_price_date_to_feed_format( $date) : '',
				'_sale_price_dates_to'		=> $variation_data->get_date_on_sale_to( 'feed' ) && ( $date = $variation_data->get_date_on_sale_to( 'feed' )->getTimestamp() ) ? convert_price_date_to_feed_format( $date) : '',
				'attachment_url'			=> wp_get_attachment_url( get_post_thumbnail_id( $variation_data->get_id() ) ),
				'permalink'					=> $main_permalink
		    );
		}
	}

	
     // End of WPPFM_Variations_Class

endif;	