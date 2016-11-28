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
define('DB_NAME', 'wp-vivirplaya');

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
define('AUTH_KEY',         'j_?3cHQ%e{9?=M^O>.?[_~n]k?!!(oyz0r-MQ[>bD7S7z=dt `j5 1_9[uY9Sn_F');
define('SECURE_AUTH_KEY',  ',%XICy[Gf|*kWGncV,Fv:BJhfqVR aN y$zI2@*.XtNi;TZjfVP[=-lpHzr55Bf[');
define('LOGGED_IN_KEY',    '6!MTg@uaHk#+3l#x5/m 40%T;E,(t%5OstJ+GGv{]c+sbp9FIf|nRi]<%JH@;e/@');
define('NONCE_KEY',        'L9NUhn^6L)7K(h]M,nqv%Wg+{ilr_oCU[f_T9o7 [k^7i#81Db;k1SO4U$,#$yNK');
define('AUTH_SALT',        'aw6pYuye%b-/ol:DAQWFr(BO.W-C79 {PhqNAt6r;66~YxVi?]2PlKOEP<QbSMW$');
define('SECURE_AUTH_SALT', '8bM#?%5lMf=ZLo4q6-)$pXj}>j&{xj6 9OVF[4xD@m!h.o!UR}$Zkwg~a.*aOfh9');
define('LOGGED_IN_SALT',   '7R|`dA/^sKyZbU=}zO0o%]<VK}F51|AR?JHfV1H@`N/4`:/%/N_B6<II6VrPH]Kj');
define('NONCE_SALT',       '~6(W994+s};B /bbRdv(0(?Ll8zIW7|+;q3zY{v5J}-}e]i1w0QPLF}[gmv `=W!');

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
