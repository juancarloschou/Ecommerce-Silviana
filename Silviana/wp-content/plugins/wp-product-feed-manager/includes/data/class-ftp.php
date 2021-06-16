<?php

/* * ******************************************************************
 * Version 2.0
 * Modified: 20-08-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) {
	echo 'Hi!  I\'m just a plugin, there\'s not much I can do when called directly.';
	exit;
}

if ( !class_exists( 'WPPFM_FTP_Class' ) ) :

	/**
	 * The WPPFM_FTP_Class handles all ftp actions
	 * 
	 * @class WPPFM_FTP_Class
	 * @version 2.0
	 * @category class
	 */
	class WPPFM_FTP_Class {

		/**
		 * Gets the correct channel zip file from the wpmarketingrobot server
		 * 
		 * @since 1.9.3 - switched from ftp to cURL procedures
		 * 
		 * @param string $channel
		 * @param string $code
		 * @return boolean
		 */
		public function get_channel_source_files( $channel, $code ) {

			// check if channel dir exists
			if ( !file_exists( WPPFM_CHANNEL_DATA_DIR ) ) { WPPFM_Folders_Class::make_channels_support_folder(); }
			
			// and if it is writable
			if( !is_writable( WPPFM_CHANNEL_DATA_DIR ) ) {
				echo wppfm_show_wp_error( sprintf( __( "You have no read/write permission to the %s folder. Please update the file permissions of this folder to make it writable and then try installing a channel again.", 'wp-product-feed-manager' ), WPPFM_CHANNEL_DATA_DIR ) );
				return false;
			}

			$local_file	 = WPPFM_CHANNEL_DATA_DIR . '/' . $channel . '.zip';
			$remote_file_url = 'https://wpmarketingrobot.com/system/wp-content/uploads/wppfm_channel_downloads/' . $code . '.zip';

			$zipResource = fopen($local_file, "w");
			
			// Get The Zip File From Server
			$ch = curl_init();
			
			curl_setopt( $ch, CURLOPT_URL, $remote_file_url );
			curl_setopt( $ch, CURLOPT_FAILONERROR, true );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
			curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
			curl_setopt( $ch, CURLOPT_BINARYTRANSFER,true );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 ); 
			curl_setopt( $ch, CURLOPT_FILE, $zipResource );
			
			$page = curl_exec( $ch );
			
			curl_close( $ch );
			fclose( $zipResource );

			if( !$page ) { 
				echo wppfm_show_wp_error( 'error: ' . curl_error( $ch ) ); 
				return false;
			}
			
			return true;
		}

	}

	

	// end of WPPFM_FTP_Class

endif;
