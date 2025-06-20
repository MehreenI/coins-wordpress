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
define( 'DB_NAME', 'wp_api_coin' );

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
define( 'AUTH_KEY',         'F8Y3!U+wsh_QT|KLfN`Hs*x3c+Utivm%!]@ R34ZJve44cpa7vP<M+4Q#, ^2F:f' );
define( 'SECURE_AUTH_KEY',  'U)9).h7mB7B(Cf4WS}_B`}XL;2BJZ-2jM5yVv0~;HfQiI>st33q_&?x+pbo1sHBu' );
define( 'LOGGED_IN_KEY',    'FZcnCVD*U-&LT-}ie|tqDI;*uDaAbc{)Mj!OKOn%G>dE]QFQ[4|fm/5d?qThrl-S' );
define( 'NONCE_KEY',        'W)muYvBG`d@p!L*VjkqM|:Ve#{W,*-:=wvj$AF$!)]t:S@~(d`Jvz+N,L_1gd#$F' );
define( 'AUTH_SALT',        '?Nl/T%P7OdWN?yG/$(Ucg?n,~Hjxl0#Aenvx.ozqX&!]p$9C+;Ee%f`i]|m|($A~' );
define( 'SECURE_AUTH_SALT', 'X|YZVF$EOTvXn|p/6M- !.G76<7RC]gH~ThtsBpV5?uCqZV:Zd*sR>I386kG=8B-' );
define( 'LOGGED_IN_SALT',   'F4X.pPcMC63lY>.93QRHLJg^twwo.zR0&3&/#<H^K@B.NQPU6d-[,@F9R6$l[4is' );
define( 'NONCE_SALT',       'LZ|}6ui@&~X>+<.%7>dnESL#4ftj.-HM{m!4qD[Uyb5;|~^`#@wKXi;N1/p-|rw_' );

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
