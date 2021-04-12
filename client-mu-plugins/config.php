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
	 * @return string Plugin dir path.
	 */
	public static function dir() {
		return plugin_dir_path( __FILE__ );
	}

	/**
	 * Gets the plugin file path.
	 *
	 * @return string Plugin file.
	 */
	public static function file() {
		return __FILE__;
	}

	/**
	 * Gets the plugin url.
	 *
	 * @return string Plugin url.
	 */
	public static function url() {
		return plugin_dir_url( __FILE__ );
	}
}

// Load up the party supplies.
require_once __DIR__ . '/vendor/autoload.php';

// 🥳 Let's get this party started.
new Plugin\Loader();
