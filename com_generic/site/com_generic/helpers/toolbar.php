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
jimport('joomla.html.toolbar');

/**
 * Utility class for the submenu.
 *
 */
class toolbar extends JToolBar{
	/**
	 * Toolbar object
	 *
	 * @var		JToolBar
	 */
	protected $_title = array();

	/**
	 * Constructor
	 *
	 * @param	String	Define the submenu name.
	 */
	public function __construct($name = 'toolbar'){
		parent::__construct($name);
	}

	/**
	 * Method to define the toolbar icon and title
	 *
	 * @param	string		Toolbar title text
	 * @param	string		Toolbar icon name
	 * @return	void
	 */
	public function title($title, $icon = 'generic.png'){
		//Strip the extension
		$icons = explode(' ',$icon);
		foreach($icons as &$icon) {
			$icon = 'icon-48-'.preg_replace('#\.[^.]*$#', '', $icon);
		}
		//Store the param values in an array
		$this->_title = array();
		$this->_title["title"] = JText::_($title);
		$this->_title["icons"] = $icons;
	}

	/**
	 * Render.
	 *
	 * @param	string	The name of the control, or the default text area if a setup file is not found.
	 * @return	string	HTML
	 */
	public function render(){
		$title = $this->_title["title"];
		$icons = $this->_title["icons"];
		$html = array();
		// Start toolbar div.
		$html[] = '<div id="toolbar-box">';
		$html[] = '<div class="toolbar-list" id="'.$this->_name.'">';
		$html[] = '<ul>';
		// Render each button in the toolbar.
		foreach ($this->_bar as $button) {
			$html[] = $this->renderButton($button);
		}
		// End toolbar div.
		$html[] = '</ul>';
		$html[] = '<div class="clr"></div>';
		$html[] = '</div>';
		if(!empty($title)){
			$html[] = '<div class="pagetitle '.implode(' ', $icons).'"><h2>'.$title.'</h2></div>';
		}
		$html[] = '<div class="clr"></div>';
		$html[] = '</div>';
		return implode("", $html);
	}

}








