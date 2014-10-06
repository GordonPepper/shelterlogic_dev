<?php

class Aumd_Morecc_Model_Mysql4_Morecc_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('morecc/morecc');
    }
}