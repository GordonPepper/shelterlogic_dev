<?php

/**
 * Customer Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-11-9
 */

class Americaneagle_Visual_Model_Task_Pricesync
{

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    /** @var  Americaneagle_Visual_Helper_Inventory helper */
    private $helper;


    /**
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return $this|bool|string
     */
    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        $this->helper = Mage::helper('americaneagle_visual/inventory');

        if($this->helper->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $parameters = $schedule->getParameters();
        $websiteId = 0;
        $store = Mage::getModel('core/store');
        $pageSize = 1000;
        if ($parameters) {
            $parameters = json_decode($parameters);
            $websiteId = $parameters->website_id;
            $store->load($parameters->store_id);
            if ($parameters->page_size) {
                $pageSize = (int)$parameters->page_size;
            }
        } else {
            return false;
        }

        $count = 0;
        $errors = array();
        $startTime = microtime(true);

        $this->getRecursiveItems(0, $pageSize, $count, $errors);

        if (count($errors) > 0) {
            return 'Items updated: ' . $count . ' Errors:(' . count($errors) . ')' . json_encode($errors, JSON_PRETTY_PRINT);
        } else {
            return 'Items updated: ' . $count . ' Time:' . (microtime(true)-$startTime);
        }
    }


    /**
     * @param $page
     * @param $pageSize
     * @param $count
     * @param $errors
     * @return array
     * @throws Exception
     * @internal param $websiteId
     * @internal param $store
     */
    function getRecursiveItems($page, $pageSize, &$count, &$errors){
        /** @var Visual\InventoryService\PartDataResponse $productDataResponse */
        $productDataResponse = $this->helper->getProducts($page * $pageSize + 1, $pageSize);
        $productList = $productDataResponse->getPartList()->getPartListItem();

        for ($i = 0; $i < count($productList); $i++) {
            $productItem = $productList[$i];
            $productId = Mage::getModel('catalog/product')->getIdBySku($productItem->getID());
            if ($productId) {
                /** @var Mage_Catalog_Model_Product $product */
                $product = Mage::getModel('catalog/product')->load($productId);
                $prod = $productItem->getPart();

                if ($product != null) {

                    $product
                        ->setPrice($prod->getUnitPrice())
                        ->setWeight($prod->getShippingWeight());

                    try{
                        $product->save();
                        $count++;
                    }

                    catch (Exception $e) {
                        $errors[] = array('ID' => $productItem->getID(), 'Error' => $e->getMessage());
                    }
                }
            }
        }

        if ($productDataResponse->getPartCount() == $pageSize) {
           //$this->getRecursiveItems($page + 1, $pageSize, $count, $errors);
        }
    }
}
