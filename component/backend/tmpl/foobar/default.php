<?php
/**
 * Example Component
 *
 * @copyright (c) 2022. Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') || die;
?>

<h3>
	<?= Text::_('COM_EXAMPLE_FOOBAR_HEAD') ?>
</h3>

<pre>
<?= $this->foobarStuff ?>
</pre>