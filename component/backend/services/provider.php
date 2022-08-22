<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') || die;

use Acme\Example\Administrator\Extension\ExampleComponent;
use Acme\Example\Administrator\Provider\Foobar as FoobarProvider;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface {
	public function register(Container $container)
	{
		$container->registerServiceProvider(new MVCFactory('Acme\\Example'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('Acme\\Example'));
		$container->registerServiceProvider(new FoobarProvider());

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new ExampleComponent($container->get(ComponentDispatcherFactoryInterface::class));

				$component->setMVCFactory($container->get(MVCFactoryInterface::class));

				return $component;
			}
		);
	}
};
