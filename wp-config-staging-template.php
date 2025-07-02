<?php
/**
 * WordPress Configuration for WP Engine Staging Environment
 * 
 * INSTRUCTIONS:
 * 1. Get your WP Engine staging database credentials from:
 *    WP Engine User Portal → Your Site → Database
 * 2. Replace the placeholder values below with your actual credentials
 * 3. Upload this file as "wp-config.php" to your staging site root
 * 
 * IMPORTANT: This file should NEVER be committed to git!
 */

// ** WP ENGINE STAGING DATABASE SETTINGS ** //
// Replace these with your actual WP Engine staging credentials:

/** The name of the database for WordPress */
define( 'DB_NAME', 'YOUR_WPENGINE_DATABASE_NAME' );

/** Database username */
define( 'DB_USER', 'YOUR_WPENGINE_USERNAME' );

/** Database password */
define( 'DB_PASSWORD', 'YOUR_WPENGINE_PASSWORD' );

/** Database hostname */
define( 'DB_HOST', 'YOUR_WPENGINE_HOST' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 * 
 * IMPORTANT: Use the SAME keys as your local site to maintain session compatibility
 * These should match your local wp-config.php exactly
 */
define( 'AUTH_KEY',         'b2^ATf^+@R-b#r[!;F KVRb)Rlk,6:Ne=vZ*JN++MB/8?s}4hx@4JPt8wu9-wzsv' );
define( 'SECURE_AUTH_KEY',  '9O/6^-Oq%ok.#%3~Y yPe1G)RI8]i8O(k8<<Qq{-w},?Pvb6;Wv{pt6ORuZ/M!&+' );
define( 'LOGGED_IN_KEY',    'HRK~83td_H#YPe_F|2A#OKv,=72_^?_mO+F9%,nU~Vj$a4C{h{+S}r-+IM`e3$OK' );
define( 'NONCE_KEY',        '=/|E.6TQ5{J8@q29*|vn+Rb7[F%*w&)~&.+|)&mezlu2=en`%k@}3V1O>YIv}Mpp' );
define( 'AUTH_SALT',        'HS;3v_++l[Ds ee:dZx)8U@&S&2$bB5|!%h:|h-i[w_HytB>J$qONk*J.|6:}Q^M' );
define( 'SECURE_AUTH_SALT', '(- oQH!gV/>JXn)zaj]7)p5~bj@)M(}s?:9?E7.4~-H(x^0B?grU@=49DF.2|I{S' );
define( 'LOGGED_IN_SALT',   '}#(f})%QBsz6+wW2zk[uJRhY|rizH|g]}%A^>;EC-,Ky4EmXfE=#<tZDR*`m68FE' );
define( 'NONCE_SALT',       '1[+ZSuTO9q#ipR2;a(AmZ1{[t0}ZC~9[Xw7yWygz;JGT7 _1N3=T.j1-&.,VO;be' );

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * WordPress debugging mode.
 * Enable for staging environment debugging
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/**
 * WP Engine specific settings
 */
// Increase memory limit for WP Engine
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Disable image scaling
define('BIG_IMAGE_SIZE_THRESHOLD', false);

// WP Engine optimizations
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

// Force HTTPS for staging (WP Engine uses HTTPS)
define('FORCE_SSL_ADMIN', true);

// Define site URL for staging (helps prevent URL confusion)
define('WP_HOME', 'https://buzznbloomstg.wpenginepowered.com');
define('WP_SITEURL', 'https://buzznbloomstg.wpenginepowered.com');

// Staging environment indicator
define('WP_ENVIRONMENT_TYPE', 'staging');

// Disable automatic updates on staging
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

// Increase autosave interval (reduce server load)
define('AUTOSAVE_INTERVAL', 300); // 5 minutes

// Limit post revisions
define('WP_POST_REVISIONS', 3);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';