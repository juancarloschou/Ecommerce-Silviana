<?php

/*
Copyright (C) 2016-2017 Pimwick, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'PWBE_Columns' ) ) :

final class PWBE_Columns {

	private static $columns = null;

	public static function get_by_field( $field ) {
		if ( PWBE_Columns::$columns === null ) {
			PWBE_Columns::load();
		}

		foreach ( PWBE_Columns::$columns as $column ) {
			if ( $column['field'] == $field ) {
				return $column;
			}
		}

		return null;
	}

	public static function get() {
		if ( PWBE_Columns::$columns === null ) {
			PWBE_Columns::load();
		}

		return PWBE_Columns::$columns;
	}

	private static function load() {
		global $wpdb;

		$product_columns[] = array(
			'name' => 'Product Name',
			'type' => 'text',
			'table' => 'post',
			'field' => 'post_title',
			'readonly' => 'false',
			'visibility' => 'parent',
			'sortable' => 'true',
			'views' => array( 'all', 'standard' )
		);

		$product_columns[] = array(
			'name' => 'Product Description',
			'type' => 'textarea',
			'table' => 'post',
			'field' => 'post_content',
			'readonly' => 'false',
			'visibility' => 'both',
			'sortable' => 'true',
			'views' => array( 'all', 'standard' )
		);

		$product_columns[] = array(
			'name' => 'SKU',
			'type' => 'text',
			'table' => 'meta',
			'field' => '_sku',
			'readonly' => 'false',
			'visibility' => 'both',
			'sortable' => 'true',
			'views' => array( 'all' )
		);

		$product_columns[] = array(
			'name' => 'Regular Price',
			'type' => 'currency',
			'table' => 'meta',
			'field' => '_regular_price',
			'readonly' => 'false',
			'visibility' => 'variation',
			'sortable' => 'true',
			'views' => array( 'all', 'standard' )
		);

		if ( wc_tax_enabled() ) {
			$product_columns[] = array(
				'name' => 'Tax Status',
				'type' => 'select',
				'table' => 'meta',
				'field' => '_tax_status',
				'readonly' => 'false',
				'visibility' => 'parent',
				'sortable' => 'true',
				'views' => array( 'all' )
			);

			$product_columns[] = array(
				'name' => 'Tax Class',
				'type' => 'select',
				'table' => 'meta',
				'field' => '_tax_class',
				'readonly' => 'false',
				'visibility' => 'both',
				'sortable' => 'true',
				'views' => array( 'all' )
			);
		}

		if ( 'yes' === get_option( 'woocommerce_manage_stock' ) ) {
			$product_columns[] = array(
				'name' => 'Manage Stock',
				'type' => 'checkbox',
				'table' => 'meta',
				'field' => '_manage_stock',
				'readonly' => 'false',
				'visibility' => 'both',
				'sortable' => 'true',
				'views' => array( 'all' )
			);

			$product_columns[] = array(
				'name' => 'Stock Quantity',
				'type' => 'number',
				'table' => 'meta',
				'field' => '_stock',
				'readonly' => 'false',
				'visibility' => 'both',
				'sortable' => 'true',
				'views' => array( 'all' )
			);

			$product_columns[] = array(
				'name' => 'Allow Backorders?',
				'type' => 'select',
				'table' => 'meta',
				'field' => '_backorders',
				'readonly' => 'false',
				'visibility' => 'both',
				'sortable' => 'true',
				'views' => array( 'all' )
			);
		}

		$product_columns[] = array(
			'name' => 'Stock Status',
			'type' => 'select',
			'table' => 'meta',
			'field' => '_stock_status',
			'readonly' => 'false',
			'visibility' => 'variation',
			'sortable' => 'true',
			'views' => array( 'all' )
		);

        $product_columns[] = array(
            'name' => 'Menu Order',
            'type' => 'number',
            'table' => 'post',
            'field' => 'menu_order',
            'readonly' => 'false',
            'visibility' => 'both',
            'sortable' => 'true',
            'views' => array( 'all' )
        );

		$product_columns[] = array(
			'name' => 'Catalog Visibility',
			'type' => 'select',
			'table' => 'meta',
			'field' => '_visibility',
			'readonly' => 'false',
			'visibility' => 'parent',
			'sortable' => 'true',
			'views' => array( 'all' )
		);

		$product_columns[] = array(
			'name' => 'Featured',
			'type' => 'checkbox',
			'table' => 'meta',
			'field' => '_featured',
			'readonly' => 'false',
			'visibility' => 'parent',
			'sortable' => 'true',
			'views' => array( 'all' )
		);

		$product_columns[] = array(
			'name' => 'Status',
			'type' => 'select',
			'table' => 'post',
			'field' => 'post_status',
			'readonly' => 'false',
			'visibility' => 'both',
			'sortable' => 'true',
			'views' => array( 'all', 'standard' )
		);

		$product_columns[] = array(
			'name' => 'ID',
			'type' => 'number',
			'table' => 'post',
			'field' => 'post_id',
			'readonly' => 'true',
			'visibility' => 'both',
			'sortable' => 'true',
			'views' => array( 'all' )
		);

		$product_columns = apply_filters( 'pwbe_product_columns', $product_columns );

		PWBE_Columns::$columns = $product_columns;
	}
}

endif;

?>