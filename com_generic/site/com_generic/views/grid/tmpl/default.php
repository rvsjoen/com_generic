<?php
/**
 * @version		1.0.0 2011.06.05
 * @package		Joomla.Site
 * @subpackage	com_generic
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

//no direct access
defined('_JEXEC') or die;
JHtml::core();
JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
// Create a shortcut for params.
$params = &$this->item->params;
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php //TODO provide pageclass_sfx support ?>
<form action="index.php" method="post" id="adminForm" name="adminForm">
	<?php echo $this->addToolbar();?>
	<?php echo $this->addSubmenu();?>
	<div class="grid-box">
		<?php echo $this->loadTemplate('filters'); ?>
		<?php echo $this->loadTemplate('table'); ?>
		<?php echo $this->loadTemplate('pagination'); ?>
	</div>
	<input type = "hidden" name = "task" value = "" />
	<input type = "hidden" name = "option" value = "com_generic" />
	<input type = "hidden" name = "filter_order" value = "<?php echo $listOrder; ?>" />
	<input type = "hidden" name = "filter_order_Dir" value = "<?php echo $listDirn; ?>" />
</form>





