<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bearswordpress');

/** MySQL database username */
define('DB_USER', 'wpbear');

/** MySQL database password */
define('DB_PASSWORD', 'skatehard123');

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
define('AUTH_KEY',         'V,hr6M}vs8{&yKeIvV;XHVbm79C|{TYb!hlK*!$YCh$uOK-Bs~PkYS}QdNdgejwP');
define('SECURE_AUTH_KEY',  'V^41i!JD)%E=,I/~8G0(+)/U{Rez2^;7B;Dn;gu=I2.[;/2%Kf_LUeifUEHq0TW_');
define('LOGGED_IN_KEY',    'vZCZ|)SRn|*Pr$h,fO=;$`mZzv(CVm`wTGq{Rox^O4B<z/BUS=bkBUgQp/f=3d2^');
define('NONCE_KEY',        ' %)TcKx<]R|(2YE!%(ArIyN|]E;1nWS@Jv4MvQgZb#4gUa3/=tV>?9JR /%5%,i0');
define('AUTH_SALT',        '+iqTj2b5$q$}FAhD[lrYpmT>KgFgx[UD{11-9r!TrhWbTMLaNKr2XwY[HX[ic1A!');
define('SECURE_AUTH_SALT', ',<A@c2,l>M8m%!aGHTxu+HWwsInp gtXw6WF33GLy*<N<@nV/lC_R3}fp__wh_Mx');
define('LOGGED_IN_SALT',   '=xI3g(y$ _v~l4+book@D4/k9sh7-q/e=x<2_]n0|;`obt`|!hfNNYu#Ya=4&^jS');
define('NONCE_SALT',       '`RveeG~vL@h25!$><(HX:N[53Sk@b[b5A(F+eY4kZ1kNwU{;1_*>!xbPVO,M8wLg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
