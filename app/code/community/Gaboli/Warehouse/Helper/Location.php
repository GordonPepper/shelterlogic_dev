<?php

/**
 * Class Gaboli_Warehouse_Helper_Location
 */
class Gaboli_Warehouse_Helper_Location extends Mage_Core_Helper_Abstract
{
    /**
     *
     *
     * @param $orderId
     * @param $quoteItemId
     *
     * @return array
     */
    public function getPrioritizedLocationsForOrderQuoteItem($orderId, $quoteItemId)
    {
        //get storeview id from order id.
        $storeId = Mage::getModel('sales/order')->load($orderId)->getStoreId();

        $locationsCollection = Mage::getModel('gaboli_warehouse/location')
            ->getCollection()
            ->joinStockDataOnProductAndStoreView(null, $storeId);
        $locationsCollection
            ->getSelect()
            ->group('main_table.id');


        $locationIds = $locationsCollection->getAllIds();
        return $locationIds;
    }
}
