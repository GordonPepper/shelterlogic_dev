<?php
class Aumd_Acimpro_Block_Adminhtml_Customer_Edit_Tabs extends Mage_Adminhtml_Block_Customer_Edit_Tabs {

    /**
     * Insert the Customer Save card Tab
     */
    protected function _beforeToHtml() {
	
        if (Mage::registry('current_customer')->getId()) {
            $this->addTab('customer_cc', array(
                'label' => Mage::helper('acimpro')->__('Authorize.net CIM Details'),
                'content' => $this->getLayout()->createBlock('acimpro/adminhtml_customer_edit_tab_customercard')->toHtml(),
                'after' => 'tags'
            ));
        }else{
		/*
		   $this->addTab('customer_cc', array(
                'label' => Mage::helper('acimpro')->__('Enter Customer Cards'),
                'content' => $this->getLayout()->createBlock('acimpro/adminhtml_customer_edit_tab_customercard')->toHtml(),
                'after' => 'addresses'
            ));
			*/
		}
        return parent::_beforeToHtml();
    }

}
