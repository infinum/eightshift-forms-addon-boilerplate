<?php

/**
 * Settings class.
 *
 * @package EightshiftFormsAddonBoilerplate\Settings
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate\Settings;

use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Config\UtilsConfig;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Helpers\UtilsHooksHelper;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Helpers\UtilsSettingsHelper;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Helpers\UtilsSettingsOutputHelper;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Settings\UtilsSettingGlobalInterface;
use EightshiftFormsAddonBoilerplateVendor\EightshiftFormsUtils\Settings\UtilsSettingInterface;
use EightshiftFormsAddonBoilerplateVendor\EightshiftLibs\Services\ServiceInterface;

/**
 * Settings class.
 */
class Settings implements UtilsSettingGlobalInterface, UtilsSettingInterface, ServiceInterface
{
	/**
	 * Filter settings key.
	 */
	public const FILTER_SETTINGS_NAME = 'es_forms_settings_addon_boilerplate';

	/**
	 * Filter global settings key.
	 */
	public const FILTER_SETTINGS_GLOBAL_NAME = 'es_forms_settings_global_addon_boilerplate';

	/**
	 * Filter settings isValid key.
	 */
	public const FILTER_SETTINGS_IS_VALID_NAME = 'es_forms_settings_is_valid_addon_boilerplate';

	/**
	 * Filter settings global isValid key.
	 */
	public const FILTER_SETTINGS_GLOBAL_IS_VALID_NAME = 'es_forms_settings_global_is_valid_addon_boilerplate';

	/**
	 * Settings key.
	 */
	public const SETTINGS_TYPE_KEY = 'boilerplate';

	/**
	 * Boilerplate use key.
	 */
	public const SETTINGS_BOILERPLATE_USE_KEY = 'boilerplate-use';

	/**
	 * Boilerplate settings use key.
	 */
	public const SETTINGS_BOILERPLATE_SETTINGS_USE_KEY = 'boilerplate-settings-use';

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Load settings in the main settings builder array.
		\add_filter(UtilsHooksHelper::getFilterName(['admin', 'settings', 'data']), [$this, 'getSettingsConfig']);

		// Get settings data.
		\add_filter(self::FILTER_SETTINGS_NAME, [$this, 'getSettingsData']);

		// Get global setting data.
		\add_filter(self::FILTER_SETTINGS_GLOBAL_NAME, [$this, 'getSettingsGlobalData']);

		// Check if settings is valid.
		\add_filter(self::FILTER_SETTINGS_IS_VALID_NAME, [$this, 'isSettingsValid']);

		// Check if global settings is valid.
		\add_filter(self::FILTER_SETTINGS_GLOBAL_IS_VALID_NAME, [$this, 'isSettingsGlobalValid']);
	}

	/**
	 * Settings config data.
	 *
	 * @param array<mixed> $output Output array.
	 *
	 * @return array<mixed>
	 */
	public function getSettingsConfig(array $output): array
	{
		$output[self::SETTINGS_TYPE_KEY] = [
			'settings' => self::FILTER_SETTINGS_NAME,
			'settingsGlobal' => self::FILTER_SETTINGS_GLOBAL_NAME,
			'type' => UtilsConfig::SETTINGS_INTERNAL_TYPE_ADDON,
			'use' => self::SETTINGS_BOILERPLATE_USE_KEY,
			'labels' => [
				'title' => \__('Boilerplate Addon', 'eightshift-forms-addon-boilerplate'),
				'desc' => \__('Settings for addon Boilerplate options.', 'eightshift-forms-addon-boilerplate'),
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h9A1.5 1.5 0 0 1 16 5.5v9a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 4 14.5v-9Z" stroke="currentColor" fill="none"/><path d="M7 7.75A.75.75 0 0 1 7.75 7h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-4.5a.75.75 0 0 1-.75-.75v-4.5Z" fill="currentColor" fill-opacity="0.3" stroke="currentColor" stroke-linejoin="round"/><path d="M7 4V1.5M10 4V1.5M13 4V1.5m-6 17V16m3 2.5V16m3 2.5V16M1.5 7H4m-2.5 3H4m-2.5 3H4m12-6h2.5M16 10h2.5M16 13h2.5" stroke="currentColor" stroke-linecap="round" fill="none"/></svg>',
			],
		];

		return $output;
	}

	/**
	 * Determine if settings is valid.
	 *
	 * @param string $formId Form ID.
	 *
	 * @return boolean
	 */
	public function isSettingsValid(string $formId): bool
	{
		if (!$this->isSettingsGlobalValid()) {
			return false;
		}

		$isUsed = UtilsSettingsHelper::isSettingCheckboxChecked(self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY, self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY, $formId);

		if (!$isUsed) {
			return false;
		}

		return true;
	}

	/**
	 * Determine if settings global is valid.
	 *
	 * @return boolean
	 */
	public function isSettingsGlobalValid(): bool
	{
		if (!UtilsSettingsHelper::isOptionCheckboxChecked(self::SETTINGS_BOILERPLATE_USE_KEY, self::SETTINGS_BOILERPLATE_USE_KEY)) {
			return false;
		}

		return true;
	}

	/**
	 * Get Form settings data array.
	 *
	 * @param string $formId Form Id.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsData(string $formId): array
	{
		// Bailout if feature is not active.
		if (!$this->isSettingsGlobalValid()) {
			return UtilsSettingsOutputHelper::getNoActiveFeature();
		}

		// Check if setting is valid.
		$isUsed = UtilsSettingsHelper::isSettingCheckboxChecked(self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY, self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY, $formId);

		return [
			UtilsSettingsOutputHelper::getIntro(self::SETTINGS_TYPE_KEY),
			[
				'component' => 'layout',
				'layoutType' => 'layout-v-stack-card',
				'layoutContent' => [
					[
						'component' => 'checkboxes',
						'checkboxesFieldLabel' => '',
						'checkboxesName' => UtilsSettingsHelper::getSettingName(self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY),
						'checkboxesContent' => [
							[
								'component' => 'checkbox',
								'checkboxLabel' => \__('Use Boilerplate settings', 'eightshift-forms-addon-boilerplate'),
								'checkboxIsChecked' => $isUsed,
								'checkboxValue' => self::SETTINGS_BOILERPLATE_SETTINGS_USE_KEY,
								'checkboxSingleSubmit' => true,
								'checkboxAsToggle' => true,
							]
						]
					],
					...($isUsed ? [
						[
							'component' => 'divider',
							'dividerExtraVSpacing' => true,
						],
						[
							'component' => 'intro',
							'introTitle' => \__('Settings', 'eightshift-forms-addon-boilerplate'),
						],
					] : []),
				],
			],
		];
	}

	/**
	 * Get global settings array for building settings page.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSettingsGlobalData(): array
	{
		// Bailout if feature is not active.
		if (!UtilsSettingsHelper::isOptionCheckboxChecked(self::SETTINGS_BOILERPLATE_USE_KEY, self::SETTINGS_BOILERPLATE_USE_KEY)) {
			return UtilsSettingsOutputHelper::getNoActiveFeature();
		}

		return [
			UtilsSettingsOutputHelper::getIntro(self::SETTINGS_TYPE_KEY),
			[
				'component' => 'layout',
				'layoutType' => 'layout-v-stack-card',
				'layoutContent' => [
					[
						'component' => 'intro',
						'introSubtitle' => \__('Addon Boilerplate details.', 'eightshift-forms-addon-boilerplate'),
					],
				],
			],
		];
	}
}
