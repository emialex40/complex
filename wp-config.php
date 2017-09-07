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
define('DB_NAME', 'u12382_complex');

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
define('AUTH_KEY',         '>Hwosy/]V_6Dwg5Vg=d*/dd:P#bWzm}C4p2Z!Nb>KD93HX@m5E|*]s;`r&?f7D#{');
define('SECURE_AUTH_KEY',  'w`18NKI=!Zfd<~bc>G&}k5]MeGbX}V1+JBNdT|t=le(g+)&glqGe)wrrCI^H#mZ4');
define('LOGGED_IN_KEY',    'J-B<Gccr=+$-J2:tB[a!,;)4f)g8eb~>/ebWV%Xcwu~:&LIJTH]>IM2$GR%,=4n%');
define('NONCE_KEY',        '2=6&=cYC:Ss%=[ZqoW/p>6PIf}{EtY@(q,?O?fSn]A[P9r&7u0P-aYrkB[Z59jc>');
define('AUTH_SALT',        '=JIJJ]D~@S-kzIT)OZ==YP&u}tM9@NW`+VF6F4W% t|xet?e8K0kQJdL3Lpkf.$c');
define('SECURE_AUTH_SALT', '1o+`a@$AyBVhuv}bipL)7#1rn{,Sc8mD%` T/`YxbU@`$_UN-wPEH0i_Z.Uc0,V8');
define('LOGGED_IN_SALT',   'RS`2~E&6x{bnt&pTDKb:yL[Xfc L%vGF6@d,i/ypsWW+4m-51!:,w[B-Ir9QJ.E4');
define('NONCE_SALT',       'P.)jz!^n;CYM2B7p%]0a5et`tBn@nH[A+_`J{t%L.pcek>YurS_jK/ NVH1I^ZRA');

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
