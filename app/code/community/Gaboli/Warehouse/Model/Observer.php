<?php

/**
 * Class Gaboli_Warehouse_Model_Observer
 */
class Gaboli_Warehouse_Model_Observer
{

    /**
     * @var array of arrays with Quote Stock Id => Quantity Ordered
     */
    private $checkoutProducts = array();

    /**
     * @param Varien_Event_Observer $observer
     */
    public function catalogProductCollectionApplyLimitationsBefore(Varien_Event_Observer $observer)
    {
        $filters = $observer->getCategoryId();
        if(isset($filters['visibility']) && !Mage::getStoreConfig('cataloginventory/options/show_out_of_stock')) {
            $storeId = Mage::app()->getStore()->getId();
            $observer->getCollection();
            $selectFrom = $observer->getCollection()->getSelect()->getPart(Zend_Db_Select::FROM);
            if(!isset($selectFrom['stock_status_index'])) {
                $observer->getCollection()
                    ->getSelect()
                    ->join(
                        array(
                            'stock_status_index' => Mage::getSingleton('core/resource')->getTableName('gaboli_warehouse/stock_status_index')
                        ),
                        'e.entity_id = stock_status_index.product_id' .
                        ' AND stock_status_index.qty > 0' .
                        ' AND stock_status_index.is_in_stock = 1' .
                        ' AND stock_status_index.store_id = ' . $storeId,
                        array()
                    );
            }
        }
    }

    /**
     * Deduct ordered products from inventory if the appropriate config setting is enabled.
     * Triggers after checkout submit.
     *
     * @param $observer
     *
     * @TODO pass off removeStockFromLocations and backorderRemainingStock to some sort of background worker.
     */
    public function checkoutAllSubmitAfter($observer)
    {
        if(Mage::getStoreConfig('cataloginventory/options/can_subtract')) {

            $order   = $observer->getEvent()->getOrder();
            $quote   = $observer->getEvent()->getQuote();
            $orderId = $order->getId();
            $storeId = $order->getStoreId();

            $this->checkoutProducts = array();
            $updatedProducts        = array();
            $quoteItems             = $observer->getEvent()->getQuote()->getAllItems();

            foreach ($quoteItems as $quoteItem) {
                if(sizeof($quoteItem->getChildren()) == 0) {
                    $updatedProducts[] = $quoteItem->getProductId();

                    $this->checkoutProducts[$quoteItem->getId()] = $quoteItem->getQty();
                    if(!is_null($quoteItem->getParentItem())) {
                        $this->checkoutProducts[$quoteItem->getId()] = $quoteItem->getParentItem()->getQty();
                    }
                }
            }

            $this->removeStockFromLocations($order, $quote);

            Mage::getModel('gaboli_warehouse/indexer')->reindex($updatedProducts);
        }
    }

