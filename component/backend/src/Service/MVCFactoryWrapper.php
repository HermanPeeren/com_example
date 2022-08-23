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

class MVCFactoryWrapper implements FoobarAware, MVCFactoryInterface
{
	use FoobarAwareTrait;
	use MVCFactoryAwareTrait;

	public function __construct(MVCFactoryInterface $factory)
	{
		$this->setMVCFactory($factory);
	}

	/**
	 * Method to load and return a controller object.
	 *
	 * @param   string                   $name    The name of the controller
	 * @param   string                   $prefix  The controller prefix
	 * @param   array                    $config  The configuration array for the controller
	 * @param   CMSApplicationInterface  $app     The app
	 * @param   Input                    $input   The input
	 *
	 * @return  \Joomla\CMS\MVC\Controller\ControllerInterface
	 *
	 * @since   1.0.0
	 * @throws  \Exception
	 */
	public function createController($name, $prefix, array $config, CMSApplicationInterface $app, Input $input)
	{
		/** @var BaseController $controller */
		$controller = $this->getMVCFactory()->createController($name, $prefix, $config, $app, $input);

		return $controller;
	}

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

	/**
	 * Method to load and return a view object.
	 *
	 * @param   string  $name    The name of the view.
	 * @param   string  $prefix  Optional view prefix.
	 * @param   string  $type    Optional type of view.
	 * @param   array   $config  Optional configuration array for the view.
	 *
	 * @return  \Joomla\CMS\MVC\View\ViewInterface  The view object
	 *
	 * @since   1.0.0
	 * @throws  \Exception
	 */
	public function createView($name, $prefix = '', $type = '', array $config = [])
	{
		return $this->getMVCFactory()->createView($name, $prefix, $type, $config);
	}

	/**
	 * Method to load and return a table object.
	 *
	 * @param   string  $name    The name of the table.
	 * @param   string  $prefix  Optional table prefix.
	 * @param   array   $config  Optional configuration array for the table.
	 *
	 * @return  \Joomla\CMS\Table\Table  The table object
	 *
	 * @since   1.0.0
	 * @throws  \Exception
	 */
	public function createTable($name, $prefix = '', array $config = [])
	{
		return $this->getMVCFactory()->createTable($name, $prefix, $config);
	}
}