<?php

/**
 * Class Gaboli_Warehouse_Model_Stock_Status_Index_Configurable
 */
class Gaboli_Warehouse_Model_Stock_Status_Index_Configurable
    implements Gaboli_Warehouse_Model_Stock_Status_Index_Interface
{
    /**
     * A select query to retrieve the stock status index data of configurable products.
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
        $coreCatalogProductSuperlink   = Mage::getModel('core/resource')->getTableName('catalog/product_super_link');

        $query =
            '    SELECT'
            . '    stores.store_id as store_id,'
            . '    product_entity.entity_id as product_id,'
            . '      IF(SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) AND SUM(stock.is_in_stock) > 0, 1, 0) as qty,'
            . '      IF(SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) AND SUM(stock.is_in_stock) > 0, 1, 0) as is_in_stock,'
            . '      IF(SUM(stock.backorders) > 0, 1, 0) as backorders'
            . '    FROM ' . $coreCatalogProductEntityTable . ' as product_entity'
            . '    JOIN ' . $coreCatalogProductSuperlink . ' as link'
            . '      ON product_entity.entity_id = link.parent_id'
            . '    JOIN ' . $stockTable . ' AS stock'
            . '      ON link.product_id = stock.product_id'
            . '    JOIN ' . $storesTable . ' as stores'
            . '      ON stock.location_id = stores.location_id'
            . '    JOIN ' . $locationsTable . ' as location'
            . '      ON stock.location_id = location.id'
            . '    WHERE'
            . '      location.status = 1'
            . '      AND product_entity.type_id = "configurable"';

        if(is_array($productIds)) {
            $query .= '      AND product_entity.entity_id IN (' . implode(',', $productIds) . ')';
        }

        $query .= '    GROUP BY CONCAT(stores.store_id, "_", product_entity.entity_id)';


        return $query;
    }
    public function getManageStockIndexSelectQuery($productIds = false) {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $storesTable                   = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stores');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');
        $coreInventoryTable            = Mage::getModel('core/resource')->getTableName('cataloginventory/stock_item');
        $coreCatalogProductSuperlink   = Mage::getModel('core/resource')->getTableName('catalog/product_super_link');


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
        $q[] = "  INNER JOIN $coreCatalogProductSuperlink  as link ON catalog.entity_id = link.parent_id";
        $q[] = "  INNER JOIN $coreInventoryTable inventory ON inventory.product_id = catalog.entity_id";
        $q[] = "WHERE locations.status = '1'";
        $q[] = "    AND catalog.type_id = 'configurable'";

        if(is_array($productIds)) {
            $q[] = '    AND catalog.entity_id IN (' . implode(',', $productIds) . ')';
        }

        $q[] = 'GROUP BY CONCAT(stores.store_id, "_", stock.product_id)';

        return implode("\n", $q);
    }


    /**
     * A select query to retrieve the global stock status index data of configurable products.
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
        $coreCatalogProductSuperlink   = Mage::getModel('core/resource')->getTableName('catalog/product_super_link');

        $query =
            '    SELECT'
            . '      0 as store_id,'
            . '      product_entity.entity_id as product_id,'
            . '      IF(SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) AND SUM(stock.is_in_stock) > 0, 1, 0) as qty,'
            . '      IF(SUM(IF(stock.is_in_stock = 1, stock.qty, 0)) AND SUM(stock.is_in_stock) > 0, 1, 0) as is_in_stock,'
            . '      IF(SUM(stock.backorders) > 0, 1, 0) as backorders'
            . '    FROM ' . $coreCatalogProductEntityTable . ' as product_entity'
            . '    JOIN ' . $coreCatalogProductSuperlink . ' as link'
            . '      ON product_entity.entity_id = link.parent_id'
            . '    JOIN ' . $stockTable . ' AS stock'
            . '      ON link.product_id = stock.product_id'
            . '    JOIN ' . $locationsTable . ' as location'
            . '      ON stock.location_id = location.id'
            . '    WHERE'
            . '      location.status = 1'
            . '      AND product_entity.type_id = "configurable"';

        if(is_array($productIds)) {
            $query .= '      AND product_entity.entity_id IN (' . implode(',', $productIds) . ')';
        }

        $query .= '    GROUP BY product_entity.entity_id';


        return $query;
    }
    public function getGlobalManageStockIndexSelectQuery($productIds = false) {
        $stockTable                    = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/stock');
        $locationsTable                = Mage::getModel('core/resource')->getTableName('gaboli_warehouse/location');
        $coreCatalogProductEntityTable = Mage::getModel('core/resource')->getTableName('catalog/product');
        $coreInventoryTable            = Mage::getModel('core/resource')->getTableName('cataloginventory/stock_item');
        $coreCatalogProductSuperlink   = Mage::getModel('core/resource')->getTableName('catalog/product_super_link');


        $q = array();
        $q[] = "SELECT";
        $q[] = "  0 AS store_id,";
        $q[] = "  catalog.entity_id                 AS product_id,";
        $q[] = "  inventory.manage_stock            AS manage_stock,";
        $q[] = "  inventory.use_config_manage_stock AS use_config_manage_stock";
        $q[] = "FROM $stockTable stock";
        $q[] = "  INNER JOIN $locationsTable locations ON stock.location_id = locations.id";
        $q[] = "  INNER JOIN $coreCatalogProductEntityTable catalog ON catalog.entity_id = stock.product_id";
        $q[] = "  INNER JOIN $coreCatalogProductSuperlink link ON catalog.entity_id = link.parent_id";
        $q[] = "  INNER JOIN $coreInventoryTable inventory ON inventory.product_id = catalog.entity_id";
        $q[] = "WHERE locations.status = '1'";
        $q[] = "    AND catalog.type_id = 'configurable'";

        if(is_array($productIds)) {
            $q[] = '    AND catalog.entity_id IN (' . implode(',', $productIds) . ')';
        }

        $q[] = 'GROUP BY catalog.entity_id';

        return implode("\n", $q);
    }

}
