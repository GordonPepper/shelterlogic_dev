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
 * Menu Item admin edit block
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
	/**
	 * constuctor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		parent::__construct();
		$this->_blockGroup = 'advancedmenu';
		$this->_controller = 'adminhtml_menuitem';
		$this->_updateButton('save', 'label', Mage::helper('advancedmenu')->__('Save Menu Item'));
		$this->_updateButton('delete', 'label', Mage::helper('advancedmenu')->__('Delete Menu Item'));
		$this->_addButton('saveandcontinue', array(
			'label'		=> Mage::helper('advancedmenu')->__('Save And Continue Edit'),
			'onclick'	=> 'saveAndContinueEdit()',
			'class'		=> 'save',
		), -100);
		$this->_formScripts[] = "
			function saveAndContinueEdit(){
				editForm.submit($('edit_form').action+'back/edit/');
			}
		";
	}
	/**
	 * get the edit form header
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getHeaderText(){
		if( Mage::registry('menuitem_data') && Mage::registry('menuitem_data')->getId() ) {
			return Mage::helper('advancedmenu')->__("Edit Menu Item '%s'", $this->htmlEscape(Mage::registry('menuitem_data')->getTitle()));
		} 
		else {
			return Mage::helper('advancedmenu')->__('Add Menu Item');
		}
	}
}