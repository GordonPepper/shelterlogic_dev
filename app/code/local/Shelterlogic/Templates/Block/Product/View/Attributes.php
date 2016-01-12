<?php
class Shelterlogic_Templates_Block_Product_View_Attributes extends Mage_Catalog_Block_Product_View_Attributes
{
    protected $urlAttributes = array('scene7_manual', 'video_url');

    public function getAdditionalData(array $excludeAttr = array())
    {
        $data = array();
        $product = $this->getProduct();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            /** @var Mage_Catalog_Model_Entity_Attribute $attribute */
            $attrCode = $attribute->getAttributeCode();
            if ($attribute->getIsVisibleOnFront() && !in_array($attrCode, $excludeAttr)) {
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