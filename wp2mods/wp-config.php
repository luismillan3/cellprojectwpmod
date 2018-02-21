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
define('DB_NAME', 'wp2mods');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'pNt%k6<??U@Vjr` AcDn*2^@Dq$j}y|w[+eJx|@1g`]p!Vv`;vq*j6@u?V&Ae`*1');
define('SECURE_AUTH_KEY',  'K^RTvXU,04uljx7UU+U$kyj#3P=v9i%*Z@WgZpA&3-F=N9`H|nPK$FLM3@s:H,NW');
define('LOGGED_IN_KEY',    'z<z5<5$.}GwvaH6)N$DR|DpMvGjXTJw%|s{g.&6$q24szdy|=jakeQY~]8uPSK`7');
define('NONCE_KEY',        ':rwXu~{2SX8~.fNdMBv,D=?+kUc2Q,or/79+r=*Keb/VX&-mV(__R+XB%F7|e!_[');
define('AUTH_SALT',        'q`;S56]3ls>hiY/~J#X8T|g&]HCK+z6>O_4 Wm9xdn?s^=ks*RzQ]=A7=`fu5(Dc');
define('SECURE_AUTH_SALT', 'pFE_b~DN85s<y!<,fdfLF,amkGqzP HeX&&D`F$+?@l,%74UQkkc5#vL/0K#yVq$');
define('LOGGED_IN_SALT',   ' rbIqK>,i:g7iTky#pgk,ug5Uy`[)6+a(}? #o(:.GDMaS#H~H=}z-[T0:UX[3?I');
define('NONCE_SALT',       'CF$g&LVkz@Z&`9ZB#f<Tb!D G$[/-h8Ruoa(s%CrVscA=6qie@#[?J^HJC>IDB<h');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
