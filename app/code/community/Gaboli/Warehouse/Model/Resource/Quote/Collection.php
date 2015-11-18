<?php

/**
 * Class Gaboli_Warehouse_Model_Resource_Quote_Collection
 */
class Gaboli_Warehouse_Model_Resource_Quote_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Init collection
     */
    protected function _construct()
    {
        $this->_init('gaboli_warehouse/quote');
    }
}
