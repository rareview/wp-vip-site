<?php
/**
 * Loader for the plugin.
 *
 * @package WPVIPSITE
 * @subpackage Plugins
 *
 * @author Rareview <hello@rareview.com>
 */

namespace WPVIPSITE\Plugins\PluginName;

/**
 * Plugin Class
 */
class Plugin {
	/**
	 * Constructor.
	 */
	public function __construct() {
		\add_action( 'muplugins_loaded', [ __CLASS__, 'load' ] );
	}

	/**
	 * Loads the require items.
	 */
	public static function load() {}
}
