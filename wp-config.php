<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'gold');

/** MySQL database username */
//define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'root');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

if (isset($_SERVER['PLATFORM']) && $_SERVER['PLATFORM'] == 'PAGODABOX') {
    define('DB_NAME', $_SERVER['DB1_NAME']);
    define('DB_USER', $_SERVER['DB1_USER']);
    define('DB_PASSWORD', $_SERVER['DB1_PASS']);
    define ('DB_HOST', $_SERVER['DB1_HOST'] . ':' . $_SERVER['DB1_PORT']);
}
else {
    define('DB_NAME', 'hairbymakayla');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');
}

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
define('AUTH_KEY',         '9t;L?W}Al7Rn}PzK+hdytAlZ&Z_am#~w:YB!R/fL#GQA$XV?*Ff0ylVZ?=2CoOy&');
define('SECURE_AUTH_KEY',  'EVv-MfYer^Ctt)EQH&T/*-}yU~C- SvlA# [I2dKLMy2n6$&hQ[T)gWkOo{D&n>x');
define('LOGGED_IN_KEY',    '7%!>nm^t4|4!~+~x%7Y`v$B0m{JwQ_wfJG%%#F]Ckf_k9;PAYAPTyO%,@FA%Q{lw');
define('NONCE_KEY',        'hUaon4`N4%%^`TVrm7~o?Cy*+Nd|KFVD#kR.4{|(Wf)`POQ+Gl2w6PX!~tBL=U^>');
define('AUTH_SALT',        'w?E+JTYFH2.$u0r)=Clmd}v4s|xdDfzgG845&g#Ovbyn]Km_e  K1I@|t}e)+ZDu');
define('SECURE_AUTH_SALT', 'N}3VHR>yr@;^&/&o+ce_y(on~ZS!A4rQvw?}ekW)6m_++5;hM+$|V{-l|;pJRwj#');
define('LOGGED_IN_SALT',   'e>o2<}*-m<}^$qtCE>[NI1*|6.5=p1=n--N&[F&||9pDS=4q-hMkT,(L{#Pd>`^X');
define('NONCE_SALT',       'E_#/9QA&kkV2oH;kEsjHn,f861p^8Acotl@D<~7TBy>Cb1vA`/B]S7eOxp$#gXU(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_MEMORY_LIMIT', '99M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
