<?php

/**
 * Class Gaboli_Warehouse_Model_Quote
 */
class Gaboli_Warehouse_Model_Quote extends Mage_Core_Model_Abstract
{
    /**
     * Init
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('gaboli_warehouse/quote');
    }
}
