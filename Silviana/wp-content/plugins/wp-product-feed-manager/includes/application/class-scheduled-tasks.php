<?php

/* * ******************************************************************
 * Version 4.0
 * Modified: 25-12-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;


if ( !class_exists( 'WPPFM_Schedules' ) ) :

	/**
	 * The WPPFM_Schedules class contains the functions that perform scheduled tasks like updating the active feeds
	 * 
	 * @class		WPPFM_Schedules
	 * @version		4.0
	 * @category	Class
	 * @author		Michel Jongbloed
	 */
	class WPPFM_Schedules {

		/* --------------------------------------------------------------------------------------------------*
		 * Public functions
		 * -------------------------------------------------------------------------------------------------- */

		/**
		 * Initiates the automatic feed updates
		 * 
		 * @param bool $silent
		 */
		public function update_active_feeds() {
			$data_class = new WPPFM_Data_Class();
			$feed_master_class = new WPPFM_Feed_Master_Class();

			$current_timestamp = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
			$active_feeds_schedules = $data_class->get_schedule_data();
			$failed_feeds = $data_class->get_failed_feeds();

			// update scheduled feeds
			foreach ( $active_feeds_schedules as $schedule ) {
				$update_time = $this->new_activation_time( $schedule[ 'updated' ], $schedule[ 'schedule' ] );
				
				// activate the feed update when the update time is reached
				if ( $update_time < $current_timestamp ) {
					WPPFM_Feed_Controller_Class::add_id_to_feed_queue( $schedule['product_feed_id'] );
					
					// if there is no feed processing in progress, start updating the current feed
					if( ! WPPFM_Feed_Controller_Class::feed_is_processing() ) {
						$feed_master_class->update_feed_file( true );
					} else {
						$data_class->update_feed_status( $schedule['product_feed_id'], 4 ); // feed status to waiting in queue
					}
				}
			}
			
			// update previously failed feeds
			if ( "true" === get_option( 'wppfm_auto_feed_fix' ) ) {
				foreach ( $failed_feeds as $failed_feed ) {
					WPPFM_Feed_Controller_Class::add_id_to_feed_queue( $failed_feed['product_feed_id'] );
					
					// if there is no feed processing in progress, start updating the current feed
					if( ! WPPFM_Feed_Controller_Class::feed_is_processing() ) {
						$feed_master_class->update_feed_file( true );
					} else {
						$data_class->update_feed_status( $failed_feed['product_feed_id'], 4 ); // feed status to waiting in queue
					}
				}
			}
		}

		/* --------------------------------------------------------------------------------------------------*
		 * Private functions
		 * -------------------------------------------------------------------------------------------------- */

		/**
		 * Returns the time at which the feed should be updated
		 * 
		 * @return string Containing the time in Y-m-d H:i:s format
		 */
		private function new_activation_time( $last_update, $update_frequency ) {
			$update_split = explode( ':', $update_frequency );

			$hrs = isset( $update_split[1] ) ? $update_split[1] : '00';
			$min = isset( $update_split[2] ) ? $update_split[2] : '00' ;
			$freq = isset( $update_split[3] ) ? $update_split[3] : 1;
			
			$planned_update_time = $hrs . ':' . $min . ':00';
			$planned_update_time = $planned_update_time !== '00:00:00' ? $planned_update_time : '23:59:00';
			$last_update_time = date( 'H:i:s', strtotime( $last_update ) );
			$days = $update_split[0] <= 1 
					&& ( ( strtotime( $last_update_time ) <= strtotime( $planned_update_time ) ) 
					|| ( $hrs === '00' && $min === '00' ) ) 
					? 0 : $update_split[0];
			
			if ( $freq < 2 ) { // update only once a day, every $update_split[0] days
				$update_date = date_add( date_create( date( 'Y-m-d', strtotime( $last_update ) ) ) , date_interval_create_from_date_string( $days . ' days' ) );

				return date_format( $update_date, 'Y-m-d' ) . ' ' . $planned_update_time;
			} else { // update more than once a day
				$update_hrs = $this->get_update_hours( $freq );
				$update_date = date_add( date_create( $last_update ), date_interval_create_from_date_string( $update_hrs . ' hours' ) );

				return date_format( $update_date, 'Y-m-d H:i' ) . ':00';
			}
		}
		
		/**
		 * Returns the daily update options
		 * 
		 * @return int Hours difference between updates
		 */
		private function get_update_hours( $selection ) {
			switch( $selection ) {
				case '2':
					return 12;
				case '4':
					return 6;
				case '6':
					return 4;
				case '8':
					return 3;
				case '12':
					return 2;
				case '24':
					return 1;
				default:
					return 24;
			}
		}

	}

     // end of WPPFM_Schedules class

endif;