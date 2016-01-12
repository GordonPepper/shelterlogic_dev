<?php
/**
 * Class Gaboli_Warehouse_Model_Resource_Stock_Status_Index
 */
class Gaboli_Warehouse_Model_Resource_Stock_Status_Index
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Standard resource model init
     */
    protected function _construct()
    {
        $this->_init('gaboli_warehouse/stock_status_index', 'product_id');
    }

    /**
     * Update manage stock value in gaboli stock index
     *
     * @param bool|array $productIds
     */
    public function updateManageStockIndex($productIds = false) {
        $query  = Mage::helper('gaboli_warehouse/indexer')->getAllManageStockIndexSelects($productIds);
        $update = Mage::helper('gaboli_warehouse/indexer')->getUpdateManageStockIndexQuery($query);
        $this->_getWriteAdapter()->query($update);
    }

    /**
     * Update multi location inventory stock status index.
     *
     * @param bool|array $productIds
     */
    public function updateStockStatusIndex($productIds = false)
    {
        $query  = Mage::helper('gaboli_warehouse/indexer')->getAllStockStatusIndexSelects($productIds);
        $update = Mage::helper('gaboli_warehouse/indexer')->getUpdateStockStatusIndexQuery($query);
        $this->_getWriteAdapter()->query($update);
    }

    /**
     * Update core stock status.
     *
     * @param bool|array $productIds
     */
    public function updateCoreStockStatus($productIds = false)
    {
        $query = Mage::helper('gaboli_warehouse/indexer')->getUpdateCoreStockStatusQuery($productIds);
        $this->_getWriteAdapter()->query($query);
    }

    /**
     * Update core stock item.
     *
     * @param bool|array $productIds
     */
    public function updateCoreStockItem($productIds = false)
    {
        $coreStockItemUpdateQuery = Mage::helper('gaboli_warehouse/indexer')->getUpdateCoreStockItemQuery($productIds);
        $this->_getWriteAdapter()->query($coreStockItemUpdateQuery);
    }

    /**
     * Create missing multi location inventory stock rows.
     *
     * @param bool|array $productIds
     */
    public function createMissingStockRows($productIds)
    {
        $productFilter = '';
        if($productIds !== false) {
            $productFilter = ' AND e.entity_id IN(' . implode(',', $productIds) . ')';
        }
        $missingStockRowsQuery       = $this->_getWriteAdapter()
            ->select()
            ->from(
                array(
                    'e' => 'catalog_product_entity'
                ),
                array('product_id' => 'e.entity_id')
            )
            ->columns(new Zend_Db_Expr('0 as qty'))
            ->join(
                array(
                    'location' => 'gaboli_warehouse_location'
                ),
                '',
                'location.id as location_id'
            )
            ->joinLeft(
                array(
                    'stock' => 'gaboli_warehouse_stock'
                ),
                'e.entity_id = stock.product_id AND location.id = stock.location_id',
                ''
            )
            ->join(
                array(
                    'stores' => 'gaboli_warehouse_stores'
                ),
                'location.id = stores.location_id',
                ''
            )
            ->where('stock_id IS NULL' . $productFilter)
            ->group('CONCAT(location.id, \'_\', e.entity_id)');
        $missingStockRowsQueryString = $missingStockRowsQuery->__toString();

        //Create empty stock rows
        $query =
            'INSERT INTO gaboli_warehouse_stock (product_id, qty, location_id)'
            . ' (' . $missingStockRowsQueryString . ')';
        $this->_getWriteAdapter()->query($query);
    }

    /**
     * Create missing multi location inventory stock status index rows.
     *
     * @param bool|array $productIds
     */
    public function createMissingStockIndexRows($productIds)
    {
        $query =
            'INSERT INTO gaboli_warehouse_stock_status_index (store_id, product_id, qty, backorders, is_in_stock)'
            . ' ('
            . ' SELECT'
            . '   store.store_id as store_id,'
            . '   e.entity_id as product_id,'
            . '   0 as qty,'
            . '   0 as backorders,'
            . '   0 as is_in_stock'
            . ' FROM catalog_product_entity AS e'
            . ' JOIN core_store AS store'
            . ' LEFT OUTER JOIN gaboli_warehouse_stock_status_index as stock_idx'
            . '   ON e.entity_id = stock_idx.product_id'
            . '      AND store.store_id = stock_idx.store_id'
            . ' WHERE stock_idx.qty IS NULL';
        if(is_array($productIds)) {
            $query .= ' AND e.entity_id IN(' . implode(',', $productIds) . ')';
        }
        $query .=
            ' GROUP BY CONCAT(store.store_id, \'_\', e.entity_id)'
            . ')';
        $this->_getWriteAdapter()->query($query);
    }
}
