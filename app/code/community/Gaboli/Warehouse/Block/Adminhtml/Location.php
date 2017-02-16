<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Location
 */
class Gaboli_Warehouse_Block_Adminhtml_Location extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Init location widget grid
     */
    public function __construct()
    {
        $this->_blockGroup = 'gaboli_warehouse';
        $this->_controller = 'adminhtml_location';
        $this->_headerText = $this->__('Warehouse');

        parent::__construct();
    }
}
