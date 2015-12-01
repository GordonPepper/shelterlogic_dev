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
 * Menu Group admin block
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menugroup extends Mage_Adminhtml_Block_Widget_Grid_Container{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		$this->_controller 		= 'adminhtml_menugroup';
		$this->_blockGroup 		= 'advancedmenu';
		$this->_headerText 		= Mage::helper('advancedmenu')->__('Menu Group');
		$this->_addButtonLabel 	= Mage::helper('advancedmenu')->__('Add Menu Group');
		parent::__construct();
	}
}