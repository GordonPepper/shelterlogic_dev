<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/17/15
 * Time: 11:07 AM
 */
class Americaneagle_Totalogistix_Block_Adminhtml_Catalog_Product_Tab
extends Mage_Adminhtml_Block_Template
implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function _construct() {
        parent::_construct();
        $this->setTemplate('americaneagle/ltlshippment_tab.phtml');
    }

    public function getTabLabel() {
        return $this->__("LTL Shippment");
    }

    public function getTabTitle() {
        return $this->__("LTL Shippment");
    }

    public function canShowTab() {
        return true;
    }

    public function isHidden() {
        return false;
    }

    public function test(){
        /** @var Mage_Catalog_Model_Resource_Eav_Attribute $shipltl */
        $shipltl = $this->getProduct()->getAttributes()['ship_ltl'];
        /** @var Mage_Catalog_Model_Product $product */
        $product = $this->getProduct();
        $product->getOptions();
        return false;
    }
    public function getProduct()
    {
        return Mage::registry('product');
    }


}