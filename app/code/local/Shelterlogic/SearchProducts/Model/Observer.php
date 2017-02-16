<?php

class Shelterlogic_SearchProducts_Model_Observer
{
    public function addCustomHandles(Varien_Event_Observer $observer)
    {
        if(current(array_keys(Mage::app()->getRequest()->getParams())) == 'id') {
            $productId = current(Mage::app()->getRequest()->getParams());
        } else {
            $productId = Mage::getModel("catalog/product")->getIdBySku(current(Mage::app()->getRequest()->getParams()));
        }

        $product = Mage::getModel('catalog/product')->load($productId);
        $configurable_product = Mage::getModel('catalog/product_type_configurable');
        $parentIdArray = $configurable_product->getParentIdsByChild($product->getId());
        $parentProduct = Mage::getModel('catalog/product')->load(current($parentIdArray));

        if ($product->getVisibility() == 3)
            Mage::register('searchProduct', $parentProduct);
    }
}