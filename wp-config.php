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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zitronesolutions' );

/** MySQL database username */
define( 'DB_USER', 'zitronesolutions' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Zitronesolutions123@' );

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
define( 'AUTH_KEY',         '0!t@-^d)c&kZW9KoykE,&-&zsA FLHqF(%GpPbnK%g8UB@=B3ymJKzFC1]~Oe1.B' );
define( 'SECURE_AUTH_KEY',  'UQZN:v4SjG-B2oBa|/zycUOUIf#Hk9Gw`m<so)B&:RI~a20m$c{0IPb;i92yi(dY' );
define( 'LOGGED_IN_KEY',    'EGYN?A)3#nugkohG#6Sq|0x)B_MzwKzs`uxa~J1?U54T6uTvj2vT6b! 2MeF:4,%' );
define( 'NONCE_KEY',        '||IzdeB6S6G1dh1rxcu^+u<Z)SQ{z(s0|L[bAH?}FJz;yhdH_^6Jp5wD#J8i669=' );
define( 'AUTH_SALT',        'xtL|9M4lm&+eAy]#`c^4PF<s[Wxv5]3R|YX|3f^5; K0G#ZUJ5]<rwy*#TJ)0(56' );
define( 'SECURE_AUTH_SALT', 'o QTDmZ;e|IAXM<U{o!y4^&mbZxEJ9T3u%dVTc&j(Dl`@U(NYGO24}v]i_JQ3m|x' );
define( 'LOGGED_IN_SALT',   'y?!<kl5a<cp/J@wp7F3:eA1C+X:(,$$,$$4ay{`pjIJlUyP?l:v@]A-$Q?=q>#bh' );
define( 'NONCE_SALT',       'r(uSe6VTfJ+!X~W)b-VeS$nn|lq`7)q8:MwHuJ.X402[1m2|4MHDQ7YKXH!@]EQ_' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
