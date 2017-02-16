<?php
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2014 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * More Extension admin controller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Adminhtml_Advancedmenu_MoreextensionController extends MagPassion_Advancedmenu_Controller_Adminhtml_Advancedmenu{
	/**
	 * init the moreextension
	 * @access protected
	 * @return MagPassion_Advancedmenu_Model_Moreextension
	 */
	protected function _initMoreextension(){
		
	}
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('advancedmenu')->__('Advancedmenu'))
			 ->_title(Mage::helper('advancedmenu')->__('More Extensions'));
        
		$this->renderLayout();
     
	}
}