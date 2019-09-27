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

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Factory;

/**
 * LEARNING - Account View
 *
 * @since  1.0.0
 */
class LearningViewAccount extends HtmlView
{
	protected $form;

	protected $item;

	/**
	 * Display the Account view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$jInput = Factory::getApplication()->input;
		$this->popup = $jInput->get('popup', '0', 'INT');

		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		$this->user            = Factory::getUser();

		$this->canCreate       = $this->user->authorise('core.create', 'com_learning');
		$this->canEdit         = $this->user->authorise('core.edit', 'com_learning');
		$this->canChangeStatus = $this->user->authorise('core.edit.state', 'com_learning');
		$this->canDelete       = $this->user->authorise('core.delete', 'com_learning');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$isNew = (isset($this->item->id) && !empty($this->item->id)) ? 0 : 1;

		JToolBarHelper::title($isNew ? JText::_('COM_LEARNING_ACCOUNT_CREATE') : JText::_('COM_LEARNING_ACCOUNT_EDIT'), 'apply');

		if ($this->canEdit || $this->canCreate)
		{
			JToolBarHelper::apply('account.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('account.save', 'JTOOLBAR_SAVE');
			JToolbarHelper::save2new('account.save2new');
		}

		JToolBarHelper::cancel('account.cancel', 'JTOOLBAR_CANCEL');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = (isset($this->item->id) && !empty($this->item->id)) ? 0 : 1;
		$document = Factory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_LEARNING_ACCOUNT_CREATE') : JText::_('COM_LEARNING_ACCOUNT_EDIT'));
	}
}
