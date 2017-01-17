<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 8:19 AM
 */

class Americaneagle_SchedulerExtensions_Block_Adminhtml_Cronlog_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('cronlog_grid');
        $this->setUseAjax(false);
        $this->setDefaultSort('job_code');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('job_code');
        $this->getMassactionBlock()->setFormFieldName('job_codes');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => $this->__('Delete'),
                'url'   => $this->getUrl('*/*/delete'),
            )
        );
        return $this;
    }
    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getResourceModel('americaneagle_schedulerExtensions/cronlog_collection'));
    }
    protected function _prepareColumns()
    {
        $this->addColumn('label', array(
            'header' => 'Job Code',
            'index' => 'job_code',
            'type' => 'text'
        ));
        $this->addColumn('mod_date', array(
            'header' => 'Modification Date',
            'index' => 'mod_date',
            'type' => 'text'
        ));
        $this->addColumn('size', array(
            'header' => 'File Size',
            'index' => 'size',
            'type' => 'text'
        ));
        $this->addColumn('is_main_log', array(
            'header' => 'Core File',
            'index' => 'is_main_log',
            'type' => 'text'
        ));
        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('adminhtml/cronlog/index', array('_current' => true));
    }
    public function getRowUrl($item) {
        return $this->getUrl('*/*/view',
                             array(
                                 'job_code' => $item->getJobCode()
                             ));
    }

}