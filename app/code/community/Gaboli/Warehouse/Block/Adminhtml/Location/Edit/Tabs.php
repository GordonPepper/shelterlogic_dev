<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tabs
 */
class Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * @var bool|array An array of tabs to be rendered.
     */
    protected $tabs = false;

    /**
     * Init form tabs.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('warehouse_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('gaboli_warehouse')->__('Inventory Warehouse'));
    }

    /**
     * Prepare tabs array.
     */
    protected function prepareTabs()
    {
        $tabs   = array();
        $tabs[] = array('form_section' =>
                            array(
                                'label'   => Mage::helper('gaboli_warehouse')->__('Warehouse'),
                                'title'   => Mage::helper('gaboli_warehouse')->__('Warehouse'),
                                'content' => $this->getLayout()->createBlock('gaboli_warehouse/adminhtml_location_edit_tab_location')->toHtml(),
                                'active'  => true
                            )
        );
        if(Mage::registry('warehouse_data') && Mage::registry('warehouse_data')->getId()) {
            $tabs[] = array('inventory' =>
                                array(
                                    'label'   => Mage::helper('gaboli_warehouse')->__('Inventory'),
                                    'title'   => Mage::helper('gaboli_warehouse')->__('Inventory'),
                                    'content' => $this->getLayout()->createBlock('gaboli_warehouse/adminhtml_location_edit_tab_inventory')->toHtml(),
                                )
            );
        }
        $this->tabs = $tabs;
    }

    /**
     * Called before the block is converted to HTML.
     * Prepare tabs if necessary, add the prepared tabs to the block, then call parent implementations.
     *
     * @return Gaboli_Warehouse_Block_Adminhtml_Location_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        if(!$this->tabs) {
            $this->prepareTabs();
        }

        foreach ($this->tabs as $tab) {
            foreach ($tab as $_tabId => $_tabData) {
                $this->addTab($_tabId, $_tabData);
            }
        }

        return parent::_beforeToHtml();
    }
}
