<?php
class Shelterlogic_Templates_Block_Product_Recommended extends Mage_Catalog_Block_Product_View
{
    const XML_PATH_CLEARANCE_CAT_ID = 'shelterlogic/product_detail/clearance_cat_id';
    const XML_PATH_FEATURED_CAT_ID  = 'shelterlogic/product_detail/featured_cat_id';
    const MAX_RECOMMENDED_ITEMS     = 3;

    protected function _construct()
    {
        $this->setData('cache_lifetime', 3600); // Cache for 1h
    }

    public function renderRecommendedList($collection, $title)
    {
        $template = $this->getRecommendedListTemplate();
        if ($template) {
            return $this->getLayout()->createBlock('core/template')
                ->setTemplate($template)
                ->setCollection($collection)
                ->setTitle($title)
                ->setParentBlock($this)
                ->toHtml();
        }

        return '';
    }

    public function getBestSellersCollection()
    {
        $storeId    = Mage::app()->getStore()->getId();
        $collection   = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->addViewsCount();
        $collection->addAttributeToFilter('status', array('in' => Mage::getSingleton('catalog/product_status')->getVisibleStatusIds()));
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $collection->setPageSize(self::MAX_RECOMMENDED_ITEMS)->setCurPage(1);
        return $collection;
    }

    public function getWhatsNewCollection()
    {
        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToSort('created_at', 'desc')
            ->setPageSize(self::MAX_RECOMMENDED_ITEMS)
            ->setCurPage(1)
        ;

        return $collection;
    }

    public function getOnClearanceCollection()
    {
        return $this->_getCollectionFromCagetory(Mage::getStoreConfig(self::XML_PATH_CLEARANCE_CAT_ID));
    }

    public function getFeaturedCollection()
    {
        return $this->_getCollectionFromCagetory(Mage::getStoreConfig(self::XML_PATH_FEATURED_CAT_ID));
    }

    protected function _getCollectionFromCagetory($catId)
    {
        if (!$catId) return array();

        $category = Mage::getModel('catalog/category')->load($catId);
        if ($category->getId()) {
            $collection = $category->getProductCollection();
            $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
            $collection = $this->_addProductAttributesAndPrices($collection)
                ->addStoreFilter()
                ->setPageSize(self::MAX_RECOMMENDED_ITEMS)
                ->setCurPage(1)
            ;

            return $collection;
        }

        return array();
    }
}