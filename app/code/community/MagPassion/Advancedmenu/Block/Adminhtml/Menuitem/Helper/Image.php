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
 * Menu Item image field renderer helper
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Helper_Image extends Varien_Data_Form_Element_Image{
	/**
	 * get the url of the image
	 * @access protected
	 * @return string
	 * @author MagPassion.com
	 */
	protected function _getUrl(){
		$url = false;
		if ($this->getValue()) {
			$url = Mage::helper('advancedmenu/menuitem_image')->getImageBaseUrl().$this->getValue();
		}
		return $url;
	}
}
 