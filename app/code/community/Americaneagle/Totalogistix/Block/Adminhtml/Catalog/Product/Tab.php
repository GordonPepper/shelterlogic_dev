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
    }

    public function getTabLabel() {
        return $this->__("LTL Shipment");
    }

    public function getTabTitle() {
        return $this->__("LTL Shipment");
    }

    public function canShowTab() {
        return true;
    }

    public function isHidden() {
        return false;
    }

    protected function _toHtml() {
        /** @var Americaneagle_Totalogistix_Block_Adminhtml_Catalog_Product_Form $block */
        $block = $this->getLayout()->createBlock('americaneagle_totalogistix/adminhtml_catalog_product_form', 'adminhtml.catalog.product.edit.tab.tlx');
        $form = new Varien_Data_Form();

        $form->setDataObject(Mage::registry('product'));
        $fieldset = $form->addFieldset('group_fields_tlx', array(
            'legend' => Mage::helper('catalog')->__('TLX Shipping Settings'),
            'class' => 'fieldset-wide'
        ));

        $tlxAtts = array();
        foreach (array('tlx_ship_ltl', 'tlx_ship_length', 'tlx_ship_width', 'tlx_ship_height') as $item) {
            $a = Mage::registry('product')->getAttributes()[$item];
            $a->setIsVisible('1');
            $tlxAtts[] = $a;
        }

        $block->setFieldset($tlxAtts, $fieldset);

        $form->addValues(Mage::registry('product')->getData());

        $form->setFieldNameSuffix('product');

        $block->setForm($form);

        return $block->toHtml();

    }

}