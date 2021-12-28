<?php
function docker_getenv($varname) {
    // Docker places quotes around a .env variable, we don't want that shit
    $envVar = getenv($varname);
    return $envVar? trim($envVar, "'") : $envVar;
}

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
define('DB_NAME', docker_getenv('MYSQL_DATABASE'));

/** MySQL database username */
define('DB_USER', docker_getenv('MYSQL_USER'));

/** MySQL database password */
define('DB_PASSWORD', docker_getenv('MYSQL_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', docker_getenv('MYSQL_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('COOKIE_DOMAIN', getenv('COOKIE_DOMAIN'));

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',RswR7:v1MtZ|Xz^#y|I+U2w*<8>Ljl@&D?k`Z-5T{/lnSR@d+,s8OI%QM Lp-Oo');
define('SECURE_AUTH_KEY',  '94C[,YSzmw-KrJfC4d+BmAJL<3H}YvjvU-?XG9-p67?JD4y|06<:*zO|>J60(tG2');
define('LOGGED_IN_KEY',    '*p)tXdJ@o!2Hp6EJ[[yP`DV14SyesqaE$P)c}PmE-KGALsPAM[uT[ncM-5?dw;;s');
define('NONCE_KEY',        'LIv}ge+?zj`fzM{-e>HY#kjSXc{umOT^C-$l?bi|pHu8-v(6xt{l.xc+-SA)&Oh,');
define('AUTH_SALT',        '6FfilS-6WRUj%yR;=87`~2F`a>?YC+;R4:@fHj4{s=?Lck3hN/S*#OXPUi8F:YII');
define('SECURE_AUTH_SALT', '+5>n7z>z+ts<_m %^D8@$(-JAvD3y%>oT%6 rc[mo{7xL]`BJiOqVK?9 {<E&S,y');
define('LOGGED_IN_SALT',   '%l@mEmQ8J|i7 C8w`R@+gzmy+q-O(|-rz.9@@@S#1_-{+w#N_iG4/;&3-|jW*2#?');
define('NONCE_SALT',       'Q&nAn1# z[OQ&UtXJ!v|*r.+!K*X=?r^:2]kZEI`C^<Z|Nh-&p|!m|T*!B`%?E=o');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

if ( docker_getenv('ENV') === 'production' ) {
    define( 'FORCE_SSL_ADMIN', true );
    define('WP_DEBUG', false);
    define('WP_DEBUG_DISPLAY', false);
    $_SERVER['HTTPS'] = 'on';
} else {
    define('WP_DEBUG', true);
    define('WP_DEBUG_DISPLAY', true);
    // define('WP_DEBUG', true);
    // define('WP_DEBUG_DISPLAY', true);
    // ini_set('display_errors','On');
    // define('WP_DEBUG', true);
    // define('WP_DEBUG_DISPLAY', true);
}

// // If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// // see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
// if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
// 	$_SERVER['HTTPS'] = 'on';
// }

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');