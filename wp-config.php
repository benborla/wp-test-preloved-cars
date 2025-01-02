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
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress_password' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         '@?]3k^3[t.~z*& C;?JENjI}EwYY#Az[XDq@5rkpRUjni0yow4MKy:J.}Ppo@QD)' );
define( 'SECURE_AUTH_KEY',  'hT8F|9A4c&|4a1ckuv7f*:WmIWGM>KkpZ4T93l@3,,4Bc_i;=B=.z~^mzNzbP5L]' );
define( 'LOGGED_IN_KEY',    'wi7}lu#B2)g]K-Kl6uwU== 1ZjP40$>!Dxmg9EZG9nMt;A;xzosBLhPdEIUBiv_N' );
define( 'NONCE_KEY',        ';%|F![k<X|g8~gb4p9%G:;}H4F>jkevH^r9EM.sV!s?(%Hgi{3!sN5xhWxEw.&i,' );
define( 'AUTH_SALT',        'pvA0NRzwe#a~X.SS. y,@GdMgYa;NTCrE%K;Z-b7G(y2e-km?>yHiLfUXSpG0luw' );
define( 'SECURE_AUTH_SALT', '>g:B{c5x(frX%2V7C5)Dr)V)xhH=zh<V,WZZ#OO;j` @PMJ%v,+ZB9Jh=ges+^1U' );
define( 'LOGGED_IN_SALT',   'e@eU6y*B2}--h-jYvH7!1.BAutdk65,i[HiyK6J1PPwA^}B,%O_&4E!me0j:NA~W' );
define( 'NONCE_SALT',       'c;j*HhRd4:74T0DnXp&b!`;ih-6+)h%TO(Y%%m2<vC`HH8L3#J#Z]_V#(BlFesA>' );

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
$table_prefix = 'w';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
