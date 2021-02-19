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
define( 'DB_NAME', 'lawyersinventory' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'e`(gI,-`-6DJiejZfv5fy=q$2x[;K[B>F$dRkOE+]j$Cz1A(/C?wOd:stgs4o#u@' );
define( 'SECURE_AUTH_KEY',  '9/PBSQ9+O!FJfL`X4?{d*v?1wt2;}kW`(4ku{!Z;4qo47 LIg>dHOb`IEDT-HuSq' );
define( 'LOGGED_IN_KEY',    '[zX$+;+2lp!VK03gum8Uq7~bn{@?|19[M-EsmS=Q9xnr4J:28SK]!G4B&25A]2e/' );
define( 'NONCE_KEY',        'r~OjT[f/_j2BXR BvRn^w5422STN-z#WZ8Fb?4gIlkecl(|-M)I&ga1nxPd|#krG' );
define( 'AUTH_SALT',        'UmQ X:Lz3^6=F2nT^z<VRx_pMke Q0pc_)88`%N)x4-0N9o1]|5.PoLIO({+E0Ha' );
define( 'SECURE_AUTH_SALT', ':cbD_{9!ggEHp+.*,fFP>7!,`.WTI^fc,|B`6D-O[0{$1W4PuOXCYo]IGe~m(by7' );
define( 'LOGGED_IN_SALT',   'H1[f`UV5R*5.1{;14,F#ZqZC*OD-2fj_U(VZ2{uQdowK8m#{N<=TzHHwRC,M9A1t' );
define( 'NONCE_SALT',       'lkO~=p/gZR}(0Q?%j$nqzMPDBjs<0Bs:<mw2vJll7s=fiLXAg/{Z6hzp_?zBI]sh' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpit_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
