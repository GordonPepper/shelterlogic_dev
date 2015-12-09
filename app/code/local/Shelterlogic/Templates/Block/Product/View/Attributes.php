<?php
class Shelterlogic_Templates_Block_Product_View_Attributes extends Mage_Catalog_Block_Product_View_Attributes
{
    public function getAdditionalData(array $excludeAttr = array())
    {
        $data = array();
        $product = $this->getProduct();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            /** @var Mage_Catalog_Model_Entity_Attribute $attribute */
            if ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode(), $excludeAttr)) {
                $attrCode = $attribute->getAttributeCode();
                if ($attribute->getSource() instanceof Mage_Eav_Model_Entity_Attribute_Source_Boolean) {
                    if (!$product->hasData($attrCode)) continue;
                } elseif (!$product->getData($attrCode)) {
                    continue;
                }

                $value = $attribute->getFrontend()->getValue($product);
                if ((string)$value == '') {
                    continue;
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = Mage::app()->getStore()->convertPrice($value, true);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = array(
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'code'  => $attribute->getAttributeCode()
                    );
                }
            }
        }
        return $data;
    }
}