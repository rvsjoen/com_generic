<?php
/**
 * @version		1.0.0 2011.06.05
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

/**
 * Generic grid view.
 *
 * @package		Joomla.Site
 * @subpackage	com_generic
 */
class GenericViewitem extends JView{
	/**
	 * Display the view
	 *
	 * @return	mixed	False on error, null otherwise.
	 */
	function display($tpl = null){
		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument(){
	}
}
