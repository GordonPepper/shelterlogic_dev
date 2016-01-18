<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/15/16
 * Time: 10:35 AM
 */ 
class Americaneagle_Farmbuildings_Helper_Catalog_Category extends Mage_Catalog_Helper_Category {
    public function canShow($category)
    {
        if (is_int($category)) {
            $category = Mage::getModel('catalog/category')->load($category);
        }

        if (!$category->getId()) {
            return false;
        }

        if (!$category->getIsActive()) {
            return false;
        }

        return true;
    }

}