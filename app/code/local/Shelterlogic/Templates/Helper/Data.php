<?php
class Shelterlogic_Templates_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_catNameCache = array();

    /**
     * @param Mage_Catalog_Model_Product $product
     */
    public function getCategoryName($product)
    {
        $catIds = $product->getAvailableInCategories();
        $catName = '';
        if ($catIds) {
            if (!isset($this->_catNameCache[$catIds[0]])) {
                $this->_catNameCache[$catIds[0]] = Mage::getModel('catalog/category')->load($catIds[0])->getName();
            }
            $catName = $this->_catNameCache[$catIds[0]];
        }

        return $catName;
    }
}