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
use Acme\Example\Administrator\Service\MVCFactoryWrapper;
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
		$container->registerServiceProvider(new FoobarProvider());
		$container->registerServiceProvider(new MVCFactory('Acme\\Example'));
		$container->extend(
			MVCFactoryInterface::class,
			function(MVCFactoryInterface $factory, Container $container) {
				$decoratedFactory = new MVCFactoryWrapper($factory);
				$foobar           = $container->get(\Acme\Example\Administrator\Service\Foobar\Foobar::class);
				$decoratedFactory->setFoobar(
					$foobar
				);

				return $decoratedFactory;
			}
		);
		$container->registerServiceProvider(new ComponentDispatcherFactory('Acme\\Example'));

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
