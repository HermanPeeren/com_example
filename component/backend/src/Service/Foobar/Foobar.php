<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Service\Foobar;

defined('_JEXEC') || die;

class Foobar
{
	public function getSomething(): string
	{
		return 'foobar';
	}
}