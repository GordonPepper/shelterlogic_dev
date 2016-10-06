<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 10/6/16
 * Time: 10:56 AM
 */



class Americaneagle_SchedulerExtensions_Adminhtml_RunningController
    extends Aoe_Scheduler_Controller_AbstractController
{
    /**
     * Index action (display grid)
     *
     * @return void
     */
    public function indexAction() {
        $this->checkHeartbeat();

        $this->loadLayout();

        $this->_setActiveMenu('system');
        $this->renderLayout();
    }

}