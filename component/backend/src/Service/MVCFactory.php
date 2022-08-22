<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Service;

use Acme\Example\Administrator\Service\Foobar\FoobarAware;
use Acme\Example\Administrator\Service\Foobar\FoobarAwareTrait;

class MVCFactory extends \Joomla\CMS\MVC\Factory\MVCFactory implements
	FoobarAware
{
	use FoobarAwareTrait;

	public function createModel($name, $prefix = '', array $config = [])
	{
		$model = parent::createModel($name, $prefix, $config);

		if ($model instanceof FoobarAware)
		{
			$model->setFoobar($this->getFoobar());
		}

		return $model;
	}

}