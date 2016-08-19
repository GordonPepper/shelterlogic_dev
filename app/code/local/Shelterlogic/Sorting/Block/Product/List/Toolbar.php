<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 8/17/16
 * Time: 4:43 PM
 */
class Shelterlogic_Sorting_Block_Product_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{
    public function setCollection($collection)
    {
        parent::setCollection($collection);
        if ($this->getCurrentOrder()) {
            if ($this->getCurrentOrder() == 'bestseller') {
                $this->getCollection()->getSelect()->
                joinLeft('sales_flat_order_item AS sfoi',
                    'e.entity_id = sfoi.product_id',
                    'SUM(sfoi.qty_ordered) AS ordered_qty')->
                group('e.entity_id')->order('ordered_qty ' . $this->getCurrentDirectionReverse());
            } else {
                $this->getCollection()->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
            }
        }
        return $this;
    }

    public function getCurrentDirectionReverse()
    {
        if ($this->getCurrentDirection() == 'asc') {
            return 'desc';
        } elseif ($this->getCurrentDirection() == 'desc') {
            return 'asc';
        } else {
            return $this->getCurrentDirection();
        }
    }

    public function setDefaultOrder($field)
    {
        if (isset($this->_availableOrder[$field])) {
            $this->_availableOrder = array(
                'position' => $this->__('Recommended'),
                'bestseller' => $this->__('Best Selling'),
                'price' => $this->__('Price'),
            );
            $this->_orderField = $field;
        }
        return $this;
    }
}