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
        //$this->setTemplate('americaneagle/ltlshippment_tab.phtml');
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

    protected function _prepareLayout() {
        return parent::_prepareLayout();

    }

    protected function _toHtml() {
        /** @var Americaneagle_Totalogistix_Block_Adminhtml_Catalog_Product_Form $block */
        $block = $this->getLayout()->createBlock('americaneagle_totalogistix/adminhtml_catalog_product_form', 'adminhtml.catalog.product.edit.tab.tlx');
        $form = new Varien_Data_Form();

        // Initialize product object as form property to use it during elements generation
        $form->setDataObject(Mage::registry('product'));
        $fieldset = $form->addFieldset('group_fields_tlx', array(
            'legend' => Mage::helper('catalog')->__('generic form legend'),
            'class' => 'fieldset-wide'
        ));

        $block->setFieldset(array($this->getProduct()->getAttributes()['ship_ltl']), $fieldset);
        $values = Mage::registry('product')->getData();

        // Set default attribute values for new product
        if (!Mage::registry('product')->getId()) {
            foreach (array() as $attribute) {
                if (!isset($values[$attribute->getAttributeCode()])) {
                    $values[$attribute->getAttributeCode()] = $attribute->getDefaultValue();
                }
            }
        }

        if (Mage::registry('product')->hasLockedAttributes()) {
            foreach (Mage::registry('product')->getLockedAttributes() as $attribute) {
                $element = $form->getElement($attribute);
                if ($element) {
                    $element->setReadonly(true, true);
                }
            }
        }
        $form->addValues($values);
        $form->setFieldNameSuffix('product');

        Mage::dispatchEvent('adminhtml_catalog_product_edit_prepare_form', array('form' => $form));

        $block->setForm($form);


        return $block->toHtml();

        /** @var OnePica_AvaTax_Model_Admin_Session $session */
//        $session = Mage::getSingleton('admin/session');
//        $allowed = $session->isAllowed('catalog/attributes/attributes');
//        $block = $this->getLayout()->createBlock('adminhtml/catalog_form', 'adminhtml.catalog.product.edit.tab.tlx');
//        $group = new Varien_Object();
//        $group->setId('tlx_shipping_tab');
//        $group->setAttributeGroupName('My Tab Name');
//        $block->setGroup($group);
//        $block->setGroupAttributes(array(''));
//        return $block->toHtml();
    }


}