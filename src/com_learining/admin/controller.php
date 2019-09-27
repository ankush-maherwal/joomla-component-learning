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

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * General Controller of Learning component
 *
 * @package     Learning
 * @subpackage  com_learning
 * @since       1.0.0
 */
class LearningController extends BaseController
{
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $default_view = 'accounts';
}
