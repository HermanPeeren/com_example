<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Provider;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

defined('_JEXEC') || die;

class Foobar implements ServiceProviderInterface
{
	public function register(Container $container)
	{
		$container->set(
			\Acme\Example\Administrator\Service\Foobar\Foobar::class,
			function (Container $container)
			{
				return new \Acme\Example\Administrator\Service\Foobar\Foobar();
			}
		);
	}
}