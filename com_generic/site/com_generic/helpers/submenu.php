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
 * Utility class for the submenu.
 *
 */
class submenu{
	/**
	 * Submenu name
	 *
	 * @var		string
	 */
	protected $_name = "";

	/**
	 * Submenu elements
	 *
	 * @var		array
	 */
	protected $_elements = array();

	/**
	 * Constructor
	 *
	 * @param	String	Define the submenu name.
	 */
	public function __construct($name = 'submenu'){
		$this->_name = $name;
	}

	/**
	 * Method to add elements to the submenu.
	 *
	 * @param	String		Title text for the element
	 * @param	Boolean		If true the element will be marked as active
	 * @param	String		URL of the element
	 *
	 * @return	void.
	 */
	function appendElement($title, $active=false, $url=""){
		array_push($this->_elements, array("title"=>JText::_($title), "active"=>$active, "url"=>JRoute::_($url)));
	}

	/**
	 * Method to render the HTML structure of a single submenu element
	 * @param	Array		parameter array of a submenu element
	 * @return	String		HTML structure of the submenu element
	 */
	function renderElement($element){
		//Organizing and processing some parameters for the element
		$title		= $element["title"];
		$class		= $element["active"] ? 'class="active"' : '';
		$url		= $element["url"];
		//Contruct the html structure of the element
		$html = "<li><a $class href='$url'>$title</a></li>";
		//Return the HTML structure
		return $html;
	}

	/**
	 * Method to render the HTML structure of the submenu.
	 *
	 * @return	void.
	 */
	function render(){
		$html = array();
		//Submenu start section
		$html[] = '<div id="submenu-box">';
		$html[] = '<ul id="'.$this->_name.'">';
		//Submenu body section
		foreach ($this->_elements as $element){
			//Render each element in the submenu
			$html[] = $this->renderElement($element);
		}
		//Submenu end section
		$html[] = '</ul>';
		$html[] = '<div class="clr"> </div>';
		$html[] = '</div>';
		//Return the HTML structure of the submenu
		return implode("", $html);
	}

}








