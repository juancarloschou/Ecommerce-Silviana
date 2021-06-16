<?php

/* * ******************************************************************
 * Version 5.1
 * Modified: 02-02-2018
 * Copyright 2018 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WPPFM_Taxonomies_Class' ) ) :

	/**
	 * The WPPFM_Taxonomies_Class contains all functions for working with post taxonomies
	 * 
	 * @class WPPFM_Taxonomies_Class
	 * @version 5.1
	 * @category class
	 */
	class WPPFM_Taxonomies_Class {

		public static function make_shop_taxonomies_string( $product_id, $tax = 'product_cat', $separator = ' > ' ) {
			$args = array( 'taxonomy' => $tax, );
			$cats = wp_get_post_terms( $product_id, $tax, $args );

			$result = array();

			if ( count( $cats ) === 0 ) { return ''; }

			$cat_string = function( $id ) use( &$result, &$cat_string, $tax ) {
				$term = get_term_by( 'id', $id, $tax, 'ARRAY_A' );

				if ( $term['parent'] ) { $cat_string( $term['parent'] ); }

				$result[] = $term['name'];
			};

			$cat_string( $cats[0]->term_id );

			return implode( $separator, $result );
		}

		public static function get_shop_categories( $post_id, $separator = ', ' ) {
			$return_string = '';

			$args = array( 'taxonomy' => 'product_cat', );
			$cats = wp_get_post_terms( $post_id, 'product_cat', $args );

			foreach ( $cats as $cat ) { $return_string .= $cat->name . $separator; }

			return rtrim( $return_string, $separator );
		}

		/**
		 * Returns the product category that is selected as primary (only when Yoast plugin is installed)
		 * 
		 * @param string $id
		 * @return WP_Term Object
		 */
		public static function get_yoast_primary_cat( $id ) {
			if ( ! is_plugin_active( 'wordpress-seo/wp-seo.php' ) && ! is_plugin_active_for_network( 'wordpress-seo/wp-seo.php' )
				&& ! is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) && ! is_plugin_active_for_network( 'wordpress-seo-premium/wp-seo-premium.php' )  ) {
				return false; // return false if yoast plugin is inactive
			}

			$primary_cat_id = get_post_meta( $id,'_yoast_wpseo_primary_product_cat', true );

			if ( $primary_cat_id ){
				$product_cat[0] = get_term( $primary_cat_id, 'product_cat' );
				if ( isset( $product_cat[0]->term_id ) ) { return $product_cat; }
			} else { return false; }		
		}

		public static function get_shop_categories_list() {
			$args = array(
				'hide_empty'   => 0,
				'taxonomy'     => 'product_cat',
				'hierarchical' => 1,
				'orderby'      => 'name',
				'order'        => 'ASC',
				'exclude'      => apply_filters( 'wppfm_category_mapping_exclude', array() ),
				'exclude_tree' => apply_filters( 'wppfm_category_mapping_exclude_tree', array() ),
				'number'       => absint( apply_filters( 'wppfm_category_mapping_max_categories', 0 ) ),
				'child_of'     => 0,
			);
			
			// see https://developer.wordpress.org/reference/classes/wp_term_query/__construct/ for valid args
			$args = apply_filters( 'wppfm_category_mapping_args', $args );

			return self::get_cat_hierchy( 0, $args );
		}

		private static function get_cat_hierchy( $parent, $args ) {
			$cats	 = get_categories( $args );
			$ret	 = new stdClass;

			foreach ( $cats as $cat ) {
				if ( $cat->parent == $parent ) {
					$id                 = $cat->cat_ID;
					$ret->$id           = $cat;
					$ret->$id->children = self::get_cat_hierchy( $id, $args );
				}
			}

			return $ret;
		}
	}

	
    // end of WPPFM_Taxonomies_Class

endif;