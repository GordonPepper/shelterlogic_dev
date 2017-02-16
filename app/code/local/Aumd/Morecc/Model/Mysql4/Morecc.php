<?php

class Aumd_Morecc_Model_Mysql4_Morecc extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the morecc_id refers to the key field in your database table.
        $this->_init('morecc/morecc', 'morecc_id');
    }
}