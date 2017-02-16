<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 4/29/16
 * Time: 11:45 AM
 */
class Americaneagle_Bazaarvoiceupdates_Model_ProductImages extends Bazaarvoice_Connector_Model_ProductFeed_Product
{
    public function getProductImageUrl(Mage_Catalog_Model_Product $_product)
    {
        $product = Mage::getModel('catalog/product')->load($_product->getID());
//        $product->getScene7Addition();
        $productImage = Mage::getModel('catalog/product_media_config')->getMediaUrl($product->getImage());
        $noSelection = array_pop(explode('/', $productImage));
        if ($noSelection != 'no_selection') {
            return $productImage;
        } elseif ($noSelection == 'no_selection' && !is_null($product->getScene7Main())) {
            return $product->getScene7Main();
        } else {
            $configurable_product = Mage::getModel('catalog/product_type_configurable');
            $parentIdArray = $configurable_product->getParentIdsByChild($product->getId());
            $parentProduct = Mage::getModel('catalog/product')->load(current($parentIdArray));
            return $parentProduct->getImageUrl();
        }
    }
}