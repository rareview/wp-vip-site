<?php
/**
 * Config file used for local development.
 *
 * @package WPVIPSITE
 */

// Set a default local host, is one is not set in the server.
$local_http_host = isset( $_SERVER['HTTP_HOST'] ) ? filter_var( $_SERVER['HTTP_HOST'], FILTER_SANITIZE_STRING ) : 'wp-vip.lndo.site';

// Connect the local database.
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'wordpress' );
define( 'DB_PASSWORD', 'wordpress' );
define( 'DB_HOST', 'database' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// Always debug in development.
define( 'WP_DEBUG', true );
define( 'JETPACK_DEV_DEBUG', true ); // phpcs:ignore WordPressVIPMinimum.Constants.RestrictedConstants.DefiningRestrictedConstant
define( 'SAVEQUERIES', true );
define( 'SCRIPT_DEBUG', true );
define( 'STYLE_DEBUG', true );
define( 'COMPRESS_SCRIPTS', false );
define( 'COMPRESS_CSS', false );
define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Define the local environment.
define( 'VIP_GO_APP_ENVIRONMENT', 'local' );

// Respond as if we were on HTTPS.
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$_SERVER['HTTPS'] = 'on';
}

// Set SSL in admin.
define( 'FORCE_SSL_LOGIN', true );
define( 'FORCE_SSL_ADMIN', true );

// Set the site urls statically.
define( 'WP_HOME', sprintf( 'https://%s', $local_http_host ) );
define( 'WP_SITEURL', sprintf( 'https://%s', $local_http_host ) );

// Automattic Must Use Plugins
define( 'WPMU_PLUGIN_DIR', dirname( __DIR__ ) . '/client-mu-plugins/vendor/automattic/vip-go-mu-plugins' );
define( 'WPMU_PLUGIN_URL', sprintf( 'https://%s/wp-content/client-mu-plugins/vendor/automattic/vip-go-mu-plugins', $local_http_host ) );

// Set Memcached server defaults, used for object caching.
$memcached_servers = [
	'default' => [
		'memcached:11211',
	],
];

// Require VIP specific configuration.
require dirname( __DIR__ ) . '/vip-config/vip-config.php';

$table_prefix = 'wp_'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

require_once ABSPATH . 'wp-settings.php';
