<?php

/**
 * Class Gaboli_Warehouse_Model_Location
 */
class Gaboli_Warehouse_Model_Location extends Mage_Core_Model_Abstract
{
    /**
     * Init model
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('gaboli_warehouse/location');
    }
}
