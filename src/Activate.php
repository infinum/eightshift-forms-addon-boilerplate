<?php

/**
 * The file that defines actions on plugin activation.
 *
 * @package EightshiftFormsAddonBoilerplate
 */

declare(strict_types=1);

namespace EightshiftFormsAddonBoilerplate;

use EightshiftFormsAddonBoilerplateVendor\EightshiftLibs\Plugin\HasActivationInterface;

/**
 * The plugin activation class.
 */
class Activate implements HasActivationInterface
{
	/**
	 * Activate the plugin.
	 */
	public function activate(): void
	{
		// Do a cleanup.
		\flush_rewrite_rules();
	}
}
