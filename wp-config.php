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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp01' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'dev01' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD','direct');

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
define( 'AUTH_KEY',         'yIC=N{cR.J@)POn9uPPU3[v-a7hhjw<a1wB*Vj>BV5cjp!x@u$^~d(x|]<eq6fw+' );
define( 'SECURE_AUTH_KEY',  'N^j>;0^<IW#~TCf~JXu)FhtZZ^[,%0phwnv6o 26^`/3D)Sl+!0+4P&>kd+OcDIV' );
define( 'LOGGED_IN_KEY',    '8l7u&jbb(}ul.S$jn3uTnA#<ZM`_0$WNO7[S5@BN_%Ln_YvS8B^WwgQCG2h)e5~y' );
define( 'NONCE_KEY',        'Z6v*dIiV5!/4`7]xrTg75 Ib[t+V<V&wu;@Q&Dev(:&R~NQ&l#vwgAgacK7m#p= ' );
define( 'AUTH_SALT',        '2WGHW5m1vU<f4|}j%aEC!46u;W^aJG3>|eO2q/!Cuy78TqVs<nTCI.4cL893?VD!' );
define( 'SECURE_AUTH_SALT', 'g]m*r2+RNih3!ch^rX^V<tA~0[M&NuJpmTb7&@n;T6cZVBG&q#vc^xG-t=uBJ.7_' );
define( 'LOGGED_IN_SALT',   'R~)Kl7NP1~9M^$bg{y1@O-H,I[oTk@tCy|G~H*D/us2`to;wI];TY&&Fn_1uPpGs' );
define( 'NONCE_SALT',       'FS}kZJXBqCysceo7~OI#W6R.Ju}K+hb3P#s2A<hKC~H9J=Fc{T}@7H-,aP S_b_<' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
