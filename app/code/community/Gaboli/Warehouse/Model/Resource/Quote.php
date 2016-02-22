<?php

/**
 * Class Gaboli_Warehouse_Model_Resource_Quote
 */
class Gaboli_Warehouse_Model_Resource_Quote extends Mage_Core_Model_Resource_Db_Abstract
{
    protected $_isPkAutoIncrement = false;

    /**
     * Init Resource
     */
    protected function _construct()
    {
        $this->_init('gaboli_warehouse/quote', 'item_id');
    }

}
