<?php
/**
 * Production wp-config template for StarVista.
 * On the host: copy this file to wp-config.php and fill in the values from your hosting panel.
 */

define( 'DB_NAME', 'YOUR_DATABASE_NAME' );
define( 'DB_USER', 'YOUR_DATABASE_USER' );
define( 'DB_PASSWORD', 'YOUR_DATABASE_PASSWORD' );
define( 'DB_HOST', 'YOUR_DATABASE_HOST' ); // e.g. sql123.infinityfree.com or localhost
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

/** Generate new keys at https://api.wordpress.org/secret-key/1.1/salt/ */
define( 'AUTH_KEY',         'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_KEY',  'put-your-unique-phrase-here' );
define( 'LOGGED_IN_KEY',    'put-your-unique-phrase-here' );
define( 'NONCE_KEY',        'put-your-unique-phrase-here' );
define( 'AUTH_SALT',        'put-your-unique-phrase-here' );
define( 'SECURE_AUTH_SALT', 'put-your-unique-phrase-here' );
define( 'LOGGED_IN_SALT',   'put-your-unique-phrase-here' );
define( 'NONCE_SALT',       'put-your-unique-phrase-here' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

/** Replace with your live URL (no trailing slash) */
define( 'WP_HOME', 'https://YOUR-SUBDOMAIN.great-site.net' );
define( 'WP_SITEURL', 'https://YOUR-SUBDOMAIN.great-site.net' );

define( 'FS_METHOD', 'direct' );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
