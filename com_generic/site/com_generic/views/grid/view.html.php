<?php
/**
 * @version		1.0.0 2011.06.05
 * @copyright	Copyright (C) 2010-2011 FakeAuthor. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
error_reporting(E_ALL); ini_set('display_errors', '1');

/**
 * Generic grid view.
 *
 * @package		Joomla.Site
 * @subpackage	com_generic
 */
class GenericViewGrid extends JView{
	protected $state;
	protected $items;
	protected $category;
	protected $categories;
	protected $pagination;

	/**
	 * Display the view
	 *
	 * @return	mixed	False on error, null otherwise.
	 */
	function display($tpl = null){
		$option 	= JRequest::getCmd('option');
		$document 	= & JFactory::getDocument();
		$app 		= JFactory::getApplication();
		$params 	= $app->getParams();
		//Check whether category access level allows access.
		$user = JFactory::getUser();
		$groups = $user->getAuthorisedViewLevels();
		//Load resources
		$document->addStyleSheet("components/$option/assets/media/css/styles.css");
		//Get some data from the models
		$state		= $this->get('State');
		$items		= $this->get('Items');
		$category	= $this->get('Category');
		$children	= $this->get('Children');
		$parent 	= $this->get('Parent');
		$pagination	= $this->get('Pagination');
		//Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}
		//Prepare the data
		//Compute the contact slug
		for ($i = 0, $n = count($items); $i < $n; $i++){
			$item		= &$items[$i];
			$item->slug	= $item->alias ? ($item->id.':'.$item->alias) : $item->id;
			$temp		= new JRegistry();
			$temp->loadJSON($item->params);
			$item->params = clone($params);
			$item->params->merge($temp);
			if ($item->params->get('show_email', 0) == 1){
				$item->email_to = trim($item->email_to);
				if(!empty($item->email_to) && JMailHelper::isEmailAddress($item->email_to)){
					$item->email_to = JHtml::_('email.cloak', $item->email_to);
				}else{
					$item->email_to = '';
				}
			}
		}
		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));
		$maxLevel = $params->get('maxLevel', -1);
		$this->assignRef('maxLevel',	$maxLevel);
		$this->assignRef('state',		$state);
		$this->assignRef('items',		$items);
		$this->assignRef('category',	$category);
		$this->assignRef('children',	$children);
		$this->assignRef('params',		$params);
		$this->assignRef('parent',		$parent);
		$this->assignRef('pagination',	$pagination);
		//define some few document params
		$this->_prepareDocument();
		//Display the view
		parent::display($tpl);
	}

	/**
	 * Add the JToolBar.
	 *
	 * @return	String	The Toolbar html structure
	 */
	function addToolbar(){
		//Load the toolbar helper and create a toolbar
		require_once JPATH_COMPONENT.'/assets/helpers/toolbar.php';
		$tbar =& new toolbar();
		//Defines the toolbar icon and title text
		$tbar->title("Contacts List","contact.png");
		//Add the required buttons
		$tbar->appendButton('Standard', 'new', 'New', 'newtask', false);
		$tbar->appendButton('Standard', 'edit', 'Edit', 'edittask', false);
		$tbar->appendButton('Separator', 'divider');
		$tbar->appendButton('Standard', 'save', 'Save', 'savetask', false);
		$tbar->appendButton('Standard', 'save', 'Save', 'savetask', false);
		$tbar->appendButton('Standard', 'save', 'Save', 'savetask', false);
		$tbar->appendButton('Separator', 'divider');
		$tbar->appendButton('Standard', 'cancel', 'Cancel', 'canceltask', false);
		//Generate the html and return
		return $tbar->render();
	}

	/**
	 * Add the sub-menu.
	 *
	 * @return	String	The Submenu html structure
	 */
	function addSubmenu(){
		//Load the submenu helper and create a submenu
		require_once JPATH_COMPONENT.'/assets/helpers/submenu.php';
		$smenu =& new submenu();
		//Add the required elements
		$smenu->appendElement("Contacts", true, "");
		$smenu->appendElement("Categories", false, "");
		//Generate the html and return
		return $smenu->render();
	}

	/**
	 * Prepares the document
	 *
	 * @return	void
	 */
	protected function _prepareDocument(){
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;
		//Because the application sets a default page title, we need to get it from the menu item itself
		//Page heading
		$menu = $menus->getActive();
		if($menu){
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}else{
			$this->params->def('page_heading', JText::_('COM_CONTACT_DEFAULT_PAGE_TITLE'));
		}
		//Page title
		$id = (int) @$menu->query['id'];
		$title = $this->params->get('page_title', '');
		if(empty($title)){
			$title = $app->getCfg('sitename');
		}elseif($app->getCfg('sitename_pagetitles', 0)){
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		//Page description
		$this->document->setTitle($title);
		if($this->params->get('menu-meta_description')){
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		//Page metadata
		if ($this->params->get('menu-meta_keywords')){
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		if ($this->params->get('robots')){
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}




}





