<?php

/**
 * Class Gaboli_Warehouse_Model_Stock
 */
class Gaboli_Warehouse_Model_Stock extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'gaboli_warehouse_stock';

    /**
     * Init
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('gaboli_warehouse/stock');
    }

    /**
     * Load stock object by location id and product id.
     *
     * @param $locationId
     * @param $productId
     *
     * @return Gaboli_Warehouse_Model_Stock
     */
    public function loadByProduct($locationId, $productId)
    {
        $this->_getResource()->loadByProduct($this, $locationId, $productId);

        return $this;
    }

    /**
     * Get the global inventory count for a product.
     *
     * @param $productId
     *
     * @return float
     */
    public function getGlobalInventory($productId)
    {
        $globalInventoryCollection = $this->getCollection()
            ->addExpressionFieldToSelect('qty', 'SUM({{qty}})', 'qty')
            ->addFieldToFilter(
                'product_id',
                array(
                    'eq' => $productId
                )
            );
        $globalInventoryCollection
            ->getSelect()
            ->join(
                array('location' => Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location')),
                'main_table.location_id = location.id AND location.status = 1',
                array()
            );

        return floatval($globalInventoryCollection->getFirstItem()->getQty());
    }
}
