<?php
class Shelterlogic_Templates_Block_Product_View_Attributes extends Mage_Catalog_Block_Product_View_Attributes
{
    protected $urlAttributes = array('scene7_manual', 'video_url');

    public function getAdditionalData(array $excludeAttr = array())
    {
        $data = array();
        $product = $this->getProduct();
//        if($product->getAttributeSetId() == "10"){
//            return parent::getAdditionalData($excludeAttr);
//        }
        $attributes = $product->getAttributes();
        $parent = Mage::registry('searchProduct');

        foreach ($attributes as $attribute) {
            /** @var Mage_Catalog_Model_Entity_Attribute $attribute */
            $attrCode = $attribute->getAttributeCode();
            if ($attribute->getIsVisibleOnFront() && !in_array($attrCode, $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue($product);
                if ($attribute->getSource() instanceof Mage_Eav_Model_Entity_Attribute_Source_Boolean) {
                    if (!$product->hasData($attrCode)) {
                        if($parent && $parent->hasData($attrCode)){
                            $value = $attribute->getFrontend()->getValue($parent);
                        } else {
                            continue;
                        }
                    }
                } elseif (!$product->getData($attrCode)) {
                    if($parent && $parent->getData($attrCode)) {
                        $value = $attribute->getFrontend()->getValue($parent);
                    } else {
                        continue;
                    }
                }
                if ((string)$value == '') {
                    continue;
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = Mage::app()->getStore()->convertPrice($value, true);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attrCode] = array(
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'code'  => $attrCode
                    );
                }
            }
        }
        return $data;
    }

    public function isUrlAttribute($attrCode)
    {
        return in_array($attrCode, $this->urlAttributes);
    }
}