<?php
/**
 * Class Gaboli_Warehouse_Model_Order_Stock_Source
 */
class Gaboli_Warehouse_Model_Order_Stock_Source extends Mage_Core_Model_Abstract
{
    /**
     * Init model
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('gaboli_warehouse/order_stock_source');
    }
}