    /**
     * Remove stock from locations.
     *
     * @param $order
     * @param $quote
     */
    protected function removeStockFromLocations($order, $quote)
    {
        $orderId = $order->getId();
        $storeId = $order->getStoreId();

        /*
         * AE modifications to accomodate our shipping rules. No provisions for backorders.
         * utilize the gaboli gaboli_warehouse/order_stock_source tables to store the
         * item sources. what we need to do is add rows to the order_stock_source table,
         * and subtract quantity from the  stock table
         */
        $wff = Mage::getSingleton('core/session')->getWarehouseFulfillment();
        foreach ($this->checkoutProducts as $checkoutProduct => $checkoutProductQuantity) {
            if($wff['single_warehouse']){
                $location_id = $wff['location_id'];
                $checkoutProductId = $quote->getItemById($checkoutProduct)->getProductId();
                $stockCollection = Mage::getModel('gaboli_warehouse/stock')
                    ->getCollection()
                    ->addFieldToSelect(array('stock_id', 'location_id', 'product_id', 'qty'))
                    ->addFieldToFilter('product_id', $checkoutProductId)
                    ->addFieldToFilter('location_id', $location_id);
                foreach ($stockCollection as $stock) {
                    $stock->setQty($stock->getQty() - $checkoutProductQuantity);
                    if($stock->getQty() <= 0){
                        //$stock->setIsInStock(0);
                    }
                    $stock->save();
                    $orderStockSource = Mage::getModel('gaboli_warehouse/order_stock_source');
                    $orderStockSource->setSalesQuoteItemId($checkoutProduct);
                    $orderStockSource->setLocationId($location_id);
                    $orderStockSource->setQty($checkoutProductQuantity);
                    $orderStockSource->save();
                }
            } else {
                $fill = $wff['fulfillment'][$checkoutProduct];
                $checkoutProductId = $quote->getItemById($checkoutProduct)->getProductId();
                $stockCollection = Mage::getModel('gaboli_warehouse/stock')
                    ->getCollection()
                    ->addFieldToSelect(array('stock_id', 'location_id', 'product_id', 'qty'))
                    ->addFieldToFilter('product_id', $checkoutProductId);
                foreach ($stockCollection as $stock) {
                    foreach ($fill as $item) {
                        if($item['location_id'] == $stock->getLocationId()){
                            $stock->setQty($stock->getQty() - $item['qty']);
                            if($stock->getQty() <= 0){
                                //$stock->setIsInStock(0);
                            }
                            $stock->save();
                            $orderStockSource = Mage::getModel('gaboli_warehouse/order_stock_source');
                            $orderStockSource->setSalesQuoteItemId($checkoutProduct);
                            $orderStockSource->setLocationId($item['location_id']);
                            $orderStockSource->setQty($item['qty']);
                            $orderStockSource->save();
                        }
                    }
                }
            }
        }
        Mage::getSingleton('core/session')->unsWarehouseFulfillment();
/*
        foreach ($this->checkoutProducts as $checkoutProductQuoteItemId => $checkoutProductQuantity) {
            $checkoutProductItem = $quote->getItemById($checkoutProductQuoteItemId);
            if($checkoutProductItem->getProduct()->getTypeId() == 'simple') {
                $checkoutProductId = $checkoutProductItem->getProductId();
                $locationIds       = Mage::helper('gaboli_warehouse/location')->getPrioritizedLocationsForOrderQuoteItem($orderId, $checkoutProductQuoteItemId);
                //loop through each location and distribute the inventory
                $stockCollection = Mage::getModel('gaboli_warehouse/stock')
                    ->getCollection()
                    ->addFieldToSelect(array('location_id', 'qty'))
                    ->addFieldToFilter(
                        'location_id',
                        array(
                            'in' => $locationIds
                        )
                    )
                    ->addFieldToFilter(
                        'qty',
                        array(
                            'gt' => '0'
                        )
                    )
                    ->addFieldToFilter('product_id', $checkoutProductId);
                $stockCollection
                    ->getSelect()
                    ->order('FIELD(location_id,' . implode(',', $locationIds) . ')');

                Mage::getModel('gaboli_warehouse/resource_iterator')->walk(
                    $stockCollection->getSelect(),
                    array(
                        array($this, '_locationStockIterate')
                    ),
                    array(
                        'invoker'       => $this,
                        'quote_item_id' => $checkoutProductQuoteItemId,
                        'product_id'    => $checkoutProductId
                    )
                );

                //Get Backorder Location
                //Reduce backorder inventory if possible...
                foreach ($this->checkoutProducts as $checkoutProductQuoteItemId => $checkoutProductQuantity) {
                    if($checkoutProductQuantity > 0) {
                        $backorderLocationCollection = Mage::getModel('gaboli_warehouse/stock')
                            ->getCollection()
                            ->addFieldToSelect(array('location_id', 'qty'))
                            ->addFieldToFilter(
                                'location_id',
                                array(
                                    'in' => $locationIds
                                )
                            )
                            ->addFieldToFilter(
                                'backorders',
                                array(
                                    'eq' => '1'
                                )
                            )
                            ->addFieldToFilter('product_id', $checkoutProductId);
                        $backorderLocationCollection
                            ->getSelect()
                            ->order('FIELD(location_id,' . implode(',', $locationIds) . ')')
                            ->limit(1);

                        if($backorderLocationCollection->getSize()) {
                            $firstBackorderLocation = $backorderLocationCollection->getFirstItem();
                            $stockId                = $firstBackorderLocation['stock_id'];
                            $locationId             = $firstBackorderLocation['location_id'];
                            $availableQty           = $firstBackorderLocation['qty'];
                            $orderStockSource       = Mage::getModel('gaboli_warehouse/order_stock_source');
                            $orderStockSource->setSalesQuoteItemId($checkoutProductQuoteItemId);
                            $orderStockSource->setLocationId($locationId);
                            $remainingQty = $orderStockSource->getQty() - $checkoutProductQuantity;
                            $orderStockSource->setQty($remainingQty);
                            $orderStockSource->save();
                            $this->checkoutProducts[$checkoutProductQuoteItemId] = 0;
                            $stock                                               = Mage::getModel('gaboli_warehouse/stock')->load($stockId);
                            $stock->setQty($remainingQty);
                            $stock->save();
                        }
                    }
                }
            }
        }
*/
    }

    /**
     * Iterate through locations / stock deducting until the order is processed..
     *
     * @param $args
     *
     * @return bool
     */
    public function _locationStockIterate($args)
    {
        $quoteItemId  = $args['quote_item_id'];
        $productId    = $args['product_id'];
        $requestedQty = $this->checkoutProducts[$quoteItemId];

        $row          = $args['row'];
        $stockId      = $row['stock_id'];
        $locationId   = $row['location_id'];
        $availableQty = $row['qty'];
        $requestedQty = $this->checkoutProducts[$quoteItemId];

        $orderStockSource = Mage::getModel('gaboli_warehouse/order_stock_source');
        $orderStockSource->setSalesQuoteItemId($quoteItemId);
        $orderStockSource->setLocationId($locationId);


        if($requestedQty > 0) {
            if($requestedQty >= $availableQty) {
                //deduct available qty
                $orderStockSource->setQty($availableQty);
                $orderStockSource->save();
                $this->checkoutProducts[$quoteItemId] -= $availableQty;
                $stock = Mage::getModel('gaboli_warehouse/stock')->load($stockId);
                $stock->setQty(0);
                if(!$stock->getBackorders()) {
                    $stock->setIsInStock(0);
                }
                $stock->save();
            } else {
                //deduct full requested amount
                $orderStockSource->setQty($requestedQty);
                $orderStockSource->save();
                $this->checkoutProducts[$quoteItemId] = 0;
                $stock                                = Mage::getModel('gaboli_warehouse/stock')->load($stockId);
                $stock->setQty($stock->getQty() - $requestedQty);
                $stock->save();

                //returning false causes our iterator to stop.
                return false;
            }
        }
    }

}
