<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 10/6/16
 * Time: 12:43 PM
 */



class Americaneagle_SchedulerExtensions_Block_Adminhtml_Stuckjobs
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'americaneagle_schedulerExtensions';
        $this->_controller = 'adminhtml_stuckjobs';
        $this->_headerText = $this->__('Running Tasks');
        parent::__construct();
    }

}