<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'NU>h!Awa-Ddl{:C2`+f}15Gm|g-YEu30b5?R<K_q}nEsFto@,IKGV)5xs>bU4Qgs' );
define( 'SECURE_AUTH_KEY',  '_rA|sm4e9UJpMtb|SFuY]s]c%O0o]?K};CJ&(ttbKWVS<t!0heTG,Ta}gg1s`LLf' );
define( 'LOGGED_IN_KEY',    '*FO&HAb$:?C/1/,LxB +NUrYS;Y=@A#tq@(Gz)Mdd;{#?F*OgtR[&+Q|KvKo6$K=' );
define( 'NONCE_KEY',        'qZcZI[q%9Ne*9e)#uZJQ!U1?7N|;!erFz*|o#%pbZ[Yq@.m]=2DEZtB)yimu`O*g' );
define( 'AUTH_SALT',        '0T&Psoh|T2=t8FeNC(G%|JL+AN[=)B-&[]22ndXQhd87fpSIc8Tz&{5d;TWy^?o-' );
define( 'SECURE_AUTH_SALT', 'M:ARi%xu2^RF4|a[QRq_%BkyA_xNaIvV_p-vz!Z$ke5Sp&>qZ-1!M3ZXCY]H>7l{' );
define( 'LOGGED_IN_SALT',   'Wb9zh|~LJLY%*OMb?zF@#b l]:e{g;vCl^6BdQ~=dBnNC-^-{$y{!Yn/p7xlPfBf' );
define( 'NONCE_SALT',       'WOCmZiz4g(+#::ch7NU+i~[<WjH6( ZW}E5 ~_X30/1^8s 9W%8)e7ovDc)LwyXa' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
