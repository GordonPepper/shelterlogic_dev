<?php
class Aumd_Morecc_Block_Adminhtml_Morecc extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_morecc';
    $this->_blockGroup = 'morecc';
    $this->_headerText = Mage::helper('morecc')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('morecc')->__('Add Item');
    parent::__construct();
  }
}