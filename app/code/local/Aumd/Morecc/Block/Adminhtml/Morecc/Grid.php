<?php

class Aumd_Morecc_Block_Adminhtml_Morecc_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('moreccGrid');
      $this->setDefaultSort('morecc_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('morecc/morecc')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('morecc_id', array(
          'header'    => Mage::helper('morecc')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'morecc_id',
      ));

      $this->addColumn('email', array(
          'header'    => Mage::helper('morecc')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));
 
		
      $this->addColumn('name', array(
          'header'    => Mage::helper('morecc')->__('Bill To'),
          'align'     =>'left',
          'index'     => 'name',
      ));
	  
		$this->addExportType('*/*/exportCsv', Mage::helper('morecc')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('morecc')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('morecc_id');
        $this->getMassactionBlock()->setFormFieldName('morecc');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('morecc')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('morecc')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('morecc/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('morecc')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('morecc')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}