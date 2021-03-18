<?php
/**
 * VIP-Go specific wp-config.php. (not-namespaced)
 *
 * @package WPVIPSITE
 * @subpackage VIPConfig
 *
 * @author Rareview <hello@rareview.com>
 */

// Redirect WWW to non-www domain version.
if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
	$http_host   = $_SERVER['HTTP_HOST']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$request_uri = $_SERVER['REQUEST_URI']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

	$redirect_to_domain = 'example.com';
	$redirect_domains   = array(
		'www.example.com',
	);

	/**
	 * Safety checks for redirection:
	 * 1. Don't redirect for '/cache-healthcheck?' or monitoring will break
	 * 2. Don't redirect in WP CLI context
	 */
	if (
		'/cache-healthcheck?' !== $request_uri && // Do not redirect VIP's monitoring.
		! ( defined( 'WP_CLI' ) && WP_CLI ) && // Do not redirect WP-CLI commands.
		$redirect_to_domain !== $http_host && in_array( $http_host, $redirect_domains, true )
	) {
		header( 'Location: https://' . $redirect_to_domain . $request_uri, true, 301 );
		exit;
	}
}
