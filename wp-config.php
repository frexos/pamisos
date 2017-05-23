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

define('WPLANG', 'el_GR');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pamisos');

/** MySQL database username */
define('DB_USER', 'pamisos');

/** MySQL database password */
define('DB_PASSWORD', 'p@m1$0$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2PX|$w}Ac{e8(Jmmt@Y>JeGxj~k>|X7lw+sVV0dRNtH7A{/q!PN` >1P`UL]=9WQ');
define('SECURE_AUTH_KEY',  '58Y~YjGi:n}62W78AYx=8$Y4Kbq7Q6?PgLuNmfA,cEdVw&(E3Vl3O6}cJi+oI>mM');
define('LOGGED_IN_KEY',    'EYp@QNDyA3[?tLlKaq!t30Q8-?F@,Fes|{J}UCSAOR1wvueUf~La Yi^Ui>y3;!N');
define('NONCE_KEY',        '`C4bQ,fy^TXep!o_L43)~Vc(dP A6_aKg|twq#Uy.X`Ap/9J4ML/@B.4*aRSS $l');
define('AUTH_SALT',        '2/mP{TUwYWQ#$9MkzH&[-Jv67mJ<6])1rEOh{irj&.8QU6dl+::zUUZT-p}T$vu(');
define('SECURE_AUTH_SALT', 'RT:*f:foWI[)-mTc;vOFMx=!A/Xo@44lvL/onk>i~9xqePsFRa1[+Yc@ZWCI>?I[');
define('LOGGED_IN_SALT',   'fTRw-%<WB[8L.hW>S)b hJ-cx>fnz 5YNsy6eD3DFJR-Q0IeOY[D25hF4JVy$.0[');
define('NONCE_SALT',       'o}8h@5UU-1!Zv<QrSErP).4@PXLugyWp) lIE[MxZI>|U12P%9kZ8H{F@+K!QuU2');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD', 'direct');

