<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', 'C:\Inetpub\vhosts\Host\htdocs\WP\wp-content\plugins\wp-super-cache/' );
define('WP_CACHE', true);
define('DB_NAME', 'WP_SILVIANA');
/** MySQL database username */
define('DB_USER', 'sa_WP_Silviana');
/** MySQL database password */
define('DB_PASSWORD', 'adminWPSilvi*');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*v@prXSR*TqBe8tx4BbIPkNMlM0laJ3qrnKfl9kWLYHBd8JJYwRhhUCx&cUg0a3O');
define('SECURE_AUTH_KEY',  'ta4I*L5LV1Xi899nzci*SJVFoytm%mUOV1rur^evV8ExzsnkkCf4FFCloDvxyz9a');
define('LOGGED_IN_KEY',    'd%dv9(d9hBQY0#^V3Z24kjv&IHgHDbZ%xdNjpo!2TS58GZTi0GriD5cmzmXtO*lh');
define('NONCE_KEY',        'cxZghczFTd@B8y*6*WVHQXqRsEqtlJt1WFJJ462fctOINeCk)RqzruH2vNE)*OdE');
define('AUTH_SALT',        '2#sfvzTB8CnscbhRxulzq3paJqaW2FPHYf3&5(34%sVJ5DPSVXrVrb1Nzhea76oN');
define('SECURE_AUTH_SALT', '!vVr86l6@w#XT76rRM6C4dCJu4DGWxX2NMZBfRq#27OJ02&P46EFFG0fLHdlx%2b');
define('LOGGED_IN_SALT',   'xz5Z%o^RU#H(XVjsRGXr@Gr*8ZwmCcJwcMTQMYs66*S0@0@l!g%7SI6#QcU@lpPK');
define('NONCE_SALT',       '1mXqpm4%IJK)^)&d@Du*C*ptz^gfOeiuS5FQ)3fUEybCvCiSJTzqkVt3@@L*28d9');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'duR7x_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define( 'WP_ALLOW_MULTISITE', true );define ('FS_METHOD', 'direct');
?>