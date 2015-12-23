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
 * Menu Item admin edit tabs
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		parent::__construct();
		$this->setId('menuitem_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('advancedmenu')->__('Menu Item'));
	}
	/**
	 * before render html
	 * @access protected
	 * @return MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Edit_Tabs
	 * @author MagPassion.com
	 */
	protected function _beforeToHtml(){
		$this->addTab('form_menuitem', array(
			'label'		=> Mage::helper('advancedmenu')->__('Menu Item'),
			'title'		=> Mage::helper('advancedmenu')->__('Menu Item'),
			'content' 	=> $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_edit_tab_form')->toHtml(),
		));
		if (!Mage::app()->isSingleStoreMode()){
			$this->addTab('form_store_menuitem', array(
				'label'		=> Mage::helper('advancedmenu')->__('Store views'),
				'title'		=> Mage::helper('advancedmenu')->__('Store views'),
				'content' 	=> $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_edit_tab_stores')->toHtml(),
			));
		}
		return parent::_beforeToHtml();
	}
}