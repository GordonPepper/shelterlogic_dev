﻿<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


class Mage_Catalog_Model_Convert_Adapter_Productlinks
    extends Mage_Catalog_Model_Convert_Adapter_Product
{
    /**
     * Save product (import)
     *
     * @param array $importData
     * @throws Mage_Core_Exception
     * @return bool
     */
    public function saveRow(array $importData)
    {
        $product = $this->getProductModel();
        $product->setData(array());

        if (empty($importData['store'])) {
            if (!is_null($this->getBatchParams('store'))) {
                $store = $this->getStoreById($this->getBatchParams('store'));
            } else {
                $message = Mage::helper('catalog')->__('Skip import row, required field "%s" not defined', 'store');
                Mage::throwException($message);
            }
        } else {
            $store = $this->getStoreByCode($importData['store']);
        }

        if ($store === false) {
            $message = Mage::helper('catalog')->__('Skip import row, store "%s" field not exists', $importData['store']);
            Mage::throwException($message);
        }
        if (empty($importData['sku'])) {
            $message = Mage::helper('catalog')->__('Skip import row, required field "%s" not defined', 'sku');
            Mage::throwException($message);
        }
        $product->setStoreId($store->getId());
        $productId = $product->getIdBySku($importData['sku']);

        if ($productId) {
            if (isset($importData['associated'])) {

                $product->load($productId);

                if ($data = $product->getConfigurableAttributesData()) {
                    foreach ($data as $attributeData) {
                        $id = isset($attributeData['id']) ? $attributeData['id'] : null;
                        Mage::getModel('catalog/product_type_configurable_attribute')
                            ->setData($attributeData)
                            ->setId($id)
                            ->setStoreId($this->getProduct($product)->getStoreId())
                            ->setProductId($this->getProduct($product)->getId())
                            ->save();
                    }
                }

                Mage::getResourceModel('catalog/product_type_configurable')
                    ->saveProducts($product, $this->skusToIds($importData['associated'], $product));

            } else {
                $message = Mage::helper('catalog')->__('Skip import row, required field "%s" not defined', 'associated');
                Mage::throwException($message);
            }
        } else {
            $message = Mage::helper('catalog')->__('Skip import row, product with sku:"%s" not found', $importData['sku']);
            Mage::throwException($message);
        }

        return true;
    }

    protected function userCSVDataAsArray($data) {
        return explode(',', str_replace(" ", "", $data));
    }

    protected function skusToIds($userData,$product) {
        $productIds = array();
        foreach ($this->userCSVDataAsArray($userData) as $oneSku) {
            if (($a_sku = (int)$product->getIdBySku($oneSku)) > 0) {
                $productIds[] = $a_sku;
            }
        }
        return $productIds;
    }

}