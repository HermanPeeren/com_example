<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Model;

defined('_JEXEC') || die;

use Acme\Example\Administrator\Service\Foobar\FoobarAware;
use Acme\Example\Administrator\Service\Foobar\FoobarAwareTrait;
use Joomla\CMS\MVC\Model\BaseModel;

class FoobarModel extends BaseModel implements FoobarAware
{
	use FoobarAwareTrait;

	public function getFoobarStuff(): string
	{
		return $this->getFoobar()->getSomething();
	}
}