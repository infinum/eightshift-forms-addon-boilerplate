<?php

/**
 * The file that defines a factory for activating / deactivating plugin.
 *
 * @package EightshiftFormsAddonBoilerplate
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate;

/**
 * The plugin factory class.
 */
class PluginFactory
{
	/**
	 * Activate the plugin.
	 */
	public static function activate(): void
	{
		(new Activate())->activate();
	}

	/**
	 * Deactivate the plugin.
	 */
	public static function deactivate(): void
	{
		(new Deactivate())->deactivate();
	}
}
