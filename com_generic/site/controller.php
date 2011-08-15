<?php
/**
 * @version		1.0.0 2011.06.05
 * @package		Joomla.Site
 * @subpackage	com_generic
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

//No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/helpers/checkguest.php';

/**
 * Base controller class for Generic
 *
 * @package		Joomla.Site
 * @subpackage	com_generic
 */
class GenericController extends JController{

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 * @return	JController		This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false){
		$cachable = true;
		// Get the document object.
		$document = JFactory::getDocument();
		// Set the default view name and format from the Request (also filter and define the default view)
		$vName = JRequest::getCmd('view', 'grid');
		JRequest::setVar('view', $vName);
		$user = JFactory::getUser();
		// TODO describe this piece of code
		$safeurlparams = array(
			'catid'=>'INT',
			'id'=>'INT',
			'cid'=>'ARRAY',
			'year'=>'INT',
			'month'=>'INT',
			'limit'=>'INT',
			'limitstart'=>'INT',
			'showall'=>'INT',
			'return'=>'BASE64',
			'filter'=>'STRING',
			'filter_order'=>'CMD',
			'filter_order_Dir'=>'CMD',
			'filter-search'=>'STRING',
			'print'=>'BOOLEAN',
			'lang'=>'CMD',
		);
		parent::display($cachable,$safeurlparams);
		return $this;
	}
}

