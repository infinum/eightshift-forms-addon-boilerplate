<?php

/**
 * Plugin Name: Eightshift Forms - Addon Boilerplate
 * Plugin URI: https://github.com/infinum/eightshift-forms-addon-boilerplate
 * Description: Addon Boilerplate is a plugin add-on which provides boilerplate for creating new Eightshift Forms addons.
 * Author: WordPress team @Infinum
 * Author URI: https://eightshift.com/
 * Version: 1.0.0
 * Text Domain: eightshift-forms-addon-boilerplate
 *
 * @package EightshiftFormsAddonBoilerplate
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate;

use EightshiftFormsAddonBoilerplate\Main\Main;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
$loader = require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor-prefixed/autoload.php';

/**
 * The code that runs during plugin activation.
 */
\register_activation_hook(
	__FILE__,
	function () {
		PluginFactory::activate();
	}
);

/**
 * The code that runs during plugin deactivation.
 */
\register_deactivation_hook(
	__FILE__,
	function () {
		PluginFactory::deactivate();
	}
);

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class)) {
	$sep = \DIRECTORY_SEPARATOR;

	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}