<?php
/**
 * Loader for the plugin.
 *
 * @package WPVIPSITE
 * @subpackage Plugins
 *
 * @author Rareview <hello@rareview.com>
 */

namespace WPVIPSITE\Plugins\Plugin;

/**
 * Bootstrap class, primarily used for kicking things off and cleanup.
 */
class Loader {
	/**
	 * Bootstrap constructor.
	 */
	public function __construct() {
		\add_action( 'muplugins_loaded', [ __CLASS__, 'admin' ] );
	}

	/**
	 * Loads the require items.
	 */
	public static function muplugins_loaded() {}
}
