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
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ModelInterface;
use Joomla\Input\Input;

class MVCFactoryWrapper extends \Joomla\CMS\MVC\Factory\MVCFactoryWrapper implements FoobarAware
{
	use FoobarAwareTrait;

	/**
	 * Method to load and return a model object.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  Optional model prefix.
	 * @param   array   $config  Optional configuration array for the model.
	 *
	 * @return  ModelInterface  The model object
	 *
	 * @since   1.0.0
	 * @throws  \Exception
	 */
	public function createModel($name, $prefix = '', array $config = [])
	{
		$model = $this->getMVCFactory()->createModel($name, $prefix, $config);

		if ($model instanceof FoobarAware)
		{
			$model->setFoobar($this->getFoobar());
		}

		return $model;
	}
}