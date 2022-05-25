<?php
/**
 * WPVIPSITE Plugins
 *
 * @package WPVIPSITE
 * @subpackage Plugins
 *
 * @author Rareview <hello@rareview.com>
 */

namespace WPVIPSITE\Plugins;

/**
 * Plugins Config
 *
 * Static class to get useful plugin details.
 */
abstract class Config {
	/**
	 * Gets the plugin directory path.
	 *
	 * @param string $file File to retireve.
	 *
	 * @return string Plugin dir path.
	 */
	public static function dir( $file = '' ) {
		if ( substr( $file, 0, 17 ) === 'client-mu-plugins' ) {
			$file = str_replace( 'client-mu-plugins/', '', $file );
		}

		return WP_CONTENT_DIR . '/client-mu-plugins/' . $file;
	}

	/**
	 * Gets the plugin url.
	 *
	 * @param string $file File to retireve.
	 * @param bool   $append_client Whether to append client-mu-plugins.
	 *
	 * @return string Plugin url.
	 */
	public static function url( $file = '', $append_client = true ) {
		$url = WP_CONTENT_URL;

		if ( $append_client ) {
			$url .= '/client-mu-plugins/';
		}

		return trailingslashit( $url ) . $file;
	}
}

// Load up the party supplies.
require_once __DIR__ . '/vendor/autoload.php';

// Load the plugins early.
\add_action(
	'muplugins_loaded',
	function() {
		new PluginName\Plugin();
	}
);
