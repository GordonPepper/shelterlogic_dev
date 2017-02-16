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
 * Menu Group edit form tab
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menugroup_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{	
	/**
	 * prepare the form
	 * @access protected
	 * @return Advancedmenu_Menugroup_Block_Adminhtml_Menugroup_Edit_Tab_Form
	 * @author MagPassion.com
	 */
	protected function _prepareForm(){
		$form = new Varien_Data_Form();
		$form->setHtmlIdPrefix('menugroup_');
		$form->setFieldNameSuffix('menugroup');
		$this->setForm($form);
		$fieldset = $form->addFieldset('menugroup_form', array('legend'=>Mage::helper('advancedmenu')->__('Menu Group')));

		$fieldset->addField('name', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Name'),
			'name'  => 'name',
			'note'	=> $this->__('Name of menu group'),
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('type', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Type'),
			'name'  => 'type',
			'required'  => true,
			'class' => 'required-entry',
			'values'=> array(
				array(
					'value' => 'dropdown',
					'label' => Mage::helper('advancedmenu')->__('Dropdown'),
				),
				array(
					'value' => 'dropline',
					'label' => Mage::helper('advancedmenu')->__('Dropline'),
				),
				array(
					'value' => 'mega',
					'label' => Mage::helper('advancedmenu')->__('Mega'),
				),
			),
			'value' => 'dropdown',
		));
		
		$fieldset->addField('show_menu_top_icon', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Top menu display image icon'),
			'name'  => 'show_menu_top_icon',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Show'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Hide'),
				),
			),
			'value' => 1,
		));
		
		
		$fieldset->addField('show_submenu_icon', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Submenu display image icon'),
			'name'  => 'show_submenu_icon',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Show'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Hide'),
				),
			),
			'value' => 1,
		));
		
		$fieldset->addField('show_menu_top_des', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Top menu display description'),
			'name'  => 'show_menu_top_des',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Show'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Hide'),
				),
			),
			'value' => 1,
		));
		
		
		$fieldset->addField('show_submenu_des', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Submenu display description'),
			'name'  => 'show_submenu_des',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Show'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Hide'),
				),
			),
			'value' => 1,
		));
		
		
//		$fieldset->addField('background_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Top menu background Color'),
//			'name'  => 'background_color',
//			'note'	=> $this->__('Color code (Ex: f2f2f2)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('menu_level_top_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Top menu link color'),
//			'name'  => 'menu_level_top_color',
//			'note'	=> $this->__('Color code (Ex: 303030)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('menu_level_top_hover_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Top menu link hover color'),
//			'name'  => 'menu_level_top_hover_color',
//			'note'	=> $this->__('Color code (Ex: 2882ce)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('menu_level_top_active_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Top menu link active color'),
//			'name'  => 'menu_level_top_active_color',
//			'note'	=> $this->__('Color code (Ex: 2882ce)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//
//		$fieldset->addField('submenu_background_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu background color'),
//			'name'  => 'submenu_background_color',
//			'note'	=> $this->__('Color code (Ex: 27A1E0)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('submenu_link_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu link color'),
//			'name'  => 'submenu_link_color',
//			'note'	=> $this->__('Color code (Ex: D4F0FC)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('submenu_link_hover_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu link hover color'),
//			'name'  => 'submenu_link_hover_color',
//			'note'	=> $this->__('Color code (Ex: FFFFFF)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('submenu_link_hover_background_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu link hover background color'),
//			'name'  => 'submenu_link_hover_background_color',
//			'note'	=> $this->__('Color code (Ex: 127AAF)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//		$fieldset->addField('submenu_link_active_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu link active color'),
//			'name'  => 'submenu_link_active_color',
//			'note'	=> $this->__('Color code (Ex: FFFFFF)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
//
//
//		$fieldset->addField('show_submenu_border', 'select', array(
//			'label' => Mage::helper('advancedmenu')->__('Display border in submenu'),
//			'name'  => 'show_submenu_border',
//			'values'=> array(
//				array(
//					'value' => 1,
//					'label' => Mage::helper('advancedmenu')->__('Show'),
//				),
//				array(
//					'value' => 0,
//					'label' => Mage::helper('advancedmenu')->__('Hide'),
//				),
//			),
//			'value' => 1,
//		));
//
//		$fieldset->addField('submenu_border_color', 'text', array(
//			'label' => Mage::helper('advancedmenu')->__('Submenu border color'),
//			'name'  => 'submenu_border_color',
//			'note'	=> $this->__('Color code (Ex: 78C7EE)'),
//			'class'     => 'color {required:false, adjust:false, hash:false}',
//		));
		
		$fieldset->addField('status', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Status'),
			'name'  => 'status',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Enabled'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Disabled'),
				),
			),
		));
		if (Mage::app()->isSingleStoreMode()){
			$fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_menugroup')->setStoreId(Mage::app()->getStore(true)->getId());
		}
		if (Mage::getSingleton('adminhtml/session')->getMenugroupData()){
			$form->setValues(Mage::getSingleton('adminhtml/session')->getMenugroupData());
			Mage::getSingleton('adminhtml/session')->setMenugroupData(null);
		}
		elseif (Mage::registry('current_menugroup')){
			$form->setValues(Mage::registry('current_menugroup')->getData());
		}
		return parent::_prepareForm();
	}
}