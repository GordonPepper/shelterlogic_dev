<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/11/15
 * Time: 4:26 PM
 */
class Americaneagle_Farmbuildings_Block_Adminhtml_Config
extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config
{
    public function canShowTab() {
        if( in_array( $this->getProductId(), array('22926', '43814', '48739')) ) {
            return false;
        }
        return parent::canShowTab();
    }
}