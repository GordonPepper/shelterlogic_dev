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
 * Menu Group helper
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Helper_Menugroup extends Mage_Core_Helper_Abstract{
	/**
	 * check if loading jquery
	 * @access public
	 * @return bool
	 * @author MagPassion.com
	 */
	public function getUseLoadJquery(){
		return Mage::getStoreConfigFlag('advancedmenu/advancedmenu/loadjquery');
	}
}