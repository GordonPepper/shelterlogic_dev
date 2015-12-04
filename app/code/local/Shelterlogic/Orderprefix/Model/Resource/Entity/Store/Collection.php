<?php
class Shelterlogic_Orderprefix_Model_Resource_Entity_Store_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('eav/entity_store');
    }
}