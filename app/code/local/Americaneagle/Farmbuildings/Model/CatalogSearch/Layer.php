<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/29/16
 * Time: 3:49 PM
 */ 
class Americaneagle_Farmbuildings_Model_CatalogSearch_Layer extends Mage_CatalogSearch_Model_Layer {
    public function prepareProductCollection($collection)
    {
        $collection
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addSearchFilter(Mage::helper('catalogsearch')->getQuery()->getQueryText())
            ->setStore(Mage::app()->getStore())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addStoreFilter()
            ->addUrlRewrite();

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        //Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($collection);

        return $this;
    }

}