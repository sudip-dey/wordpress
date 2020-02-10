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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@eBWOk<sbf{4eun_0Bh7%ZPuXgH][[^fN8*.8fE9xac*o``=zq~4rD>m;Q1nR#mj' );
define( 'SECURE_AUTH_KEY',  '|$Lb89Mr~0ai%9,u}UWzic3Z(3l1+u]TBInTWyfJH-(YOiP*~62eew4~8sgL#Gos' );
define( 'LOGGED_IN_KEY',    'F;9sue>E=M|k(%S4oyC0g2tu U~T}1U2!Axs.Tp50e)wkScsN/*D=vlDT/%28}pl' );
define( 'NONCE_KEY',        '/8GN0@P@]omR>1PYswpf=ZT6PVS/vx%$vB9h:fRZ%g(lH2de5FSrlbe/i.Ne9$~K' );
define( 'AUTH_SALT',        'j=MMZN:D[cM>c4v`9hP$,X`IQ^:MX$1?*%01+xk1xYV*w!m5Y`k1[<zMs)=ou]Ng' );
define( 'SECURE_AUTH_SALT', 'G^NTTQ4o/Z,@YB&pg_1Q5;`g|ndR1G}[vD2Y])U$iS7P849ZeGZ^tmHv!]r.y)ph' );
define( 'LOGGED_IN_SALT',   '[V9/xw<z7o0cy$ |**{spyhG!(/yd*Vjdo}BvhfU^4dL$g_G5zzC&v_Q%#xyVJlo' );
define( 'NONCE_SALT',       'G}H;B~-fOv==Em](*_Tg[0V,^2_zdrU--SfDqZ5=bSS3T~h+]hTXwH*i]>z;Vd!~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Multisite */
define( 'WP_ALLOW_MULTISITE', TRUE );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/wordpress/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define('TWO_FACTOR_DISABLE', true);
