<?php

/**
 * The file that defines config details for the plugin.
 *
 * @package EightshiftFormsAddonBoilerplate\Config
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate\Config;

use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Config\UtilsConfig;

/**
 * The plugin config class.
 */
class Config
{
	/**
	 * Plugin slug name.
	 *
	 * @var string
	 */
	public const PLUGIN_PROJECT_SLUG = 'eightshift-forms-addon-boilerplate';

	/**
	 * Plugin folder name.
	 *
	 * @var string
	 */
	public const PLUGIN_FOLDER_NAME = self::PLUGIN_PROJECT_SLUG;

	/**
	 * Plugin full name.
	 *
	 * @var string
	 */
	public const PLUGIN_FULL_NAME = self::PLUGIN_FOLDER_NAME . \DIRECTORY_SEPARATOR . UtilsConfig::MAIN_PLUGIN_FILE_NAME;

	// ------------------------------------------------------------------
	// FILTERS
	// ------------------------------------------------------------------

	/**
	 * Prefix added to all filters.
	 *
	 * @var string
	 */
	public const FILTER_PREFIX = UtilsConfig::FILTER_PREFIX . '_addon_boilerplate';

	// ------------------------------------------------------------------
	// Manifest
	// ------------------------------------------------------------------

	/**
	 * Plugin manifest item hook name.
	 *
	 * @var string
	 */
	public const PLUGIN_MANIFEST_ITEM_HOOK_NAME = UtilsConfig::MAIN_PLUGIN_MANIFEST_ITEM_HOOK_NAME . '-' . self::PLUGIN_PROJECT_SLUG;

	// ------------------------------------------------------------------
	// Enqueue
	// ------------------------------------------------------------------

	/**
	 * Plugin enqueue assets prefix.
	 *
	 * @var string
	 */
	public const PLUGIN_ENQUEUE_ASSETS_PREFIX = self::PLUGIN_PROJECT_SLUG;
}
