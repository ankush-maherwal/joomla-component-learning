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

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;

/**
 * Learning component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since  1.0.0
 */
abstract class LearningHelper extends ContentHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $submenu  submenu
	 *
	 * @return Bool
	 */
	public static function addSubmenu($submenu)
	{
		JHtmlSidebar::addEntry(
			Text::_('COM_LEARNING_MANAGE_ACCOUNTS'),
			'index.php?option=com_learning&view=accounts', (($submenu === 'accounts') ? true : false)
		);
	}
}
