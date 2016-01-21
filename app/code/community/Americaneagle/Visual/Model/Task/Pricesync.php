<?php

/**
 * Price Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-12-18
 */

class Americaneagle_Visual_Model_Task_Pricesync
{
    /** @var  Americaneagle_Visual_Helper_Inventory helper */
    private $helper;

    private $pageSize = 1000;
    private $productSkuList = array();
    private $count = 0;
    private $errors = array();

    /** @var  Mage_Core_Model_Store store */
    private $store;

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        $this->helper = Mage::helper('americaneagle_visual/inventory');

        if($this->helper->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $parameters = $schedule->getParameters();
        $this->store = Mage::getModel('core/store');

        $message = '';

        if ($parameters) {
            $parameters = json_decode($parameters);
            if ($parameters->store_ids) {
                $store_ids = $parameters->store_ids;
            } else {
                return false;
            }
            if ($parameters->page_size) {
                $this->pageSize = (int)$parameters->page_size;
            }
        } else {
            return false;
        }

        foreach ($store_ids as $storeId) {
            $this->store->load($storeId);
            $this->helper->getConfig()->setStore($this->store);

            $startTime = microtime(true);

            $cache = Mage::getSingleton('core/cache');
            $key = 'products-sku-product-id-array' . $this->store->getId();

            if(!$data = $cache->load($key)){
                $productsCollection = Mage::getResourceModel('catalog/product_collection')
                    ->addAttributeToSelect('SKU');
                $productsCollection->load();

                foreach($productsCollection->getItems() as $product){
                    $this->productSkuList[$product->getSku()] = $product->getId();
                }
                $data = serialize($this->productSkuList);
                $cache->save($data, $key, array(Mage_Catalog_Model_Product::CACHE_TAG));
            } else {
                $this->productSkuList = unserialize($data);
            }

            printf('Magento Products loading time: %d', (microtime(true)-$startTime));

            $this->getRecursiveItems(0);

            if (count($this->errors) > 0) {
                $message .= 'Store ' . $storeId . ' - Items updated: ' . $this->count . ' Time: ' . (microtime(true)-$startTime) . ' Errors:(' . count($this->errors) . ')' . json_encode($this->errors, JSON_PRETTY_PRINT) . "\r\n";
            } else {
                $message .= 'Store ' . $storeId . ' - Items updated: ' . $this->count . ' Time: ' . (microtime(true)-$startTime) . "\r\n";
            }
            $this->count = 0;
            $this->errors = array();
        }

        $process = Mage::getModel('index/indexer')->getProcessByCode('catalog_product_price');
        $process->reindexAll();

        return $message;
    }

    /**
     * @param $page
     * @throws Exception
     */
    function getRecursiveItems($page){
        printf("\nGetting page %d\n", $page + 1);

        /** @var Visual\InventoryService\PartDataResponse $productDataResponse */
        $productDataResponse = $this->helper->getProducts($page * $this->pageSize + 1, $this->pageSize);
        $productList = $productDataResponse->getPartList()->getPartListItem();

        printf("Processing %d items\n", count($productList));

        for ($i = 0; $i < count($productList); $i++) {
            $productItem = $productList[$i];
            $sku = $productItem->getID();
            if (array_key_exists ( $sku, $this->productSkuList)) {
                $prod = $productItem->getPart();
                $productId = $this->productSkuList[$sku];

                try{
                    Mage::getResourceSingleton('catalog/product_action')
                        ->updateAttributes(array($productId),
                            array("price" => $prod->getUnitPrice(), "weight" => $prod->getShippingWeight()),
                            $this->store->getId());
                    $this->count++;
                }

                catch (Exception $e) {
                    $this->errors[] = array('ID' => $productItem->getID(), 'Error' => $e->getMessage());
                }
            }
            $this->helper->progressBar($i + 1, count($productList));
        }

        if ($productDataResponse->getPartCount() == $this->pageSize) {
           $this->getRecursiveItems($page + 1);
        }
    }
}
