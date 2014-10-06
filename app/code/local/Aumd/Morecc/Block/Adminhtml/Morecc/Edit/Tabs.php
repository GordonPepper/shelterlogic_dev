<?php

class Aumd_Morecc_Block_Adminhtml_Morecc_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('morecc_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('morecc')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('morecc')->__('Item Information'),
          'title'     => Mage::helper('morecc')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('morecc/adminhtml_morecc_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}