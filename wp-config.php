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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\confiturecocotte\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'confiturecocotte' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '3@vSgW{R6Iq$/@{FDKN4|$]<Z%?q*_}Rb?U[gyqEfbLH;!h*fnJ~.<wa|{! ]Pl@' );
define( 'SECURE_AUTH_KEY',  'b<_M$R;z ?jzNIU@a$`^@Mw3oB://q8w%Xa}`jcJlo@vEK`/~q`5]&F)%@BztIes' );
define( 'LOGGED_IN_KEY',    'qf6H:3HP/PNXT2* =xs<Dl[EbunHU_;SvjqN?>)7^W]]5}L,)i6>1H_>i=rWazvY' );
define( 'NONCE_KEY',        '.]7FQGS-[zMtjyDJJnBanhR$~4ZL55xQ_2sxc#|+tM.g{8CP8>wxLX{RBXDcw?U@' );
define( 'AUTH_SALT',        '!xZKyB%,<g;n_BTD`a/I+D?zHOW7 @UT)ugK|)B7iBbmmx`uLebQG/A2xF,9{v42' );
define( 'SECURE_AUTH_SALT', 'Q#3ER7kitdXF4+sT:lFCH-3D~W$b.%quF7i.s!i@Ubv^#Kk&O,KiLx2~uJ;SLl]?' );
define( 'LOGGED_IN_SALT',   'Ix%,UmXB`l=iwPh(gFkTT=:H-T&12sK_GQK=qqAW Q-iWgW:&Ur7YU:p^I-)l 75' );
define( 'NONCE_SALT',       'GZ#cV=a#={%sdENVBB;WAp?_(a:~e3}RSU0~?jNP&*t% pU(9l*H{Hk5rgRr3pKb' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
