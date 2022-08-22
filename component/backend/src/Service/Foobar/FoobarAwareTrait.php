<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\Service\Foobar;

trait FoobarAwareTrait
{
	protected $foobarService;

	public function setFoobar(Foobar $foobar): void
	{
		$this->foobarService = $foobar;
	}

	protected function getFoobar(): Foobar
	{
		return $this->foobarService;
	}
}