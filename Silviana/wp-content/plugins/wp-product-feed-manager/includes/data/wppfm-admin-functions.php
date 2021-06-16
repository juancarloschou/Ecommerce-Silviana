<?php
/**
 * WP Product Feed Manager Administrative functions
 *
 * Functions for Administrative actions
 *
 * @author 		Michel Jongbloed
 * @category 	Cron
 * @package 	Application
 * @version     2.1
 */

// Prevent direct access
if (!defined('ABSPATH')) exit;

/**
 * Converts a string containing a date-time stamp as stored in the meta data to a date time string
 * that can be used in a feed file
 * 
 * @since 1.1.0
 * 
 * @param string	$datestamp	The timestamp that needs to be converted to a string that can be stored in a feed file
 * 
 * @return string	A string containing the time or an empty string if the $datestamp is empty
 */
function convert_price_date_to_feed_format( $datestamp ) {
	if ( $datestamp ) {
		// register the date
		$feed_string = date( 'Y-m-d', $datestamp );

		// if set, add the time
		if ( date( 'H', $datestamp ) !== '00' || date( 'i', $datestamp ) !== '00' || date( 's', $datestamp ) !== '00' ) {
			$feed_string .= 'T' . date( 'H:i:s', $datestamp );
		}
		
		return $feed_string;
	} else {
		return '';
	}
}

/**
 * After a channel has been updated this function decreases the 'wppfm_channels_to_update' option with one
 * 
 * @since 1.4.1
 */
function decrease_updatable_channels() {
	$old = get_option( 'wppfm_channels_to_update' );

	if ( $old > 0 ) { update_option( 'wppfm_channels_to_update', $old - 1 ); } 
	else { update_option( 'wppfm_channels_to_update', 0 ); }
}

/**
 * Checks if a specific source key is a money related key or not
 * 
 * @since 1.1.0
 * 
 * @param string	$key	The source key to be checked
 * @return boolean	True if the source key is money related, false if not
 */
function meta_key_is_money( $key ) {
	// money keys
	$special_price_keys = array(
		'_max_variation_price',
		'_max_variation_regular_price',
		'_max_variation_sale_price',
		'_min_variation_price',
		'_min_variation_regular_price',
		'_min_variation_sale_price',
		'_regular_price',
		'_sale_price' );

	return in_array( $key, $special_price_keys ) ? true : false;
}
		
/**
 * Takes a value and formats it to a money value using the WooCommerce thousands separator, decimal separator and number of decimals values
 * 
 * @since 1.1.0
 * @since 1.9.0 added WPML support
 * 
 * @param string	$money_value			The money value to be formated
 * @param string	$feed_language			Selected Language in WPML addon, leave empty if no exchange rate correction is required @since 1.9.0
 * @return string	A formated money value
 */
function prep_money_values( $money_value, $feed_language = '' ) {
	$thousand_separator = get_option( 'woocommerce_price_thousand_sep' );

	if( !is_float( $money_value ) ) {
		$val = numberformat_parse( $money_value );
		$money_value = floatval( $val );
	}
	
	if( has_filter( 'wppfm_wpml_exchange_money_values' ) ) {
		return apply_filters( 'wppfm_wpml_exchange_money_values', $money_value, $feed_language );
	} else {
		$number_decimals = absint( get_option( 'woocommerce_price_num_decimals', 2 ) );
		$decimal_point = get_option( 'woocommerce_price_decimal_sep' );

		return number_format( $money_value, $number_decimals, $decimal_point, $thousand_separator );
	}
}

/**
 * Checks if there are invalid backups
 * 
 * @since 1.8.0
 * 
 * @return boolean true if there are no backups or these backups are current
 */
function wppfm_check_backup_status() {
	if ( !WPPFM_Db_Management::invalid_backup_exist() ) return true;
}

/**
 * Forces the database to load and update and adds the auto update cron event if it does not exists
 * 
 * @since 1.9.0
 * 
 * @return boolean
 */
function wppfm_reinitiate_plugin() {
	if ( !wp_get_schedule( 'wppfm_feed_update_schedule' ) ) {
		// add the schedule cron
		wp_schedule_event( time(), 'hourly', 'wppfm_feed_update_schedule' );
		add_action( 'wppfm_feed_update_schedule', 'activate_feed_update_schedules' );
	}

	// remakes the database
	$db = new WPPFM_Database();
	$db->force_reinitiate_db();
	
	// resets the license nr
	delete_option( 'wppfm_lic_status' );
	delete_option( 'wppfm_lic_status_date' );
	delete_option( 'wppfm_lic_key' );
	delete_option( 'wppfm_lic_expires' );
	delete_option( 'wppfm_license_notice_surpressed' );
	
	// reset the keyed options
	WPPFM_Db_Management::clean_options_table();

	do_action( 'wppfm_plugin_reinitialized' );
	
	return true;
}

function wppfm_clear_feed_process_data() {
	WPPFM_Feed_Controller_Class::clear_feed_queue();
	WPPFM_Feed_Controller_Class::set_feed_processing_flag( false );
	WPPFM_Db_Management::clean_options_table();
	
	do_action( 'wppfm_feed_process_data_cleared' );
	
	return true;
}

/**
 * Converts any number string to a string with a number that has no thousands separator 
 * and a period as decimal separator
 * 
 * @param string $number_string
 * @return string
 */
function numberformat_parse( $number_string ) {
	$decimal_separator = get_option( 'woocommerce_price_decimal_sep' );
	$thousand_separator = get_option( 'woocommerce_price_thousand_sep' );
	
	// convert a number string that is a actual standard number format whilst the woocommerce options are not standard
	// to the woocommerce standard. This sometimes happens with meta values
	if( !empty( $decimal_separator ) && strpos( $number_string, $decimal_separator ) === false ) {
		$number_string = !empty( $thousand_separator ) && strpos( $number_string, $thousand_separator ) === false ? $number_string : str_replace( $thousand_separator, $decimal_separator, $number_string );
	}
	
	$no_thousands_sep = str_replace( $thousand_separator, '', $number_string );
	return $decimal_separator !== '.' ? str_replace( $decimal_separator, '.', $no_thousands_sep ) : $no_thousands_sep;
}

/**
 * returns the path to the feed file including feed name and extension
 * 
 * @param string $feed_name
 * @return string
 */
function get_file_path( $feed_name ) {

	// previous to plugin version 1.3.0 feeds where stored in the plugins but after that version they are stored in the upload folder
	if( file_exists( WP_PLUGIN_DIR . '/wp-product-feed-manager-support/feeds/' . $feed_name ) ) {
		return WP_PLUGIN_DIR . '/wp-product-feed-manager-support/feeds/' . $feed_name;
	} elseif( file_exists( WPPFM_FEEDS_DIR . '/' . $feed_name ) ) {
		return WPPFM_FEEDS_DIR . '/' . $feed_name;
	} else { // as of version 1.5.0 all spaces in new filenames are replaced by a dash
		$forbidden_name_chars = forbidden_file_name_characters();
		return WPPFM_FEEDS_DIR . '/' . str_replace( $forbidden_name_chars, '-', $feed_name);
	}
}

function forbidden_file_name_characters() {
	return array( ' ', '<', '>', ':', '?', ',' ); // characters that are not allowed in a feed file name
}