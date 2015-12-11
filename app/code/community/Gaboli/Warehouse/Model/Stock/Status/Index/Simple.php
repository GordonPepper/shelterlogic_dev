<?php

/**
 * Class Gaboli_Warehouse_Model_Stock_Status_Index_Simple
 */
class Gaboli_Warehouse_Model_Stock_Status_Index_Simple
    implements Gaboli_Warehouse_Model_Stock_Status_Index_Interface
{
    public function getManageStockIndexSelectQuery($productIds = false) {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $storesTable                   = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stores');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');
        $coreInventoryTable            = Mage::getModel('core/resource')->getTableName('cataloginventory/stock_item');

        $q = array();
        $q[] = "SELECT";
        $q[] = "  stores.store_id                   AS store_id,";
        $q[] = "  catalog.entity_id                 AS product_id,";
        $q[] = "  inventory.manage_stock            AS manage_stock,";
        $q[] = "  inventory.use_config_manage_stock AS use_config_manage_stock";
        $q[] = "FROM $stockTable stock";
        $q[] = "  INNER JOIN $storesTable stores ON stock.location_id = stores.location_id";
        $q[] = "  INNER JOIN $locationsTable locations ON locations.id = stores.location_id";
        $q[] = "  INNER JOIN $coreCatalogProductEntityTable catalog ON catalog.entity_id = stock.product_id";
        $q[] = "  INNER JOIN $coreInventoryTable inventory ON inventory.product_id = catalog.entity_id";
        $q[] = "WHERE locations.status = '1'";
        $q[] = "    AND catalog.type_id = 'simple'";

        if(is_array($productIds)) {
            $q[] = '    AND stock.product_id IN (' . implode(',', $productIds) . ')';
        }

        $q[] = 'GROUP BY CONCAT(stores.store_id, "_", stock.product_id)';

        return implode("\n", $q);
    }
    /**
     * A select query to retrieve the stock status index data of simple products.
     *
     * @param bool|array $productIds Product IDs to reindex, if a non-array is provided we reindex all products.
     *
     * @return string
     */
    public function getStockStatusIndexSelectQuery($productIds = false)
    {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $storesTable                   = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stores');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');

        $query =
            '    SELECT'
            . '      stores.store_id as store_id,'
            . '      stock.product_id as product_id,'
            . '      SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) as qty,'
            . '      IF(SUM(stock.is_in_stock) > 0, 1, 0) as is_in_stock,'
            . '      IF(SUM(stock.backorders) > 0, 1, 0) as backorders'
            . '    FROM ' . $stockTable . ' as stock'
            . '    JOIN ' . $storesTable . ' as stores'
            . '      ON stock.location_id = stores.location_id'
            . '    JOIN ' . $locationsTable . ' as location'
            . '      ON stock.location_id = location.id'
            . '    JOIN ' . $coreCatalogProductEntityTable . ' as product_entity'
            . '      ON stock.product_id = product_entity.entity_id'
            . '    WHERE'
            . '      location.status = 1'
            . '      AND product_entity.type_id = "simple"';

        if(is_array($productIds)) {
            $query .= '      AND stock.product_id IN (' . implode(',', $productIds) . ')';
        }

        $query .= '    GROUP BY CONCAT(stores.store_id, "_", stock.product_id)';

        return $query;
    }

    /**
     * A select query to retrieve the global stock status index data of simple products.
     *
     * @param bool|array $productIds Product IDs to reindex, if a non-array is provided we reindex all products.
     *
     * @return string
     */
    public function getGlobalStockStatusIndexSelectQuery($productIds = false)
    {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');

        $query =
            '    SELECT'
            . '      0 as store_id,'
            . '      stock.product_id as product_id,'
            . '      SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) as qty,'
            . '      IF(SUM(stock.is_in_stock) > 0, 1, 0) as is_in_stock,'
            . '      IF(SUM(stock.backorders) > 0, 1, 0) as backorders'
            . '    FROM ' . $stockTable . ' as stock'
            . '    JOIN ' . $locationsTable . ' as location'
            . '      ON stock.location_id = location.id'
            . '    JOIN ' . $coreCatalogProductEntityTable . ' as product_entity'
            . '      ON stock.product_id = product_entity.entity_id'
            . '    WHERE'
            . '      location.status = 1'
            . '      AND product_entity.type_id = "simple"';

        if(is_array($productIds)) {
            $query .= '      AND stock.product_id IN (' . implode(',', $productIds) . ')';
        }

        $query .= '    GROUP BY stock.product_id';


        return $query;
    }
    public function getGlobalManageStockIndexSelectQuery($productIds = false) {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');
        $coreInventoryTable            = Mage::getModel('core/resource')->getTableName('cataloginventory/stock_item');

        $q = array();
        $q[] = "SELECT";
        $q[] = "  0 AS store_id,";
        $q[] = "  catalog.entity_id                 AS product_id,";
        $q[] = "  inventory.manage_stock            AS manage_stock,";
        $q[] = "  inventory.use_config_manage_stock AS use_config_manage_stock";
        $q[] = "FROM $stockTable stock";
        $q[] = "  INNER JOIN $locationsTable locations ON stock.location_id = locations.id";
        $q[] = "  INNER JOIN $coreCatalogProductEntityTable catalog ON catalog.entity_id = stock.product_id";
        $q[] = "  INNER JOIN $coreInventoryTable inventory ON inventory.product_id = catalog.entity_id";
        $q[] = "WHERE locations.status = '1'";
        $q[] = "    AND catalog.type_id = 'simple'";

        if(is_array($productIds)) {
            $q[] = '    AND stock.product_id IN (' . implode(',', $productIds) . ')';
        }

        $q[] = 'GROUP BY stock.product_id';

        return implode("\n", $q);
    }

}
