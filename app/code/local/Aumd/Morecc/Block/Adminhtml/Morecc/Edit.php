<?php

class Aumd_Morecc_Block_Adminhtml_Morecc_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'morecc';
        $this->_controller = 'adminhtml_morecc';
        
        $this->_updateButton('save', 'label', Mage::helper('morecc')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('morecc')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('morecc_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'morecc_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'morecc_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('morecc_data') && Mage::registry('morecc_data')->getId() ) {
            return Mage::helper('morecc')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('morecc_data')->getTitle()));
        } else {
            return Mage::helper('morecc')->__('Add Item');
        }
    }
}