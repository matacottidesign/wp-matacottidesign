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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '/T!? I0.f)UQ}].({A7ru,ZcqU9Zd2$n/igrF7{?E~tS9v7{pw6i~/!FfL]1&gzJ' );
define( 'SECURE_AUTH_KEY',   '8M+wIe7SWpfggP%Q1lCUA-f9#qfWe/.tM{F)2qogxeTF&81:_^<ryq,27:?CIl%-' );
define( 'LOGGED_IN_KEY',     '7Dtb.WJ|[s4Tk/J6E_&H^R.$}<k^C-P Va/J}Segj7NYw(|=]l2uy_EQEp1xH3(M' );
define( 'NONCE_KEY',         '1gA`6Ouj_}|}d]~wTT6bQF{ $8EQ%FWcou8cFU|gEOe;hK3jnyfwlZ.n,{z3?5!y' );
define( 'AUTH_SALT',         '7:ipHB4fJ.nK+R;andv*( N7F%C5N@OK9nq_00!t5JApg~&.m/+cU^6<c62S#i+2' );
define( 'SECURE_AUTH_SALT',  '077,UcW0-s5EN6gRu:fThYb^WJZV<`M9(g5~n@nb%,`(w?[Ld##f{sfc(>w~-[.{' );
define( 'LOGGED_IN_SALT',    ')yS@FWWGQLr.E$OxD<U6R6)M~AF}cN jC}TascISu#a{*um8!?5?/ (>.gh|j|Gf' );
define( 'NONCE_SALT',        '=, wN*G8X_]qPI/_Q,uKjcR$85jcP-~|,/ukd;$+hJe&s9#z#5itp*:T87N~diqd' );
define( 'WP_CACHE_KEY_SALT', 'Fzyrr>fs6W6^/[eZDi=8j+PGyo9F#>9,BRH/!DsIPlf;&wSZinH}9&q{$Qr|%H53' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
