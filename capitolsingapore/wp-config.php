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
define( 'DB_NAME', 'capitolsingapore' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ',*Vu1p[c9#_n`Zj&X,cvQ/ThyPoc>qjY4hNVG)56+(9f1[y[E1xYd/3mvA&4H<<H' );
define( 'SECURE_AUTH_KEY',  'LG`CADtkiBfEEFaA:/eXTXY8CamhY:iEd;7eSKlr8|D6(Yl**AV.xfY2+cGg>q(c' );
define( 'LOGGED_IN_KEY',    'vrCW4A34Vuv0Taz.( ^%^IWd>&K:1.RRs,VDD`@`9HBo8K7}{9r^Y2f;AdsJ4l<D' );
define( 'NONCE_KEY',        'X-e*2Or6zF65jQVR{AzTM_$6lcIEZ=zPHWX85s8R|tKD=_.5k;x{MfEU^ME-M6?;' );
define( 'AUTH_SALT',        'sOvX-pAlt+7/ROgKt5RoU2pMeV-oK1+syet&t~tF/CYFZoK(^Hs;Fdl3:C>%bK+R' );
define( 'SECURE_AUTH_SALT', '{Xvg`xE+bGBNX/:ILE>GEnK`W,h/tN/@o(?2<LCO@#_ oKF<Pk4%_CR&X/N5;Wn7' );
define( 'LOGGED_IN_SALT',   'L1/Shsi&i2}%f&:G|]IAm& Ct$A_r|a~4dU*PSm(,cPBtcL)5521nk-J_^2VrMva' );
define( 'NONCE_SALT',       ')vn:h$b?)6LuV_D_(SSk~m]l-=@j&S/2k0_IH,t7d!5UFR00t_N*44~SNtsNU @f' );

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
