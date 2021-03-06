<?php

/**
 * Product_import.php
 *
 * @copyright  copyright (c) 2009 toniyecla[at]gmail.com
 * @license    http://opensource.org/licenses/osl-3.0.php open software license (OSL 3.0)
 */
class Mage_Catalog_Model_Convert_Adapter_Productimport
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

        if (empty($importData['sku'])) {
            $message = Mage :: helper('catalog')->__('Skip import row, required field "%s" not defined', 'sku');
            Mage :: throwException($message);
        }

        if ($stockItem = $product->getStockItem()) {
            $stockItem->setData(array());
        }

        if (empty($importData['store'])) {
            if (!is_null($this->getBatchParams('store'))) {
                $store = $this->getStoreById($this->getBatchParams('store'));
            } else {
                $message = Mage :: helper('catalog')->__('Skip import row, required field "%s" not defined', 'store');
                Mage :: throwException($message);
            }
        } else {
            $store = $this->getStoreByCode($importData['store']);
        }

        if ($store === false) {
            $message = Mage :: helper('catalog')->__('Skip import row, store "%s" field not exists', $importData['store']);
            Mage :: throwException($message);
        }

        $product->setStoreId($store->getId());
        $productId = $product->getIdBySku($importData['sku']);

        if ($importData['type'] == 'configurable') {
            if ($productId) {
                if (isset($importData['associated'])) {

                    $product->load($productId);

                    /*if ($data = $product->getConfigurableAttributesData()) {
                        foreach ($data as $attributeData) {
                            $id = isset($attributeData['id']) ? $attributeData['id'] : null;
                            Mage::getModel('catalog/product_type_configurable_attribute')
                                ->setData($attributeData)
                                ->setId($id)
                                ->setStoreId($this->getProduct($product)->getStoreId())
                                ->setProductId($this->getProduct($product)->getId())
                                ->save();
                        }
                    }*/
                    if ($importData['associated'] == '*') {
                        Mage::getResourceModel('catalog/product_type_configurable')
                            ->saveProducts($product, $_SESSION['associated_ids']);
                        $_SESSION['batch_id'] = null;
                        $_SESSION['associated_ids'] = null;
                    } else {
                        Mage::getResourceModel('catalog/product_type_configurable')
                            ->saveProducts($product, $this->skusToIds($importData['associated'], $product));
                    }
                } else {
                    $message = Mage::helper('catalog')->__('Skip import row, required field "%s" not defined', 'associated');
                    Mage::throwException($message);
                }
            } else {
                $message = Mage::helper('catalog')->__('Skip import row, product with sku:"%s" not found', $importData['sku']);
                Mage::throwException($message);
            }
        } else {
            if ($productId) {
                if ($_SESSION['batch_id'] != $_REQUEST['batch_id']) {
                    $_SESSION['batch_id'] = $_REQUEST['batch_id'];
                    $_SESSION['associated_ids'] = array();
                }
                if (!in_array($productId,$_SESSION['associated_ids'])){
                    $_SESSION['associated_ids'][] = $productId;
                }
                $product->load($productId);
            }
            $productTypes = $this->getProductTypes();
            $productAttributeSets = $this->getProductAttributeSets();

            // delete disabled products
            if ($importData['status'] == 'Disabled') {
                $product = Mage :: getSingleton('catalog/product')->load($productId);
                $this->_removeFile(Mage :: getSingleton('catalog/product_media_config')->getMediaPath($product->getData('image')));
                $this->_removeFile(Mage :: getSingleton('catalog/product_media_config')->getMediaPath($product->getData('small_image')));
                $this->_removeFile(Mage :: getSingleton('catalog/product_media_config')->getMediaPath($product->getData('thumbnail')));
                $media_gallery = $product->getData('media_gallery');
                foreach ($media_gallery['images'] as $image) {
                    $this->_removeFile(Mage :: getSingleton('catalog/product_media_config')->getMediaPath($image['file']));
                }
                $product->delete();
                return true;
            }

            if (empty($importData['type']) || !isset($productTypes[strtolower($importData['type'])])) {
                $value = isset($importData['type']) ? $importData['type'] : '';
                $message = Mage :: helper('catalog')->__('Skip import row, is not valid value "%s" for field "%s"', $value, 'type');
                Mage :: throwException($message);
            }
            $product->setTypeId($productTypes[strtolower($importData['type'])]);

            if (empty($importData['attribute_set']) || !isset($productAttributeSets[$importData['attribute_set']])) {
                $value = isset($importData['attribute_set']) ? $importData['attribute_set'] : '';
                $message = Mage :: helper('catalog')->__('Skip import row, is not valid value "%s" for field "%s"', $value, 'attribute_set');
                Mage :: throwException($message);
            }
            $product->setAttributeSetId($productAttributeSets[$importData['attribute_set']]);

            foreach ($this->_requiredFields as $field) {
                $attribute = $this->getAttribute($field);
                if (!isset($importData[$field]) && $attribute && $attribute->getIsRequired()) {
                    $message = Mage :: helper('catalog')->__('Skip import row, required field "%s" for new products not defined', $field);
                    Mage :: throwException($message);
                }
            }

            if (isset($importData['category_ids'])) {
                $product->setCategoryIds($importData['category_ids']);
            }


            if (isset($importData['categories'])) {

                if (isset($importData['store'])) {
                    $cat_store = $this->_stores[$importData['store']];
                } else {
                    $message = Mage :: helper('catalog')->__('Skip import row, required field "store" for new products not defined', $field);
                    Mage :: throwException($message);
                }

                $categoryIds = $this->_addCategories($importData['categories'], $cat_store);
                if ($categoryIds) {
                    $product->setCategoryIds($categoryIds);
                }

            }

            foreach ($this->_ignoreFields as $field) {
                if (isset($importData[$field])) {
                    unset($importData[$field]);
                }
            }

            if ($store->getId() != 0) {
                $websiteIds = $product->getWebsiteIds();
                if (!is_array($websiteIds)) {
                    $websiteIds = array();
                }
                if (!in_array($store->getWebsiteId(), $websiteIds)) {
                    $websiteIds[] = $store->getWebsiteId();
                }
                $product->setWebsiteIds($websiteIds);
            }

            if (isset($importData['websites'])) {
                $websiteIds = $product->getWebsiteIds();
                if (!is_array($websiteIds)) {
                    $websiteIds = array();
                }
                $websiteCodes = split(',', $importData['websites']);
                foreach ($websiteCodes as $websiteCode) {
                    try {
                        $website = Mage :: app()->getWebsite(trim($websiteCode));
                        if (!in_array($website->getId(), $websiteIds)) {
                            $websiteIds[] = $website->getId();
                        }
                    } catch (Exception $e) {
                    }
                }
                $product->setWebsiteIds($websiteIds);
                unset($websiteIds);
            }

            foreach ($importData as $field => $value) {
                if (in_array($field, $this->_inventorySimpleFields)) {
                    continue;
                }
                if (in_array($field, $this->_imageFields)) {
                    continue;
                }

                $attribute = $this->getAttribute($field);
                if (!$attribute) {
                    continue;
                }

                $isArray = false;
                $setValue = $value;

                if ($attribute->getFrontendInput() == 'multiselect') {
                    $value = split(self :: MULTI_DELIMITER, $value);
                    $isArray = true;
                    $setValue = array();
                }

                if ($value && $attribute->getBackendType() == 'decimal') {
                    $setValue = $this->getNumber($value);
                }

                if ($attribute->usesSource()) {
                    $options = $attribute->getSource()->getAllOptions(false);

                    if ($isArray) {
                        foreach ($options as $item) {
                            if (in_array($item['label'], $value)) {
                                $setValue[] = $item['value'];
                            }
                        }
                    } else {
                        $setValue = null;
                        foreach ($options as $item) {
                            if ($item['label'] == $value) {
                                $setValue = $item['value'];
                            }
                        }
                    }
                }

                $product->setData($field, $setValue);
            }

            if (!$product->getVisibility()) {
                $product->setVisibility(Mage_Catalog_Model_Product_Visibility :: VISIBILITY_NOT_VISIBLE);
            }

            $stockData = array();
            $inventoryFields = $product->getTypeId() == 'simple' ? $this->_inventorySimpleFields : $this->_inventoryOtherFields;
            foreach ($inventoryFields as $field) {
                if (isset($importData[$field])) {
                    if (in_array($field, $this->_toNumber)) {
                        $stockData[$field] = $this->getNumber($importData[$field]);
                    } else {
                        $stockData[$field] = $importData[$field];
                    }
                }
            }
            $product->setStockData($stockData);

            $imageData = array();
            foreach ($this->_imageFields as $field) {
                if (!empty($importData[$field]) && $importData[$field] != 'no_selection') {
                    if (!isset($imageData[$importData[$field]])) {
                        $imageData[$importData[$field]] = array();
                    }
                    $imageData[$importData[$field]][] = $field;
                }
            }

            foreach ($imageData as $file => $fields) {
                try {
                    $product->addImageToMediaGallery(Mage :: getBaseDir('media') . DS . 'import/' . $file, $fields, false);
                } catch (Exception $e) {
                }
            }

            if (!empty($importData['gallery'])) {
                $galleryData = explode(',', $importData["gallery"]);
                foreach ($galleryData as $gallery_img) {
                    try {
                        $product->addImageToMediaGallery(Mage :: getBaseDir('media') . DS . 'import' . $gallery_img, null, false, false);
                    } catch (Exception $e) {
                    }
                }
            }

            $product->setIsMassupdate(true);
            $product->setExcludeUrlRewrite(true);

            $product->save();
        }

        return true;
    }

    protected function userCSVDataAsArray($data)

    {
        return explode(',', str_replace(" ", "", $data));
    }

    protected function skusToIds($userData, $product)
    {
        $productIds = array();
        foreach ($this->userCSVDataAsArray($userData) as $oneSku) {
            if (($a_sku = (int)$product->getIdBySku($oneSku)) > 0) {
                $productIds[] = $a_sku;
            }
        }
        return $productIds;
    }

    protected $_categoryCache = array();

    protected function _addCategories($categories, $store)

    {
        // $rootId = $store->getRootCategoryId();
        // $rootId = Mage::app()->getStore()->getRootCategoryId();
        $rootId = 2; // our store's root category id
        if (!$rootId) {
            return array();
        }
        $rootPath = '1/' . $rootId;
        if (empty($this->_categoryCache[$store->getId()])) {
            $collection = Mage :: getModel('catalog/category')->getCollection()
                ->setStore($store)
                ->addAttributeToSelect('name');
            $collection->getSelect()->where("path like '" . $rootPath . "/%'");

            foreach ($collection as $cat) {
                try {
                    $pathArr = explode('/', $cat->getPath());
                    $namePath = '';
                    for ($i = 2, $l = sizeof($pathArr); $i < $l; $i++) {
                        $name = $collection->getItemById($pathArr[$i])->getName();
                        $namePath .= (empty($namePath) ? '' : '/') . trim($name);
                    }
                    $cat->setNamePath($namePath);
                } catch (Exception $e) {
                    echo "ERROR: Cat - ";
                    print_r($cat);
                    continue;
                }
            }

            $cache = array();
            foreach ($collection as $cat) {
                $cache[strtolower($cat->getNamePath())] = $cat;
                $cat->unsNamePath();
            }
            $this->_categoryCache[$store->getId()] = $cache;
        }
        $cache = & $this->_categoryCache[$store->getId()];

        $catIds = array();
        foreach (explode(',', $categories) as $categoryPathStr) {
            $categoryPathStr = preg_replace('#s*/s*#', '/', trim($categoryPathStr));
            if (!empty($cache[$categoryPathStr])) {
                $catIds[] = $cache[$categoryPathStr]->getId();
                continue;
            }
            $path = $rootPath;
            $namePath = '';
            foreach (explode('/', $categoryPathStr) as $catName) {
                $namePath .= (empty($namePath) ? '' : '/') . strtolower($catName);
                if (empty($cache[$namePath])) {
                    $cat = Mage :: getModel('catalog/category')
                        ->setStoreId($store->getId())
                        ->setPath($path)
                        ->setName($catName)
                        ->setIsActive(1)
                        ->save();
                    $cache[$namePath] = $cat;
                }
                $catId = $cache[$namePath]->getId();
                $path .= '/' . $catId;
            }
            if ($catId) {
                $catIds[] = $catId;
            }
        }
        return join(',', $catIds);
    }

    protected function _removeFile($file)

    {
        if (file_exists($file)) {
            if (unlink($file)) {
                return true;
            }
        }
        return false;
    }
}
    
