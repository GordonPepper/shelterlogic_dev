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
    protected function _prepareCollection()
    {
        /** @var Mage_Cron_Model_Resource_Schedule_Collection $collection */
        $collection = Mage::getModel('cron/schedule')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $viewHelper = $this->helper('aoe_scheduler/data');

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
                'index'          => 'created_at',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'scheduled_at',
            array(
                'header'         => $this->__('Scheduled'),
                'index'          => 'scheduled_at',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'executed_at',
            array(
                'header'         => $this->__('Executed'),
                'index'          => 'executed_at',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'last_seen',
            array(
                'header'         => $this->__('Last seen'),
                'index'          => 'last_seen',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'eta',
            array(
                'header'         => $this->__('ETA'),
                'index'          => 'eta',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'finished_at',
            array(
                'header'         => $this->__('Finished'),
                'index'          => 'finished_at',
                'frame_callback' => array($viewHelper, 'decorateTimeFrameCallBack')
            )
        );
        $this->addColumn(
            'messages',
            array(
                'header'         => $this->__('Messages'),
                'index'          => 'messages',
                'frame_callback' => array($this, 'decorateMessages')
            )
        );
        $this->addColumn(
            'host',
            array(
                'header' => $this->__('Host'),
                'index'  => 'host',
            )
        );
        $this->addColumn(
            'pid',
            array(
                'header' => $this->__('Pid'),
                'index'  => 'pid',
                'width' => '50',
            )
        );
        $this->addColumn(
            'status',
            array(
                'header'         => $this->__('Status'),
                'index'          => 'status',
                'frame_callback' => array($viewHelper, 'decorateStatus'),
                'type'           => 'options',
                'options'        => Mage::getSingleton('cron/schedule')->getStatuses()
            )
        );

        return parent::_prepareColumns();
    }
    public function getGridUrl()
    {
        return $this->getUrl('adminhtml/scheduler/index', array('_current' => true));
    }

}