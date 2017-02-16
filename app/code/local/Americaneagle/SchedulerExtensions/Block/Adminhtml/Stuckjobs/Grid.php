<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 10/6/16
 * Time: 12:45 PM
 */


class Americaneagle_SchedulerExtensions_Block_Adminhtml_Stuckjobs_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('stuckjobs_grid');
        $this->setUseAjax(false);
        $this->setDefaultSort('scheduled_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Add mass-actions to grid
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('schedule_id');
        $this->getMassactionBlock()->setFormFieldName('schedule_ids');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => $this->__('Delete'),
                'url'   => $this->getUrl('*/*/delete'),
            )
        );
        $this->getMassactionBlock()->addItem(
            'error',
            array(
                'label' => $this->__('Error'),
                'url'   => $this->getUrl('*/*/error'),
            )
        );
        return $this;
    }

    protected function _prepareCollection()
    {
        /** @var Mage_Cron_Model_Resource_Schedule_Collection $collection */
        $collection = Mage::getModel('cron/schedule')->getCollection();
        $collection->addFieldToFilter('status', array('eq' => Mage_Cron_Model_Schedule::STATUS_RUNNING));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        //return parent::_prepareColumns();
        //$viewHelper = $this->helper('aoe_scheduler/data');

        $this->addColumn(
            'schedule_id',
            array(
                'header' => $this->__('Id'),
                'index'  => 'schedule_id',
            )
        );
        $this->addColumn(
            'job_code',
            array(
                'header'  => $this->__('Job'),
                'index'   => 'job_code',
                'type'    => 'options',
                'options' => Mage::getSingleton('aoe_scheduler/job')->getCollection()->toOptionHash('job_code', 'name')
            )
        );
        $this->addColumn(
            'created_at',
            array(
                'header'         => $this->__('Created'),
                'index'          => 'created_at'
            )
        );
        $this->addColumn(
            'scheduled_at',
            array(
                'header'         => $this->__('Scheduled'),
                'index'          => 'scheduled_at'
            )
        );
        $this->addColumn(
            'executed_at',
            array(
                'header'         => $this->__('Executed'),
                'index'          => 'executed_at'
            )
        );

        return parent::_prepareColumns();
    }
    public function getGridUrl()
    {
        return $this->getUrl('adminhtml/running/index', array('_current' => true));
    }

}