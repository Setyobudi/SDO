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
define( 'DB_USER', 'ncip' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

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
define( 'AUTH_KEY',         'mh VJ<7<C?Z14`i*u 8s@SgO{a(f<}Ey-G~)10^(0*|Kv~-,)j7QPK[Ym~Z+d{^j' );
define( 'SECURE_AUTH_KEY',  '8,xg2D0w$!OO8vPMh2%|l;Eq>hut^Ck!m.}G8g-UP=OM+D9T|Q]_6G39{5/)^9;`' );
define( 'LOGGED_IN_KEY',    '|F&~qU^onx#U+Y9`>&HZF5^OS{}iKkHQL.%I)7Yb]wsyRvd+8@=R3|g|6ey1!7+n' );
define( 'NONCE_KEY',        '+L{C|vsn7cGs;F|1U2FD%QZn:yS77Q~Mr/ ?}7<DPWb10b6~ED{V9_2a/ZGE$,50' );
define( 'AUTH_SALT',        'A^i}7cp9f&)0a{ $p!Q_zQs<uK~{ElS:hRn.tX06#Q9F-Z1AMc/FHz04:ki1{1Eh' );
define( 'SECURE_AUTH_SALT', ';yo?rJ%il(aWB>JJGIk4*eJ#)F$~B<}^09e; s.2c_$fhUz:.9At}R`&dTh,Yuo:' );
define( 'LOGGED_IN_SALT',   'xl.?|#7]sh4gnCnr+vF6r9-1P;DmM>:D! /*g#XyBlJb?=y[ t9]6$A8!G^o7Hav' );
define( 'NONCE_SALT',       'yJb_;^1hdB{g,B$~_xw9qT$R1xpN8-3yf(J{5fqwtq/S7ga TDS33YZ;:@o([_DU' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
