<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** MySQL database username */

define( 'DB_USER', 'bn_wordpress' );


/** MySQL database password */

define( 'DB_PASSWORD', '16af71bb474f0f801ff1b154d40bdc625d8cb1541e71ffaa2d955053f2cfc7e3' );


/** MySQL hostname */

define( 'DB_HOST', 'localhost:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/**#@+

 * Authentication unique keys and salts.

 *

 * Change these to different unique phrases! You can generate these using

 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.

 *

 * You can change these at any point in time to invalidate all existing cookies.

 * This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'x?$.:SEqEo}n]zF&_{nD=e0J#-RLYY<wnTIFEDcy}IsGTb=]*>UZ~c![5T6`0sw5' );

define( 'SECURE_AUTH_KEY',  'nCIoB/zqyoZl-G^+ExIAIWoiW#]wtcahcR.KI@2guN14.C)nS/0nAA$<vf9!x2{0' );

define( 'LOGGED_IN_KEY',    'k%I~?7L6W+3# V;_mF.o *si1ktl2Q]kGpBU:giCrrOKL;.ke`y5iz`-]sf>cSw<' );

define( 'NONCE_KEY',        'yUup|F&z&O%p)j/1rO5;EA6Qhu jG-o28x)irE{Uq)w:0sBF:BwuMfJU__(Vq`wI' );

define( 'AUTH_SALT',        '.[B6<nh~Ig*Bq<Z%`2x=dX|M3=WU!lUlw#1rYbxAkV!V;gISYoZ<|!`wy882n7gz' );

define( 'SECURE_AUTH_SALT', 'p<>|4DmUy--2-hb~q,^,KKTmE:>:uU-P`;CC$$G/!xg5RiY$eFxs^0ttBkd[com>' );

define( 'LOGGED_IN_SALT',   '74xZf[%LzR=nKe3wWv)ZeO%n:-l9Ii<D9f!MC{:}vuDDWaOi9<<1c)Q`^qXyzx3o' );

define( 'NONCE_SALT',       'C)3nCa(!6G?j?=kM1GBRzkJD%HL*mF+:E{XQd!91Bwg<RglS;6J3hhN9<>C/1V4s' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';


/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
