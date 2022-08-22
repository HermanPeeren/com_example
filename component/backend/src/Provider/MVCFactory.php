<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Provider;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\ApiMVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\SiteRouter;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\Event\DispatcherInterface;

/**
 * This is silly. I need to copy the ENTIRE Joomla MVCFactory service provider's code! WTF?!
 */
class MVCFactory extends \Joomla\CMS\Extension\Service\Provider\MVCFactory
{
	/**
	 * This needs to be copied because it's private and I need it in the overriden register() method.
	 *
	 * @var string
	 */
	private $namespace;

	/**
	 * This needs to be copied because it accesses a private property
	 *
	 * @param   string  $namespace
	 */
	public function __construct(string $namespace)
	{
		$this->namespace = $namespace;
	}

	/**
	 * This needs to be copied so I can change EXACTLY TWO LINES
	 *
	 * @param   Container  $container
	 *
	 * @return void
	 */
	public function register(Container $container)
	{
		$container->set(
			MVCFactoryInterface::class,
			function (Container $container) {
				if (\Joomla\CMS\Factory::getApplication()->isClient('api')) {
					$factory = new ApiMVCFactory($this->namespace);
				} else {
					// This is FIRST line I have changed: using a custom class
					$factory = new \Acme\Example\Administrator\Service\MVCFactory($this->namespace);
				}

				$factory->setFormFactory($container->get(FormFactoryInterface::class));
				$factory->setDispatcher($container->get(DispatcherInterface::class));
				$factory->setDatabase($container->get(DatabaseInterface::class));
				$factory->setSiteRouter($container->get(SiteRouter::class));
				$factory->setCacheControllerFactory($container->get(CacheControllerFactoryInterface::class));

				// This is the SECOND line I have changed: attaching the custom service
				$factory->setFoobar($container->get(\Acme\Example\Administrator\Service\Foobar\Foobar::class));

				return $factory;
			}
		);
	}

}