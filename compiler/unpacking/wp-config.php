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
define('DB_NAME', 'db_name');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '/1#Xj ]&5StGf@;pAy/82`5>Y9W8|]rAEJ~[O&5;HgmYFgRBnVf.vc/=2.Mi1+DE');
define('SECURE_AUTH_KEY',  '~!1NYZ@wF$HG$+[m9iXc|O=to{G?O)J|PJ7$<)i|Hh~`RZ%z9H1%1EoZ%p?;6]dO');
define('LOGGED_IN_KEY',    'QDA-XrB{$q!C[rqL<P,ob9XQt9-6QRH@EMIal=,HuY,Tg@X^@c(G;- -x~7 ssy{');
define('NONCE_KEY',        '/y}+fxKf]6#Vy!IJdUe53%8-3 o+A#vfe~{r{,+hk #|YdgJle%7WXj|?CB=K~X4');
define('AUTH_SALT',        '*E:bBfp7,mY/Maca}-k|G-AFTRz3%UO V]~w.tj]L*S=KUD4_F`f^i6[:BJ8 gbF');
define('SECURE_AUTH_SALT', 'nv;j:x!BG9C>#6JMyK^{M|+ua<:cgS<a::)d!G>[dFSUOc,s+[?7KZ/|]Mzjc:$*');
define('LOGGED_IN_SALT',   'u]e#C&5m>.V~u+n3;BUF*.;LYqqxkd6. f38Ud:e^Fu3=Zo~n -@H_RXk+aUR-96');
define('NONCE_SALT',       '1$&_c,_xs l`d+{7dY*gk8U={!,f0mG=%93|0q}rNmd|=mhZ?6W]?8jzr,@jkFdb');

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
