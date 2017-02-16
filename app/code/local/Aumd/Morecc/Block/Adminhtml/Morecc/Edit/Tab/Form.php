<?php

class Aumd_Morecc_Block_Adminhtml_Morecc_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('morecc_form', array('legend'=>Mage::helper('morecc')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('morecc')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('morecc')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('morecc')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('morecc')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('morecc')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('morecc')->__('Content'),
          'title'     => Mage::helper('morecc')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getMoreccData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getMoreccData());
          Mage::getSingleton('adminhtml/session')->setMoreccData(null);
      } elseif ( Mage::registry('morecc_data') ) {
          $form->setValues(Mage::registry('morecc_data')->getData());
      }
      return parent::_prepareForm();
  }
}