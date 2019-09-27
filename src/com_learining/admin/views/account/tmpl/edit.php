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

use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'account.cancel' || document.formvalidator.isValid(document.getElementById('account-form')))
		{
			Joomla.submitform(task, document.getElementById('account-form'));
		}
	};
");

$fieldSetCounter = 0;
$id = isset($this->item->id) ? $this->item->id : 0;
?>
<div id="learning-wrapper" class="container-fluid">
	<form action="<?php echo 'index.php?option=com_learning&view=account&layout=edit&id=' . (int) $id; ?>" method="POST" name="adminForm" id="account-form" class="form-validate">
		<div class="form-horizontal">
		<?php
		if ($this->form)
		{
			// Iterate through the form fieldsets and display each one
			$fieldSets = $this->form->getFieldsets();

			foreach ($fieldSets as $fieldset)
			{
				// If more than one field sets are added in a form
				if (count($fieldSets) > 1)
				{
					if ($fieldSetCounter == 0)
					{
						$firstTabName = OutputFilter::stringURLUnicodeSlug(trim($fieldset->name));
						echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => $firstTabName));
					}

					$fieldSetCounter ++;

					// Tab name
					$tabName = OutputFilter::stringURLUnicodeSlug(trim($fieldset->name));

					// Create tab for fieldset
					echo HTMLHelper::_("bootstrap.addTab", "myTab", $tabName, $fieldset->name);
				}
				?>
				<div class="row-fluid">
				<?php
				// Iterate through the fields and display them
				foreach ($this->form->getFieldset($fieldset->name) as $field)
				{
					?>
					<div class="span6" style="margin-left:0px;">
						<?php echo $field->renderField();?>
					</div>
					<?php
				}
				?>
				</div>
				<?php
				if (count($this->form->getFieldsets()) > 1)
				{
					echo HTMLHelper::_("bootstrap.endTab");
				}
			}

			if (count($fieldSets) > 1)
			{
				echo HTMLHelper::_('bootstrap.endTabSet');
			}
		}
		?>
		</div>
		<?php
		if ($this->popup)
		{
			?>
			<div class="center">
				<button class="btn btn-large btn-success" onclick='learning.manageAccount.saveAccount();'><?php echo Text::_("JAPPLY");?></button>
			</div>
			<?php
		}
		?>
		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</form>
</div>
