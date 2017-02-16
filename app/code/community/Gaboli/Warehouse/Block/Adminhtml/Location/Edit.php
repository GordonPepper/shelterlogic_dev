<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Location_Edit
 */
class Gaboli_Warehouse_Block_Adminhtml_Location_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'gaboli_warehouse';
        $this->_objectId   = 'id';
        $this->_controller = 'adminhtml_location';


        $this->_updateButton('save', 'label', Mage::helper('gaboli_warehouse')->__('Save Warehouse'));
        $this->_updateButton('delete', 'label', Mage::helper('gaboli_warehouse')->__('Delete Warehouse'));

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('gaboli_warehouse')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ), -100);
        
        // newly added for save-edit to work
	     $this->_formScripts[] = "
	            function saveAndContinueEdit(){
	                editForm.submit($('edit_form').action+'back/edit/');
	            }
	        ";
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if(Mage::registry('warehouse_data')->getId()) {
            return $this->__('Edit Warehouse');
        } else {
            return $this->__('New Warehouse');
        }
    }
}
