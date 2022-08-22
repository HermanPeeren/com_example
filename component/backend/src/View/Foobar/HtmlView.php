<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Acme\Example\Administrator\View\Foobar;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

defined('_JEXEC') || die;

class HtmlView extends \Joomla\CMS\MVC\View\HtmlView
{
	public $foobarStuff;

	public function display($tpl = null)
	{
		$this->foobarStuff = $this->get('FoobarStuff');

		ToolbarHelper::title(Text::_('COM_EXAMPLE_FOOBAR'), 'fa fa-beer');

		parent::display($tpl);
	}

}