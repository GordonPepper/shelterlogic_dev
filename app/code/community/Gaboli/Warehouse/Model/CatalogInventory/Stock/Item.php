<?php

/**
 * Class Gaboli_Warehouse_Model_CatalogInventory_Stock_Item
 */
class Gaboli_Warehouse_Model_CatalogInventory_Stock_Item extends Mage_CatalogInventory_Model_Stock_Item
{
    /**
     * Before save prepare process
     *
     * @return Gaboli_Warehouse_Model_CatalogInventory_Stock_Item
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();

        Mage::dispatchEvent('model_save_before', array('object' => $this));
        Mage::dispatchEvent($this->_eventPrefix . '_save_before', $this->_getEventData());

        return $this;
    }

}
