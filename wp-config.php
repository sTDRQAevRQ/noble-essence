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
define( 'DB_NAME', 'noble_essence_wp' );

/** Database username */
define( 'DB_USER', 'noble_essence_user' );

/** Database password */
define( 'DB_PASSWORD', 'EzxxFMZUKhdysHbdglAydFw9' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         '1S8B3-:4A@$g{w(=Hk@?O3g1fksWk??_?sh-J`WUYgS5X&61Bv;|lP-FtT,+>]EA');
define('SECURE_AUTH_KEY',  'Yv?(m)G/`pWmTB4&T_}>yX+-rkmy>)Uc%SC3o}/4l[9w)MliTdI*L%iQLlLgy%%V');
define('LOGGED_IN_KEY',    'D`jR@k.f@SeVAWcp{cRu|Si},b-)8OCgGJ`gu71#_XZP|o6G -0H{PB#-jt&d/k=');
define('NONCE_KEY',        '5:cE_{^nL&=,?,4c&t&gSv(?*,+;6[/G%W+vf  A2/spepakk.:- V|@o!A!yV7b');
define('AUTH_SALT',        'B_2G{c{W44@i$E,^- BhNXD}R B%4Iw|)Bx-DYW|;nL:K^)&^Pr+Mx>%Qc0vo+d]');
define('SECURE_AUTH_SALT', 'sCC*55w;Y)tI2KGfxN1qsp5;q*-EK#9zQAdL)(4{jk*/Y]Vjk$}%/.v|:+dggyq:');
define('LOGGED_IN_SALT',   '*Ol~oj-%#imZt;M)PsXCz9t![=J.!-e`yGYP{WZ+!X]|^q+--k+KD9Je~CskH+[6');
define('NONCE_SALT',       '=~^<Xwj+[z[y%rR<;6^}5Ftg|}Tcz9Ib ), $ZoU]vphAr+Z6C|v-%JVe_q5b[Ua');

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
