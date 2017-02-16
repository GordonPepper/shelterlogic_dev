<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 8/17/16
 * Time: 4:45 PM
 */

class Shelterlogic_Sorting_Model_Config extends Mage_Catalog_Model_Config
{
//    public function getAttributeUsedForSortByArray()
//    {
//        return array_merge(
//            parent::getAttributeUsedForSortByArray(),
//            array('qty_ordered' => Mage::helper('catalog')->__('Best Seller'))
//        );
//    }
    public function getAttributeUsedForSortByArray()
    {
        return array_merge(
            parent::getAttributeUsedForSortByArray(),
            array('qty_ordered' => Mage::helper('catalog')->__('Sold quantity'))
        );
    }

}