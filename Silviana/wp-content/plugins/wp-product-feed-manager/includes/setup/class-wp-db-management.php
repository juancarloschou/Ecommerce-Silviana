<?php

/* * ******************************************************************
 * Version 2.1
 * Modified: 29-09-2017
 * Copyright 2017 Accentio. All rights reserved.
 * License: None
 * By: Michel Jongbloed
 * ****************************************************************** */

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'WPPFM_Database' ) ) :

	/**
	 * The WPPFM_Database class contains the functions that make the required database tables on plugin activation
	 * 
	 * @class WPPFM_Database
	 * @version dev
	 */
	class WPPFM_Database {
		/* --------------------------------------------------------------------------------------------------*
		 * Attributes
		 * -------------------------------------------------------------------------------------------------- */

		private $_version = '1.2.6'; // as of plugin version 1.10.0
		private $_wpdb;
		private $_charset_collate = '';
		private $_image_folder;

		/**
		 * WPPFM_Tables
		 * 
		 * @access public
		 */
		public function __construct() {
			global $wpdb;

			// include what needs to be included
			$this->includes();

			// assign the global wpdb to a varable
			$this->_wpdb = &$wpdb;

			// set the charset for the new database tables
			if ( $this->_wpdb->has_cap( 'collation' ) ) {
				$this->_charset_collate = $wpdb->get_charset_collate();
			}

			// url to the image folder
			$this->_image_folder = esc_url( WPPFM_PLUGIN_URL . '/images/' );
		}

		/**
		 * Adds the required tables to the Wordpress database
		 */
		public function make() {
			// make the tables
			$this->make_or_update_the_tables();

			// fill the tables with preset data
			$this->fill_the_tables();
			
			do_action( 'wppfm_installed' );
		}
		
		/**
		 * Checks if there is a need to update the database after a plugin update and performs the update if required
		 * 
		 * @since 1.8.0
		 */
		public function verify_db_version() {
			$actual_db_version = get_option( 'wppfm_db_version' ) ? get_option( 'wppfm_db_version' ) : $this->get_current_db_version();
			if ( $actual_db_version < $this->_version ) { 
				$this->make_or_update_the_tables(); 

				// update table as of version 1.2.4
				if( $this->_version >= '1.2.4' ) {
					$this->update_status_table();
				}
			}

			do_action( 'wppfm_db_verified' );
		}
		
		/**
		 * Forces a database update
		 * 
		 * @since 1.9.0
		 */
		public function force_reinitiate_db() {
			$this->make_or_update_the_tables();
		}
		
		public function reset_channel_registration() {
			$this->fill_channel_table();
		}

		/* --------------------------------------------------------------------------------------------------*
		 * Private functions
		 * -------------------------------------------------------------------------------------------------- */

		private function includes() {
			// required for dbDelta
			require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}

		/**
		 * makes or updates the required database tables
		 * 
		 * @since 1.9.2
		 */
		private function make_or_update_the_tables() {
			$this->channel_table();
			$this->country_table();
			$this->feed_table();
			$this->feedmeta_table();
			$this->status_table();
			$this->categories_table();
			$this->sources_table();
			$this->error_table();
			
			// store the db version
			update_option( 'wppfm_db_version', $this->_version );
		}

		/**
		 * fill the tables with preset data
		 * 
		 * @since 1.9.2
		 */
		private function fill_the_tables() {
			$this->fill_channel_table();
			$this->fill_country_table();
			$this->fill_merchant_table();
			$this->fill_status_table();
			$this->fill_categories_table();
		}

		/**
		 * creates the feed table
		 */
		private function feed_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_product_feed';

			$sql = "CREATE TABLE $table_name (
				product_feed_id int NOT NULL AUTO_INCREMENT,
				channel_id smallint NOT NULL,
				language varchar(7),
				is_aggregator smallint NOT NULL DEFAULT 0,
				include_variations smallint NOT NULL DEFAULT 0,
				country_id smallint NOT NULL DEFAULT 233,
				source_id smallint NOT NULL,
				title varchar(100) NOT NULL UNIQUE DEFAULT '',
				feed_title varchar(100),
				feed_description varchar(200),
				main_category varchar(200) NOT NULL DEFAULT '',
				url varchar(200) NOT NULL DEFAULT '',
				status_id smallint NOT NULL DEFAULT 1,
				base_status_id smallint NOT NULL DEFAULT 2,
				updated datetime NOT NULL,
				schedule varchar(50) NOT NULL DEFAULT '1:00:00',
				products int NOT NULL DEFAULT 1,
				timestamp timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY  (product_feed_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * creates a meta table for the feeds
		 */
		private function feedmeta_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_product_feedmeta';

			$sql = "CREATE TABLE $table_name (
				meta_id int NOT NULL AUTO_INCREMENT,
				product_feed_id int NOT NULL,
				meta_key varchar(191),
				meta_value longtext,
				PRIMARY KEY  (meta_id),
				KEY product_feed_id (product_feed_id),
				KEY meta_key (meta_key)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * create a feed status table
		 */
		private function status_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_feed_status';

			$sql = "CREATE TABLE $table_name (
				status_id smallint NOT NULL,
				status varchar(20) NOT NULL UNIQUE DEFAULT 'OK',
				color char(7)NOT NULL UNIQUE,
				PRIMARY KEY  (status_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * creates the channel table
		 */
		private function channel_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_channel';

			$sql = "CREATE TABLE $table_name (
				channel_id int NOT NULL DEFAULT 0,
				name varchar(100) NOT NULL UNIQUE DEFAULT '',
				short varchar(50) NOT NULL UNIQUE DEFAULT '',
				PRIMARY KEY  (channel_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * creates the country table
		 */
		private function country_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_country';

			$sql = "CREATE TABLE $table_name (
				country_id int NOT NULL AUTO_INCREMENT,
				name_short varchar(3) NOT NULL UNIQUE DEFAULT '',
				name varchar(100) NOT NULL UNIQUE DEFAULT '',
				PRIMARY KEY  (country_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * creates the sources table
		 */
		private function sources_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_source';

			$sql = "CREATE TABLE $table_name (
				source_id int NOT NULL UNIQUE,
				name varchar(100) NOT NULL UNIQUE DEFAULT '',
				PRIMARY KEY  (source_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * creates a table to store error messages
		 */
		private function error_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_errors';
			
			// As I have had some issues with errors caused by this table not being accessable, here is the sql code with what
			// I can quickly restore this table in the database if required
			// CREATE TABLE wp_feedmanager_errors ( product_id int NOT NULL, error_id int NOT NULL, error_message varchar(500)	NOT NULL, action_message varchar(1000), timestamp timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, CONSTRAINT source_pk PRIMARY KEY (product_id) );

			$sql = "CREATE TABLE $table_name (
				product_id int NOT NULL,
				error_id int NOT NULL,
				error_message varchar(200) NOT NULL,
				action_message varchar(255),
				timestamp timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY  (product_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		private function categories_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_field_categories';

			$sql = "CREATE TABLE $table_name (
				category_id int NOT NULL,
				category_label varchar(100) NOT NULL,
				PRIMARY KEY  (category_id)
			) " . $this->_charset_collate . ";";

			dbDelta( $sql );
		}

		/**
		 * fills the countries table with supported contries
		 */
		private function fill_country_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_country';

			$count = $this->_wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

			// only fill the table if its still empty
			if ( $count == 0 ) {
				$sql = "INSERT INTO $table_name
               (name_short, name) VALUES
                  ('AD', 'Andorra'), ('AE', 'United Arab Emirates'), ('AF', 'Afghanistan'), ('AG', 'Antigua and Barbuda'), ('AI', 'Anguilla'), ('AL', 'Albania'),
                  ('AM', 'Armenia'), ('AO', 'Angola'), ('AQ', 'Antarctica'), ('AR', 'Argentina'), ('AS', 'American Samoa'), ('AT', 'Austria'), ('AU', 'Australia'),
                  ('AW', 'Aruba'), ('AX', '??land'), ('AZ', 'Azerbaijan'), ('BA', 'Bosnia and Herzegovina'), ('BB', 'Barbados'), ('BD', 'Bangladesh'), ('BE', 'Belgium'),
                  ('BF', 'Burkina Faso'), ('BG', 'Bulgaria'), ('BH', 'Bahrain'), ('BI', 'Burundi'), ('BJ', 'Benin'), ('BL', 'Saint Barth??lemy'), ('BM', 'Bermuda'),
                  ('BN', 'Brunei'), ('BO', 'Bolivia'), ('BQ', 'Bonaire'), ('BR', 'Brazil'), ('BS', 'Bahamas'), ('BT', 'Bhutan'), ('BV', 'Bouvet Island'), ('BW', 'Botswana'),
                  ('BY', 'Belarus'), ('BZ', 'Belize'), ('CA', 'Canada'), ('CC', 'Cocos [Keeling] Islands'), ('CD', 'Democratic Republic of the Congo'), 
                  ('CF', 'Central African Republic'), ('CG', 'Republic of the Congo'), ('CH', 'Switzerland'), ('CI', 'Ivory Coast'), ('CK', 'Cook Islands'),
                  ('CL', 'Chile'), ('CM', 'Cameroon'), ('CN', 'China'), ('CO', 'Colombia'), ('CR', 'Costa Rica'), ('CU', 'Cuba'), ('CV', 'Cape Verde'),
                  ('CW', 'Curacao'), ('CX', 'Christmas Island'), ('CY', 'Cyprus'), ('CZ', 'Czech Republic'), ('DE', 'Germany'), ('DJ', 'Djibouti'), ('DK', 'Denmark'),
                  ('DM', 'Dominica'), ('DO', 'Dominican Republic'), ('DZ', 'Algeria'), ('EC', 'Ecuador'), ('EE', 'Estonia'), ('EG', 'Egypt'), ('EH', 'Western Sahara'),
                  ('ER', 'Eritrea'), ('ES', 'Spain'), ('ET', 'Ethiopia'), ('FI', 'Finland'), ('FJ', 'Fiji'), ('FK', 'Falkland Islands'), ('FM', 'Micronesia'),
                  ('FO', 'Faroe Islands'), ('FR', 'France'), ('GA', 'Gabon'), ('GB', 'United Kingdom'), ('GD', 'Grenada'), ('GE', 'Georgia'), ('GF', 'French Guiana'),
                  ('GG', 'Guernsey'), ('GH', 'Ghana'), ('GI', 'Gibraltar'), ('GL', 'Greenland'), ('GM', 'Gambia'), ('GN', 'Guinea'), ('GP', 'Guadeloupe'),
                  ('GQ', 'Equatorial Guinea'), ('GR', 'Greece'), ('GS', 'South Georgia and the South Sandwich Islands'), ('GT', 'Guatemala'), ('GU', 'Guam'),
                  ('GW', 'Guinea-Bissau'), ('GY', 'Guyana'), ('HK', 'Hong Kong'), ('HM', 'Heard Island and McDonald Islands'), ('HN', 'Honduras'), ('HR', 'Croatia'),
                  ('HT', 'Haiti'), ('HU', 'Hungary'), ('ID', 'Indonesia'), ('IE', 'Ireland'), ('IL', 'Israel'), ('IM', 'Isle of Man'), ('IN', 'India'),
                  ('IO', 'British Indian Ocean Territory'), ('IQ', 'Iraq'), ('IR', 'Iran'), ('IS', 'Iceland'), ('IT', 'Italy'), ('JE', 'Jersey'), ('JM', 'Jamaica'),
                  ('JO', 'Jordan'), ('JP', 'Japan'), ('KE', 'Kenya'), ('KG', 'Kyrgyzstan'), ('KH', 'Cambodia'), ('KI', 'Kiribati'), ('KM', 'Comoros'),
                  ('KN', 'Saint Kitts and Nevis'), ('KP', 'North Korea'), ('KR', 'South Korea'), ('KW', 'Kuwait'), ('KY', 'Cayman Islands'), ('KZ', 'Kazakhstan'),
                  ('LA', 'Laos'), ('LB', 'Lebanon'), ('LC', 'Saint Lucia'), ('LI', 'Liechtenstein'), ('LK', 'Sri Lanka'), ('LR', 'Liberia'), ('LS', 'Lesotho'),
                  ('LT', 'Lithuania'), ('LU', 'Luxembourg'), ('LV', 'Latvia'), ('LY', 'Libya'), ('MA', 'Morocco'), ('MC', 'Monaco'), ('MD', 'Moldova'),
                  ('ME', 'Montenegro'), ('MF', 'Saint Martin'), ('MG', 'Madagascar'), ('MH', 'Marshall Islands'), ('MK', 'Macedonia'), ('ML', 'Mali'),
                  ('MM', 'Myanmar [Burma]'), ('MN', 'Mongolia'), ('MO', 'Macao'), ('MP', 'Northern Mariana Islands'), ('MQ', 'Martinique'), ('MR', 'Mauritania'),
                  ('MS', 'Montserrat'), ('MT', 'Malta'), ('MU', 'Mauritius'), ('MV', 'Maldives'), ('MW', 'Malawi'), ('MX', 'Mexico'), ('MY', 'Malaysia'),
                  ('MZ', 'Mozambique'), ('NA', 'Namibia'), ('NC', 'New Caledonia'), ('NE', 'Niger'), ('NF', 'Norfolk Island'), ('NG', 'Nigeria'),
                  ('NI', 'Nicaragua'), ('NL', 'Netherlands'), ('NO', 'Norway'), ('NP', 'Nepal'), ('NR', 'Nauru'), ('NU', 'Niue'), ('NZ', 'New Zealand'), ('OM', 'Oman'),
                  ('PA', 'Panama'), ('PE', 'Peru'), ('PF', 'French Polynesia'), ('PG', 'Papua New Guinea'), ('PH', 'Philippines'), ('PK', 'Pakistan'), ('PL', 'Poland'),
                  ('PM', 'Saint Pierre and Miquelon'), ('PN', 'Pitcairn Islands'), ('PR', 'Puerto Rico'), ('PS', 'Palestine'), ('PT', 'Portugal'), ('PW', 'Palau'),
                  ('PY', 'Paraguay'), ('QA', 'Qatar'), ('RE', 'R??union'), ('RO', 'Romania'), ('RS', 'Serbia'), ('RU', 'Russia'), ('RW', 'Rwanda'), ('SA', 'Saudi Arabia'),
                  ('SB', 'Solomon Islands'), ('SC', 'Seychelles'), ('SD', 'Sudan'), ('SE', 'Sweden'), ('SG', 'Singapore'), ('SH', 'Saint Helena'), ('SI', 'Slovenia'),
                  ('SJ', 'Svalbard and Jan Mayen'), ('SK', 'Slovakia'), ('SL', 'Sierra Leone'), ('SM', 'San Marino'), ('SN', 'Senegal'), ('SO', 'Somalia'), ('SR', 'Suriname'),
                  ('SS', 'South Sudan'), ('ST', 'S??o Tom?? and Pr??ncipe'), ('SV', 'El Salvador'), ('SX', 'Sint Maarten'), ('SY', 'Syria'), ('SZ', 'Swaziland'), 
                  ('TC', 'Turks and Caicos Islands'), ('TD', 'Chad'), ('TF', 'French Southern Territories'), ('TG', 'Togo'), ('TH', 'Thailand'), ('TJ', 'Tajikistan'),
                  ('TK', 'Tokelau'), ('TL', 'East Timor'), ('TM', 'Turkmenistan'), ('TN', 'Tunisia'), ('TO', 'Tonga'), ('TR', 'Turkey'), ('TT', 'Trinidad and Tobago'),
                  ('TV', 'Tuvalu'), ('TW', 'Taiwan'), ('TZ', 'Tanzania'), ('UA', 'Ukraine'), ('UG', 'Uganda'), ('UM', 'U.S. Minor Outlying Islands'), ('US', 'United States'),
                  ('UY', 'Uruguay'), ('UZ', 'Uzbekistan'), ('VA', 'Vatican City'), ('VC', 'Saint Vincent and the Grenadines'), ('VE', 'Venezuela'),
                  ('VG', 'British Virgin Islands'), ('VI', 'U.S. Virgin Islands'), ('VN', 'Vietnam'), ('VU', 'Vanuatu'), ('WF', 'Wallis and Futuna'), ('WS', 'Samoa'),
                  ('XK', 'Kosovo'), ('YE', 'Yemen'), ('YT', 'Mayotte'), ('ZA', 'South Africa'), ('ZM', 'Zambia'), ('ZW', 'Zimbabwe')";

				$this->_wpdb->query( $sql );
			}
		}

		private function fill_merchant_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_source';

			$count = $this->_wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

			// only fill the table if its still empty
			if ( $count == 0 ) {
				$sql = "INSERT INTO $table_name
               (source_id, name) VALUES ('1', 'Woocommerce')";

				$this->_wpdb->query( $sql );
			}
		}

		private function fill_status_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_feed_status';

			$count = $this->_wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

			// only fill the table if its still empty
			if ( $count == 0 ) {
				$sql = "INSERT INTO $table_name
               (status_id, status, color) VALUES
                  ('0', 'Unknown', '#6549F7'),
                  ('1', 'OK', '#0073AA'),
                  ('2', 'On hold', '#0173AA'),
                  ('3', 'Processing', '#0000FF'),
				  ('4', 'In processing queue', '#00CCFF'),
                  ('5', 'Has errors', '#FF0000'),
				  ('6', 'Failed processing', '#FF3300')";

				$this->_wpdb->query( $sql );
			}
		}

		private function fill_categories_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_field_categories';

			$count = $this->_wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

			// only fill the table if its still empty
			if ( $count == 0 ) {
				$sql = "INSERT INTO $table_name
               (category_id, category_label) VALUES
                  (1, 'required'), (2, 'highly recommended'), (3, 'recommended'), (4, 'optional'), (5, 'custom')";

				$this->_wpdb->query( $sql );
			}
		}
		
		/**
		 * Gets the current database version from the database
		 * 
		 * @since 1.8.0
		 * 
		 * @return string containing the curren db version
		 */
		private function get_current_db_version() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_product_feedmeta';
			return $this->_wpdb->get_var( "SELECT meta_value FROM $table_name WHERE product_feed_id = 0" );
		}

		/**
		 * fills the channel tabel with supported merchants
		 */
		private function fill_channel_table() {
			$channel_class = new WPPFM_Channel();
			$data_class = new WPPFM_Data_Class();

			$table_name = $this->_wpdb->prefix . 'feedmanager_channel';
			$channel_names = $channel_class->get_installed_channel_names();

			// remove the current channels
			$this->_wpdb->query( "DELETE FROM $table_name" );
			
			foreach ( $channel_names as $channel_short_name ) {
				$channel_data = $channel_class->get_active_channel_details( $channel_short_name );
				
				if ( $channel_data !== null ) {
					$data_class->register_channel( $channel_short_name, $channel_data );
				}
			}
		}
		
		/**
		 * Updates the status table to version 1.2.4
		 * 
		 * @since 1.10.0
		 */
		private function update_status_table() {
			$table_name = $this->_wpdb->prefix . 'feedmanager_feed_status';

			$count = $this->_wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

			// only fill the table if its still empty
			if ( $count < 7 ) {
				$format = array( '%d', '%s', '%s' );
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '0', 'status' => 'Unknown', 'color' => '#6549F7' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '1', 'status' => 'OK', 'color' => '#0073AA' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '2', 'status' => 'On hold', 'color' => '#0173AA' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '3', 'status' => 'Processing', 'color' => '#0000FF' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '4', 'status' => 'In processing queue', 'color' => '#00CCFF' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '5', 'status' => 'Has errors', 'color' => '#FF0000' ),
					$format
				);
				
				$this->_wpdb->replace(
					$table_name,
					array( 'status_id' => '6', 'status' => 'Failed processing', 'color'	=> '#FF3300' ),
					$format
				);
			}
		}
	}

     // end of WPPFM_Database class
	
endif;