<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 8/17/16
 * Time: 4:48 PM
 */

class Shelterlogic_Sorting_Model_Resource_Product_Collection extends Mage_Catalog_Model_Resource_Product_Collection
{
//    protected function _getSelectCountSql($select = null, $resetLeftJoins = true)
//    {
//        $this->_renderFilters();
//        $countSelect = (is_null($select)) ?
//            $this->_getClearSelect() :
//            $this->_buildClearSelect($select);
//
//        if(count($countSelect->getPart(Zend_Db_Select::GROUP)) > 0) {
//            $countSelect->reset(Zend_Db_Select::GROUP);
//        }
//
//        $countSelect->columns('COUNT(DISTINCT e.entity_id)');
//        if ($resetLeftJoins) {
//            $countSelect->resetJoinLeft();
//        }
//        return $countSelect;
//    }
    protected function _getSelectCountSql($select = null, $resetLeftJoins = true)
    {
        $this->_renderFilters();
        $countSelect = (is_null($select)) ?
            $this->_getClearSelect() :
            $this->_buildClearSelect($select);

        if(count($countSelect->getPart(Zend_Db_Select::GROUP)) > 0) {
            $countSelect->reset(Zend_Db_Select::GROUP);
        }

        $countSelect->columns('COUNT(DISTINCT e.entity_id)');
        if ($resetLeftJoins) {
            $countSelect->resetJoinLeft();
        }
        return $countSelect;
    }
}