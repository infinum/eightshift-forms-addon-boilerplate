<?php

/**
 * Admin menu top bar functionality.
 *
 * @package EightshiftFormsAddonBoilerplate\AdminMenus
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate\AdminMenus;

use EightshiftFormsAddonBoilerplate\Settings\Settings;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Helpers\UtilsGeneralHelper;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Helpers\UtilsHooksHelper;
use EightshiftFormsAddonBoilerplateVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * FormAdminTopBarMenu class.
 */
class FormAdminTopBarMenu implements ServiceInterface
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter(UtilsHooksHelper::getFilterName(['admin', 'topBarMenu', 'items']), [$this, 'getTopBarMenu'], 10, 2);
	}

	/**
	 * Add top bar menu form items.
	 *
	 * @param array<mixed> $output The output array.
	 * @param string $prefix The prefix string.
	 *
	 * @return array<mixed>
	 */
	public function getTopBarMenu(array $output, string $prefix): array
	{
		$prefixItem = "{$prefix}-boilerplate";
		$output[] = [
			'id' => $prefixItem,
			'parent' => $prefix,
			'title' => \esc_html__('Boilerplate', 'eightshift-forms-addon-boilerplate'),
			'href' => null,
		];

		$version = UtilsGeneralHelper::getProjectVersion();

		$output[] = [
			'id' => "{$prefixItem}-version",
			'parent' => $prefixItem,
			// Translators: %s is the plugin version number.
			'title' => \sprintf(\esc_html__('Version: %s', 'eightshift-forms'), \esc_html($version)),
			'href' => null,
		];

		$output[] = [
			'id' => "{$prefixItem}-global-settings",
			'parent' => $prefixItem,
			'title' => \esc_html__('Global settings', 'eightshift-forms'),
			'href' => UtilsGeneralHelper::getSettingsGlobalPageUrl(Settings::SETTINGS_TYPE_KEY),
		];

		return $output;
	}
}
