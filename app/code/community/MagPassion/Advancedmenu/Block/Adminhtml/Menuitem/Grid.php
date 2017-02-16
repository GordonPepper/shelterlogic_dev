<?php
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Menu Item admin grid block
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		parent::__construct();
		$this->setId('menuitemGrid');
		$this->setDefaultSort('entity_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
	}
	/**
	 * prepare collection
	 * @access protected
	 * @return MagPassion.com_Block_Adminhtml_Menuitem_Grid
	 * @author MagPassion.com
	 */
	protected function _prepareCollection(){
		$collection = Mage::getModel('advancedmenu/menuitem')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	/**
	 * prepare grid collection
	 * @access protected
	 * @return MagPassion.com_Block_Adminhtml_Menuitem_Grid
	 * @author MagPassion.com
	 */
	protected function _prepareColumns(){
		$this->addColumn('entity_id', array(
			'header'	=> Mage::helper('advancedmenu')->__('Id'),
			'index'		=> 'entity_id',
			'type'		=> 'number'
		));
		$menugroups = Mage::getResourceModel('advancedmenu/menugroup_collection')->toOptionHash();
		$this->addColumn('menugroup_id', array(
			'header'	=> Mage::helper('advancedmenu')->__('Menu Group'),
			'index'		=> 'menugroup_id',
			'type'		=> 'options',
			'options'	=> $menugroups
		));
		$this->addColumn('title', array(
			'header'=> Mage::helper('advancedmenu')->__('Title'),
			'index' => 'title',
			'type'	 	=> 'text',

		));
		$this->addColumn('url', array(
			'header'=> Mage::helper('advancedmenu')->__('Url'),
			'index' => 'url',
			'type'	 	=> 'text',

		));
		$this->addColumn('category', array(
			'header'=> Mage::helper('advancedmenu')->__('Category'),
			'index' => 'category',
			'type'	 	=> 'text',

		));
		$this->addColumn('parent_item', array(
			'header'=> Mage::helper('advancedmenu')->__('Parent Item'),
			'index' => 'parent_item',
			'type'	 	=> 'text',

		));
		$this->addColumn('menuorder', array(
			'header'=> Mage::helper('advancedmenu')->__('Order'),
			'index' => 'menuorder',
			'type'	 	=> 'text',

		));
		$this->addColumn('status', array(
			'header'	=> Mage::helper('advancedmenu')->__('Status'),
			'index'		=> 'status',
			'type'		=> 'options',
			'options'	=> array(
				'1' => Mage::helper('advancedmenu')->__('Enabled'),
				'0' => Mage::helper('advancedmenu')->__('Disabled'),
			)
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header'=> Mage::helper('advancedmenu')->__('Store Views'),
				'index' => 'store_id',
				'type'  => 'store',
				'store_all' => true,
				'store_view'=> true,
				'sortable'  => false,
				'filter_condition_callback'=> array($this, '_filterStoreCondition'),
			));
		}
		$this->addColumn('created_at', array(
			'header'	=> Mage::helper('advancedmenu')->__('Created at'),
			'index' 	=> 'created_at',
			'width' 	=> '120px',
			'type'  	=> 'datetime',
		));
		$this->addColumn('updated_at', array(
			'header'	=> Mage::helper('advancedmenu')->__('Updated at'),
			'index' 	=> 'updated_at',
			'width' 	=> '120px',
			'type'  	=> 'datetime',
		));
		$this->addColumn('action',
			array(
				'header'=>  Mage::helper('advancedmenu')->__('Action'),
				'width' => '100',
				'type'  => 'action',
				'getter'=> 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('advancedmenu')->__('Edit'),
						'url'   => array('base'=> '*/*/edit'),
						'field' => 'id'
					)
				),
				'filter'=> false,
				'is_system'	=> true,
				'sortable'  => false,
		));
		$this->addExportType('*/*/exportCsv', Mage::helper('advancedmenu')->__('CSV'));
		$this->addExportType('*/*/exportExcel', Mage::helper('advancedmenu')->__('Excel'));
		$this->addExportType('*/*/exportXml', Mage::helper('advancedmenu')->__('XML'));
		return parent::_prepareColumns();
	}
	/**
	 * prepare mass action
	 * @access protected
	 * @return MagPassion.com_Block_Adminhtml_Menuitem_Grid
	 * @author MagPassion.com
	 */
	protected function _prepareMassaction(){
		$this->setMassactionIdField('entity_id');
		$this->getMassactionBlock()->setFormFieldName('menuitem');
		$this->getMassactionBlock()->addItem('delete', array(
			'label'=> Mage::helper('advancedmenu')->__('Delete'),
			'url'  => $this->getUrl('*/*/massDelete'),
			'confirm'  => Mage::helper('advancedmenu')->__('Are you sure?')
		));
		$this->getMassactionBlock()->addItem('status', array(
			'label'=> Mage::helper('advancedmenu')->__('Change status'),
			'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
			'additional' => array(
				'status' => array(
						'name' => 'status',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => Mage::helper('advancedmenu')->__('Status'),
						'values' => array(
								'1' => Mage::helper('advancedmenu')->__('Enabled'),
								'0' => Mage::helper('advancedmenu')->__('Disabled'),
						)
				)
			)
		));
		$values = Mage::getResourceModel('advancedmenu/menugroup_collection')->toOptionHash();
		$values = array_reverse($values, true); 
		$values[''] = ''; 
		$values = array_reverse($values, true);
		$this->getMassactionBlock()->addItem('menugroup_id', array(
			'label'=> Mage::helper('advancedmenu')->__('Change Menu Group'),
			'url'  => $this->getUrl('*/*/massMenugroupId', array('_current'=>true)),
			'additional' => array(
				'flag_menugroup_id' => array(
						'name' => 'flag_menugroup_id',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => Mage::helper('advancedmenu')->__('Menu Group'),
						'values' => $values
				)
			)
		));
		return $this;
	}
	/**
	 * get the row url
	 * @access public
	 * @param MagPassion.com_Model_Menuitem
	 * @return string
	 * @author MagPassion.com
	 */
	public function getRowUrl($row){
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
	/**
	 * get the grid url
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getGridUrl(){
		return $this->getUrl('*/*/grid', array('_current'=>true));
	}
	/**
	 * after collection load
	 * @access protected
	 * @return MagPassion.com_Block_Adminhtml_Menuitem_Grid
	 * @author MagPassion.com
	 */
	protected function _afterLoadCollection(){
		$this->getCollection()->walk('afterLoad');
		parent::_afterLoadCollection();
	}
	/**
	 * filter store column
	 * @access protected
	 * @param MagPassion.com_Model_Resource_Menuitem_Collection $collection
	 * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
	 * @return MagPassion.com_Block_Adminhtml_Menuitem_Grid
	 * @author MagPassion.com
	 */
	protected function _filterStoreCondition($collection, $column){
		if (!$value = $column->getFilter()->getValue()) {
        	return;
		}
		$collection->addStoreFilter($value);
		return $this;
    }
}