<?php 
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Advancedmenu default helper
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Helper_Data extends Mage_Core_Helper_Abstract{
	/**
	 * get the url to the menu groups list page
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getMenugroupsUrl(){
		return Mage::getUrl('advancedmenu/menugroup/index');
	}
	/**
	 * get the url to the menu items list page
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getMenuitemsUrl(){
		return Mage::getUrl('advancedmenu/menuitem/index');
	}
}