<?php
/**
 * Class Gaboli_Warehouse_Model_Resource_Order_Stock_Source_Collection
 */
class Gaboli_Warehouse_Model_Resource_Order_Stock_Source_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Init collection
     */
    protected function _construct()
    {
        $this->_init('gaboli_warehouse/order_stock_source');
    }
}
