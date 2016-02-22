<?php

/**
 * Class Gaboli_Warehouse_Model_CatalogInventory_Stock
 */
class Gaboli_Warehouse_Model_CatalogInventory_Stock extends Mage_CatalogInventory_Model_Stock
{
    /**
     * Subtract product qtys from stock.
     * Return array of items that require full save
     *
     * @param array $items
     *
     * @return array
     *
     * @TODO correct the inventory checks in parent::registerProductSale.
     * @TODO REVIEW CODE FOR REMOVAL
     */
    public function registerProductsSale($items)
    {
        Mage::dispatchEvent('catalog_inventory_register_product_sale_before', array('items' => $items));
        parent::registerProductsSale($items);
        Mage::dispatchEvent('catalog_inventory_register_product_sale_after', array('items' => $items));

    }


    /**
     * Add stock item objects to products
     *
     * @param   collection $productCollection
     *
     * @return  Mage_CatalogInventory_Model_Stock
     */
    public function addItemsToProducts($productCollection)
    {
        $items = Mage::getModel('gaboli_warehouse/stock_status_index')->getCollection();
        $items
            ->addProductsFilter($productCollection)
            ->addFieldToFilter('store_id', Mage::app()->getStore()->getId());

        $stockItems = array();
        foreach ($items as $item) {
            $stockItems[$item->getProductId()] = $item;
        }
        foreach ($productCollection as &$product) {
            if(isset($stockItems[$product->getId()])) {
                $stockItem = Mage::getModel('cataloginventory/stock_item');
                $stockItem->setStockId(1);
                $stockItem->setProduct($product);
                $stockItem->setManageStock((bool) $stockItems[$product->getId()]->getManageStock());
                $stockItem->setIsInStock((bool) $stockItems[$product->getId()]->getIsInStock());
                $stockItem->setQty((int) $stockItems[$product->getId()]->getQty());
                $stockItem->setBackorders((bool) $stockItems[$product->getId()]->getBackorders());
                //@TODO load isQtyDecimal and set it properly.
                $stockItem->setIsQtyDecimal(false);
                $product->setStockItem($stockItem);
                $product->setIsInStock((bool) $stockItems[$product->getId()]->getIsInStock());
                $product->setIsSalable((bool) $stockItems[$product->getId()]->getIsInStock());
            }
        }

        return $this;
    }


    /**
     * Get back to stock (when order is canceled or whatever else)
     *
     * @param int     $productId
     * @param numeric $qty
     *
     * @return Mage_CatalogInventory_Model_Stock
     */
    public function backItemQty($productId, $qty)
    {
        $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);
        if($stockItem->getId() && Mage::helper('catalogInventory')->isQty($stockItem->getTypeId())) {
            $stockItem->addQty($qty);
            if($stockItem->getCanBackInStock() && $stockItem->getQty() > $stockItem->getMinQty()) {
                $stockItem->setIsInStock(true)
                    ->setStockStatusChangedAutomaticallyFlag(true);
            }
            $stockItem->save();
        }

        return $this;
    }

}
