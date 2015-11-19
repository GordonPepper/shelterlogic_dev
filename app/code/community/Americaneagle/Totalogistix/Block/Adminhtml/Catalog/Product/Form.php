<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/18/15
 * Time: 4:44 PM
 */
class Americaneagle_Totalogistix_Block_Adminhtml_Catalog_Product_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct() {
        parent::_construct();
    }
    public function setFieldset($attributes, $fieldset, $exclude=array()){
        $this->_setFieldset($attributes, $fieldset, $exclude);
    }

}