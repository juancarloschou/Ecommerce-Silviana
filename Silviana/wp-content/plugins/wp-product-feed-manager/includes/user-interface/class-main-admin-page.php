<?php

/* * ******************************************************************
 * Version 1.5
 * Modified: 18-06-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Main_Admin_Page' ) ) :

	class WPPFM_Main_Admin_Page extends WPPFM_Admin_Page {

		private $_list_table;

		/**
		 * Class constructor
		 */
		function __construct() {

			parent::__construct();

			$this->prepare_feed_list();
		}

		/**
		 * Collects the html code for the main page and displays it.
		 */
		public function show() {
			
			// update the database if required
			$db_management = new WPPFM_Database();
			$db_management->verify_db_version();

			echo $this->admin_page_header();
			
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

				$wc_version = get_plugin_data( WPPFM_PLUGIN_DIR . '../woocommerce/woocommerce.php' )['Version'];

				if( $wc_version < '3.0.0' ) {
					echo $this->update_woocommerce( $wc_version );
					exit;
				}

				echo $this->tabs();

				echo $this->main_admin_page();

				echo $this->message_field();

				echo $this->main_admin_buttons();
			} else {

				echo $this->no_woocommerce();
			}

			echo $this->admin_page_footer();
		}

		/**
		 * Prepares the list table
		 */
		private function prepare_feed_list() {

			// prepare the table elements
			$this->_list_table = new WPPFM_List_Table ();

			$this->_list_table->set_table_id( "wppfm-feed-list" );

			// set the column names
			$this->_list_table->set_column_titles( array(
				'col_feed_name'			 => __( 'Name', 'wp-product-feed-manager' ),
				'col_feed_url'			 => __( 'Url', 'wp-product-feed-manager' ),
				'col_feed_last_change'	 => __( 'Last change', 'wp-product-feed-manager' ),
				'col_feed_products'		 => __( 'Products', 'wp-product-feed-manager' ),
				'col_feed_status'		 => __( 'Status', 'wp-product-feed-manager' ),
				'col_feed_actions'		 => __( 'Actions', 'wp-product-feed-manager' )
			) );
		}

		/**
		 * Returns the tabs
		 * 
		 * @return html string
		 */
		private function tabs() {
			?>
			<h2 class="nav-tab-wrapper">
				<a href="admin.php?page=wp-product-feed-manager" class="nav-tab nav-tab-active"><?php _e( 'Feeds List', 'wp-product-feed-manager' ); ?></a>
				<a href="admin.php?page=wp-product-feed-manager-add-new-feed" class="nav-tab"><?php _e( 'Add or Edit Feed', 'wp-product-feed-manager' ); ?></a>
			</h2>
			<?php
		}

		/**
		 * Returns a html string containing the main admin page body code
		 * 
		 * @return html string
		 */
		private function main_admin_page() {
			return $this->main_admin_body_top();
		}
		
		/**
		 * Returns a html string containing a message to the user that woocommerce is not installed on the server
		 * 
		 * @return html string
		 */
		private function no_woocommerce() {
			$message_code = '<div class="full-screen-message-field">';
			$message_code .= '<p>*** This plugin only works in conjunction with the WooCommerce Plugin! ';
			$message_code .= 'It seems you have not installed the WooCommerce Plugin yet, so please do so before using this Plugin. ***</p>';
			$message_code .= '<p>You can find more information about the Woocommerce Plugin <a href="https://wordpress.org/plugins/woocommerce/">by clicking here</a>.</p>';
			$message_code .= '</div>';
				
			return $message_code;
		}
		
		private function update_woocommerce( $version ) {
			$message_code = '<div class="full-screen-message-field">';
			$message_code .= '<p>*** This plugin requires WooCommerce version 3.0.0 as a minimum! ';
			$message_code .= 'It seems you have installed WooCommerce version ' . $version . ' which is a version that is not supported. Please update to at least version 3.0.0. ***</p>';
			$message_code .= '</div>';
				
			return $message_code;
		}

		/**
		 * Returns the html for the main body top
		 * 
		 * @return html
		 */
		private function main_admin_body_top() {
			return $this->_list_table->display();
		}

		private function main_admin_buttons() {
			return '<div class="button-wrapper" id="page-bottom-buttons"><input class="button-primary" type="button" ' .
			'onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed\'" name="new" value="' .
			__( 'Add New Feed', 'wp-product-feed-manager' ) . '" id="add-new-feed-button" /></div>';
		}

	}

    

     // end of WPPFM_Main_Admin_Page class

endif;