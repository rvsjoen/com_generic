<?php
/**
 * @version		1.0.0 2011.06.05
 * @package		Joomla.Site
 * @subpackage	com_generic
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');
//require_once JPATH_COMPONENT.'/helpers/route.php';

// Launch the controller.
$controller = JController::getInstance('Generic');
$controller->execute(JRequest::getCmd('task', 'display'));
$controller->redirect();