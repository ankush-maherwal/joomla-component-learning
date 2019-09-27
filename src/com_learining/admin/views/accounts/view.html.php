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
 * LEARNING - Accounts View
 *
 * @since  1.0.0
 */
class LearningViewAccounts extends HtmlView
{
	/**
	 * Display the accounts list view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get application
		$app = Factory::getApplication();

		// Get data from the model
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = JHelperContent::getActions('com_learning');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		LearningHelper::addSubmenu('accounts');

		// Set the toolbar and number of found items
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
	 * @since   1.0.0
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_LEARNING_MANAGE_ACCOUNTS'));

		if ($this->canDo->get('core.create'))
		{
			JToolBarHelper::addNew('account.add', 'JTOOLBAR_NEW');
		}

		if ($this->canDo->get('core.edit'))
		{
			JToolBarHelper::editList('account.edit', 'JTOOLBAR_EDIT');
		}

		if ($this->canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('accounts.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('accounts.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}

		if ($this->canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'accounts.delete', 'JTOOLBAR_DELETE');
		}

		if ($this->canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_learning');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = Factory::getDocument();
		$document->setTitle(JText::_('COM_LEARNING_MANAGE_ACCOUNTS'));
	}
}
