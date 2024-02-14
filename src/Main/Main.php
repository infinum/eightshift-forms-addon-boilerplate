<?php

/**
 * The file that defines the main start class.
 *
 * @package EightshiftFormsAddonBoilerplate\Main
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate\Main;

use EightshiftFormsAddonBoilerplate\Config\Config;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Main\UtilsMain;
use EightshiftFormsAddonBoilerplateVendor\EightshiftLibs\Main\AbstractMain;

/**
 * Main class.
 */
class Main extends AbstractMain
{
	/**
	 * Register the project with the WordPress system.
	 *
	 * The register_service method will call the register() method in every service class,
	 * which holds the actions and filters - effectively replacing the need to manually add
	 * them in one place.
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Hook all plugin features in a custom hook name to make sure it's called after the main plugin is loaded.
		\add_action('es_forms_loaded', [$this, 'registerServices']);

		// Check if main plugin is active.
		\add_action('admin_init', [$this, 'checkAddonPlugins']);
		\add_action('admin_notices', [$this, 'checkAddonPluginsNotice']);
	}

	/**
	 * Check if main plugin is active.
	 *
	 * @return void
	 */
	public function checkAddonPlugins(): void
	{
		UtilsMain::checkAddonPlugins(Config::PLUGIN_FULL_NAME);
	}

	/**
	 * Check if main plugin is active if not set a notice.
	 *
	 * @return void
	 */
	public function checkAddonPluginsNotice(): void
	{
		UtilsMain::checkAddonPluginsNotice(\esc_html__('Boilerplate', 'eightshift-forms-addon-boilerplate'));
	}
}
