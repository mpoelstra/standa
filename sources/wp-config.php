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
define('DB_NAME', 'standa');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'u/*GG}34VV-we%0-|L!+$j3:RM&MyqI4ep;ytH8V^enS>)|K5hhZt25|N_xN5o|9');
define('SECURE_AUTH_KEY',  '~@_<oJy:{n&|d}6pif/|0&oOiHT7<UnRum;6HAq[poc{2BJESc>BEg4H=X{Q1yC@');
define('LOGGED_IN_KEY',    'LWfr]#P9t{WZ)*RE1i5^d%zF0BhEb*]9t]7kbYi 4r04|K|+O$o!}4xt6^UPblUi');
define('NONCE_KEY',        '1Wb(A`Bwa]oKukW`tSIhB7vh$QfYx.aRtJ2G,amKwO5x9XB<&hDO8>8.`p5ol/K#');
define('AUTH_SALT',        ',Z?<DK~VFZ4:)s^-2HA9TS:_(>zkdRF*Mjo[yRyhPwo!pB0}!?`>O>;!;B[i_}xp');
define('SECURE_AUTH_SALT', 'jT*LMaaUjsn2cncXbcvfU<Oiemn.zFUX`IhT~EOiNs!Y`u5|X>;2s.}GoL?.j9)^');
define('LOGGED_IN_SALT',   'tHfjF]=:ye?F+Pe,>p8?WjXCRrosY@.+USnDyi,S%P6lfo&]~24$OZ]/+w+dT+4;');
define('NONCE_SALT',       '9$hjMc;}q_Y}iFpmhLOQ`=d3s3NAL/Qdi%`c@,$($Sfxd`[psBN@*%+d|>w(T@N4');

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
