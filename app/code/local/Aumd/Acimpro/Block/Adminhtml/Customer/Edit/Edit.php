<?php

class Aumd_Acimpro_Block_Adminhtml_Customer_Edit_Edit extends Mage_Adminhtml_Block_Customer_Edit
{
 
	
 public function __construct()
    {
        parent::__construct();
		
		if (Mage::registry('current_customer')->getId() != "") {
			$this->_addButton('save', array(
					'label'     => Mage::helper('adminhtml')->__('Save Customer'),
					'onclick'   => 'diableValditaionClass();editForm.submit();',
					'class'     => 'save',
				), 1);
		}
    }
	
	protected function _prepareLayout()
    {
		parent::_prepareLayout();
        if (!Mage::registry('current_customer')->isReadonly() && Mage::registry('current_customer')->getId() != "") {
            $this->_addButton('save_and_continue', array(
                'label'     => Mage::helper('customer')->__('Save and Continue Edit'),
                'onclick'   => 'diableValditaionClass();saveAndContinueEdit(\''.$this->_getSaveAndContinueUrl().'\')',
                'class'     => 'save'
            ), 10);
        }
 
    }
	 
}