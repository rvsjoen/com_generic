<?php
/**
 * @version		1.0.0 2011.06.05
 * @package		Joomla.Site
 * @subpackage	com_generic
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// no direct access
defined('_JEXEC') or die;
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if(empty($this->items)){ ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php }else{ ?>
	<div class="separator"></div>
	<table>
		<thead>
			<tr>
				<th>
					<?php echo JText::_('JGLOBAL_NUM'); ?>
				</th>
				<th>
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)">
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'Name', 'a.name', $listDirn, $listOrder); ?>
				</th>
				<th>
					Position
				</th>
				<th>
					<?php echo JText::_('JGLOBAL_EMAIL'); ?>
				</th>
				<th>
					<?php echo JText::_('Phone'); ?>
				</th>
				<th>
					Access
				</th>
				<th>
					Ordering
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'Status', 'a.state', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->items as $i => $item){ ?>
				<tr class="<?php echo ($i % 2) ? "even" : "odd"; ?>">
					<td>
						<?php echo $i+1; ?>
					</td>
					<td>
						<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)">
					</td>
					<td class="tal">
						<a class="jgrid hasTip" href="#" onclick="return listItemTask('cb2','contacts.checkin')" title=""><span class="state checkedout"><span class="text">Checked out</span></span></a>																<a href="/joomla16/administrator/index.php?option=com_contact&amp;task=contact.edit&amp;id=2">Webmaster Webmaster Webmaster </a>
						<p class="smallsub">(<span>Alias</span>: webmaster)</p>
					</td>
					<td class="tal">
						<?php echo $item->con_position; ?>
					</td>
					<td>
						<?php echo $item->email_to; ?>
					</td>
					<td>
						<?php echo $item->telephone; ?>
					</td>
					<td>
						Super User
					</td>
					<td class="order">
						<span><a class="jgrid" href="#" onclick="return listItemTask('cb6','contacts.orderup')" title="Move Up"><span class="state uparrow"><span class="text">Move Up</span></span></a></span>
						<span><a class="jgrid" href="#" onclick="return listItemTask('cb6','contacts.orderdown')" title="Move Down"><span class="state downarrow"><span class="text">Move Down</span></span></a></span>
						<input type="text" name="order[]"  value="1" class="text-area-order">
					</td>
					<td>
						<a class="jgrid" href="#" onclick="return listItemTask('cb1','contacts.unpublish')" title="Published and is Current"><span class="state publish"><span class="text">Published</span></span></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div class="separator"></div>
<?php } ?>

<div class="item-separator"></div>










