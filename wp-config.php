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
define( 'DB_NAME', 'onepage' );

/** MySQL database username */
define( 'DB_USER', 'localmenu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Qb2ug9b3' );

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
define( 'AUTH_KEY',         'FMUc}|@pGp80HM@lLugt)42Q+b)yc9o3%E7j7^CMn Q7Qw6$`yPE8Q5E0:[9TI m' );
define( 'SECURE_AUTH_KEY',  'LP?uFLK^7XOl{yQkIZSgQ!D**z$Mr,MV>VJlCQH3y>0+qOsNi@{Ilh7JzDno]FQl' );
define( 'LOGGED_IN_KEY',    'JBj1{-i9jD)$1ZKP1$fKFi0&.pA/Ov0J}J>K0p%6irX+1x**,6G7WBoQiLhjxb3^' );
define( 'NONCE_KEY',        'iI>YC=o0av?9x66J`}bY0n?5l+Oi}IP~O]2#Zl3utbJc5UG|bj@WqF.c1soVXe$s' );
define( 'AUTH_SALT',        'V(vk9 g%#JzcOmoUcG&YgrB,%0OH`J5/oKaP27AHdN@lECZp*){UmO @5?maP1lN' );
define( 'SECURE_AUTH_SALT', 'Qf>%tU^X`DE/a+5T2zQf<9~PJ N;|J1R`aDc+jRi5-$Vw<%%,t?9sLoE-|>]v3+;' );
define( 'LOGGED_IN_SALT',   '=)1KdfRjY3^;$$W:YU{tayK<GthEo)81NY7<3=&YzX)@oy()W9mbY&7Ky^H6j_lN' );
define( 'NONCE_SALT',       '!2yk,)V}uo9~X}tjZz[ZH#4Mbzd2`9GY:)/9?cQA?11c{+ra65kj*9qXMoc[k~3w' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
