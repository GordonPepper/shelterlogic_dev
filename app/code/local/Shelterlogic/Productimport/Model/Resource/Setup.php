<?php
class Shelterlogic_Productimport_Model_Resource_Setup extends Mage_Catalog_Model_Resource_Setup
{
    public function addTextAttribute($attributeCode, $label, $attrSet, $attrGroup, $sortOrder = null, $params = array())
    {
        $params = array_merge(array(
            'type'                  => 'varchar',
            'input'                 => 'text',
            'label'                 => $label,
            'required'              => 0,
            'user_defined'          => 1,
            'global'                => 0,
        ), $params);

        $this->addAttribute('catalog_product', $attributeCode, $params);

        $this->addAttributeToGroup('catalog_product', $attrSet, $attrGroup, $attributeCode, $sortOrder);
    }

    public function addBooleanAttribute($attributeCode, $label, $attrSet, $attrGroup, $sortOrder = null, $params = array())
    {
        $params = array_merge(array(
            'type'                  => 'int',
            'backend'               => 'catalog/product_attribute_backend_boolean',
            'source'                => 'eav/entity_attribute_source_boolean',
            'input'                 => 'select',
            'label'                 => $label,
            'required'              => 0,
            'user_defined'          => 1,
            'global'                => 0,
            'default'               => 0,
        ), $params);

        $this->addAttribute('catalog_product', $attributeCode, $params);

        $this->addAttributeToGroup('catalog_product', $attrSet, $attrGroup, $attributeCode, $sortOrder);
    }
}