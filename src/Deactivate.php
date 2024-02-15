<?php

/**
 * The file that defines actions on plugin deactivation.
 *
 * @package EightshiftFormsAddonBoilerplate
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate;

use EightshiftFormsAddonBoilerplateVendor\EightshiftLibs\Plugin\HasDeactivationInterface;

/**
 * The plugin deactivation class.
 */
class Deactivate implements HasDeactivationInterface
{
	/**
	 * Deactivate the plugin.
	 */
	public function deactivate(): void
	{
		// Do a cleanup.
		\flush_rewrite_rules();
	}
}
