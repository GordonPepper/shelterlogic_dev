<?php
/**
 * Class Gaboli_Warehouse_Model_CatalogInventory_Resource_Stock
 */
class Gaboli_Warehouse_Model_CatalogInventory_Resource_Stock extends Mage_CatalogInventory_Model_Resource_Stock
{
    /**
     * Get stock items data for requested products
     *
     * @param Mage_CatalogInventory_Model_Stock $stock
     * @param array                             $productIds
     * @param bool                              $lockRows
     *
     * @return array
     */
    public function getProductsStock($stock, $productIds, $lockRows = false)
    {
        if(empty($productIds)) {
            return array();
        }
        $itemTable    = $this->getTable('gaboli_warehouse/stock_status_index');
        $productTable = $this->getTable('catalog/product');
        $select       = $this->_getWriteAdapter()->select()
            ->from(array('si' => $itemTable))
            ->join(array('p' => $productTable), 'p.entity_id=si.product_id', array('type_id'))
            ->where('si.store_id=?', Mage::app()->getStore()->getId())
            ->where('product_id IN(?)', $productIds)
            ->forUpdate($lockRows);

        return $this->_getWriteAdapter()->fetchAll($select);
    }


}
