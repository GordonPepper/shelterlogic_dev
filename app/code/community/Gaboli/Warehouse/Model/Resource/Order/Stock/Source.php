<?php

/**
 * Class Gaboli_Warehouse_Model_Resource_Order_Stock_Source
 */
class Gaboli_Warehouse_Model_Resource_Order_Stock_Source extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Init Resource
     */
    protected function _construct()
    {
        $this->_init('gaboli_warehouse/order_stock_source', 'id');
    }
}
