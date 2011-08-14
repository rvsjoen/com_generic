<?php
/**
 * @version		1.0.0 2011.06.05
 * @package		Joomla.Site
 * @subpackage	com_generic
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Method to check if the user is a guest and do a URL redirection if needed.
 *
 * @param	string			URL to do a redirection.
 * @return	booblean		true if user is a guest.
 *
 *
 */
function checkGuest($url){
	// If the user is a guest, redirect to the given URL
	$user = JFactory::getUser();
	if ($user->get('guest') == 1){
		if(isset($url)){
			$app = JFactory::getApplication();
			$app->redirect(JRoute::_($url, false));
		}
		return true;
	}
	return false;
}