<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 12/5/14
 * Time: 12:20 PM
 */

class Americaneagle_Visual_Block_Adminhtml_Soaplog_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	private $helper;
	public function __construct()
	{
		parent::__construct();
		$this->setId('ae_soaplog_grid');
		//$this->setUseAjax(true);
		$this->setDefaultSort('datetime');
		$this->setDefaultDir('DESC');
		$this->setSaveParametersInSession(true);
		$this->helper = Mage::helper('americaneagle_visual');
	}

	protected function _getCollectionClass() {
		return 'americaneagle_visual/soaplog_collection';
	}

	protected function _prepareCollection() {
		$this->setCollection(Mage::getResourceModel($this->_getCollectionClass()));
		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this->addColumn('soaplog_id', array(
			'header' => $this->helper->__('Log Id'),
			'index' => 'soaplog_id',
			'type' => 'text'
		));
		$this->addColumn('code', array(
			'header' => $this->helper->__('Code'),
			'index' => 'code',
			'type' => 'text'
		));
		$this->addColumn('datetime', array(
			'header' => $this->helper->__('Create Date'),
			'index' => 'datetime',
			'type' => 'datetime'
		));
		$this->addColumn('message', array(
			'header' => $this->helper->__('Message'),
			'index' => 'message',
			'type' => 'text'
		));

		return parent::_prepareColumns();
	}
	public function getRowUrl($row)
	{

		return $this->getUrl('*/*/view',
			array(
				'soaplog_id'=> $row->getId(),
			)
		);
	}

} 