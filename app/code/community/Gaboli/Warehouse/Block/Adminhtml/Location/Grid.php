<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Location_Grid
 */
class Gaboli_Warehouse_Block_Adminhtml_Location_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init - prepare widget grid.
     */
    public function __construct()
    {
        parent::__construct();

        // Set some defaults for our grid

        $this->setDefaultSort('id');
        $this->setId('LocationGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    /**
     * Set this widget grid's collection to be a collection of locations then let parent prepare grid object collection.
     *
     * @return Gaboli_Warehouse_Block_Adminhtml_Location_Grid
     */
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel('gaboli_warehouse/location_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Add all necessary columns then prepare for rendering.
     *
     * @return Gaboli_Warehouse_Block_Adminhtml_Location_Grid
     */
    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('id',
                         array(
                             'header' => Mage::helper('gaboli_warehouse')->__('ID'),
                             'align'  => 'right',
                             'width'  => '50px',
                             'index'  => 'id'
                         )
        );

        $this->addColumn('name',
                         array(
                             'header' => Mage::helper('gaboli_warehouse')->__('Name'),
                             'index'  => 'name',
                         )
        );

        $this->addColumn('address',
                         array(
                             'header' => Mage::helper('gaboli_warehouse')->__('Address'),
                             'index'  => 'address',
                         )
        );

        $this->addColumn('country_id', array(
            'header' => Mage::helper('gaboli_warehouse')->__('Country'),
            'width'  => '100',
            'type'   => 'country',
            'index'  => 'country_id',
        ));

        $this->addColumn('store_id', array(
            'header'     => Mage::helper('gaboli_warehouse')->__('Store'),
            'index'      => 'store_id',
            'type'       => 'store',
            'store_all'  => false,
            'store_view' => false,
            'sortable'   => false,
            'filter'     => false
        ));


        $this->addColumn('status',
                         array(
                             'header'  => Mage::helper('gaboli_warehouse')->__('Status'),
                             'index'   => Mage::helper('gaboli_warehouse')->__('status'),
                             'type'    => 'options',
                             'options' => array(
                                 0 => Mage::helper('gaboli_warehouse')->__('Disabled'),
                                 1 => Mage::helper('gaboli_warehouse')->__('Enabled'),
                             ),
                         )
        );


        return parent::_prepareColumns();
    }

    /**
     * Define identifier field and options for mass actions.
     *
     * @return $this|Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('gaboli_warehouse');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'   => Mage::helper('gaboli_warehouse')->__('Delete'),
            'url'     => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('gaboli_warehouse')->__('Are you sure?')
        ));

        $statuses = array(
            1 => Mage::helper('gaboli_warehouse')->__('Enabled'),
            0 => Mage::helper('gaboli_warehouse')->__('Disabled')
        );
        $this->getMassactionBlock()->addItem('status', array(
            'label'      => Mage::helper('gaboli_warehouse')->__('Change status'),
            'url'        => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name'   => 'status',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('gaboli_warehouse')->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        return $this;
    }

    /**
     * Get edit URL for clicking on a row.
     *
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * After the collection is loaded call it's afterLoad method on each item.
     *
     * @return Gaboli_Warehouse_Block_Adminhtml_Location_Grid
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
