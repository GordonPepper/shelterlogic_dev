<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 12/3/15
 * Time: 2:52 PM
 */
class Americaneagle_Totalogistix_Model_Import_Simple extends Mage_ImportExport_Model_Import_Entity_Product_Type_Simple
{
    protected function _initAttributes() {
        $this->_forcedAttributesCodes[] = 'tlx_ship_ltl';
        $this->_forcedAttributesCodes[] = 'tlx_pallet_weight';
        $this->_forcedAttributesCodes[] = 'tlx_ship_height';
        $this->_forcedAttributesCodes[] = 'tlx_ship_length';
        $this->_forcedAttributesCodes[] = 'tlx_ship_width';
        $this->_forcedAttributesCodes[] = 'class';
        return parent::_initAttributes(); // TODO: Change the autogenerated stub
    }
}