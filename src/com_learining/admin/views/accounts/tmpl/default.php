<?php
/**
 * @package     Learning
 * @subpackage  com_learning
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2019 Techjoomla. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>

<form action="index.php?option=com_learning&view=accounts" method="post" id="adminForm" name="adminForm">
	<div id="learning-wrapper">
		<div id="j-sidebar-container" class="span2">
			<?php echo JHtmlSidebar::render(); ?>
		</div>
		<div id="j-main-container" class="span10">
			<div class="row-fluid">
				<div class="span12">
					<?php
						echo LayoutHelper::render(
							'joomla.searchtools.default',
							array('view' => $this)
						);
					?>
				</div>
			</div>
			<div>&nbsp;</div>
			<?php
			if (!empty($this->items))
			{
			?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="2%">
							<?php echo HTMLHelper::_('grid.checkall'); ?>
						</th>
						<th width="25%">
							<?php echo HTMLHelper::_('searchtools.sort', 'COM_LEARNING_ACCOUNTS_TITLE', 'title', $listDirn, $listOrder); ?>
						</th>
						<th width="10%">
							<?php echo HTMLHelper::_('searchtools.sort', 'COM_LEARNING_ACCOUNTS_STATE', 'published', $listDirn, $listOrder); ?>
						</th>
						<th width="20%">
							<?php echo HTMLHelper::_('searchtools.sort', 'COM_LEARNING_ACCOUNTS_CONTACT_NUMBER', 'contact_number', $listDirn, $listOrder); ?>
						</th>
						<th width="18%">
							<?php echo HTMLHelper::_('searchtools.sort', 'COM_LEARNING_ACCOUNTS_ID', 'id', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $i => $row)
				{
					$link = 'index.php?option=com_learning&task=account.edit&id=' . $row->id;
					?>
					<tr>
						<td>
							<?php echo HTMLHelper::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo Text::_('COM_LEARNING_EDIT_ACCOUNT'); ?>">
								<?php echo $row->title; ?>
							</a>
						</td>
						<td align="center">
							<?php echo HTMLHelper::_('jgrid.published', $row->published, $i, 'accounts.', true, 'cb'); ?>
						</td>
						<td align="center">
							<?php echo $row->contact_number; ?>
						</td>
						<td>
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
				</tfoot>
			</table>
			<?php
			}
			else
			{
				?>
				<div class="alert alert-info"><?php echo Text::_("COM_LEARNING_NO_RECORDS_FOUND");?></div>
				<?php
			}
			?>
			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<?php echo HTMLHelper::_('form.token'); ?>
		</div>
	</div>
</form>
