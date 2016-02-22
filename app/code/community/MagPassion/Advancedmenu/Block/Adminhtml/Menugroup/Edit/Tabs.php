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
 * Menu Group admin edit tabs
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menugroup_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		parent::__construct();
		$this->setId('menugroup_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('advancedmenu')->__('Menu Group'));
	}
	/**
	 * before render html
	 * @access protected
	 * @return MagPassion_Advancedmenu_Block_Adminhtml_Menugroup_Edit_Tabs
	 * @author MagPassion.com
	 */
	protected function _beforeToHtml(){
		$this->addTab('form_menugroup', array(
			'label'		=> Mage::helper('advancedmenu')->__('Menu Group'),
			'title'		=> Mage::helper('advancedmenu')->__('Menu Group'),
			'content' 	=> $this->getLayout()->createBlock('advancedmenu/adminhtml_menugroup_edit_tab_form')->toHtml(),
		));
		if (!Mage::app()->isSingleStoreMode()){
			$this->addTab('form_store_menugroup', array(
				'label'		=> Mage::helper('advancedmenu')->__('Store views'),
				'title'		=> Mage::helper('advancedmenu')->__('Store views'),
				'content' 	=> $this->getLayout()->createBlock('advancedmenu/adminhtml_menugroup_edit_tab_stores')->toHtml(),
			));
		}
		return parent::_beforeToHtml();
	}
}