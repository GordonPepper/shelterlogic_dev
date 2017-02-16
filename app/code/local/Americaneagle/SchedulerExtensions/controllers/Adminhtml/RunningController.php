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
    public function deleteAction()
    {
        $ids = $this->getRequest()->getParam('schedule_ids');
        foreach ($ids as $id) {
            Mage::getModel('cron/schedule')->load($id)
                ->delete();
        }
        $message = $this->__('Deleted task(s) "%s"', implode(', ', $ids));
        $this->_getSession()->addSuccess($message);
        if ($logFile = Mage::getStoreConfig('system/cron/logFile')) {
            Mage::log($message, null, $logFile);
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Mass action: kill
     *
     * @return void
     */
    public function errorAction()
    {
        $ids = $this->getRequest()->getParam('schedule_ids');
        foreach ($ids as $id) {
            $schedule = Mage::getModel('cron/schedule'); /* @var $schedule Aoe_Scheduler_Model_Schedule */
            $schedule->load($id)
                ->setStatus(Mage_Cron_Model_Schedule::STATUS_ERROR)
                ->save();
        }
        $message = $this->__('Error status saved for task(s) "%s"', implode(', ', $ids));
        $this->_getSession()->addSuccess($message);
        if ($logFile = Mage::getStoreConfig('system/cron/logFile')) {
            Mage::log($message, null, $logFile);
        }
        $this->_redirect('*/*/index');
    }

    public function removeLockAction() {
        $files = scandir('/tmp');
        foreach ($files as $file) {
            if(0 === strpos($file, 'magento.aoe_scheduler')){
                $path = sprintf("/tmp/%s/", $file);
                if(true === rmdir($path)) {
                    $this->_getSession()->addSuccess("Lock directory ${path} removed.");
                } else {
                    $this->_getSession()->addError("Lock directory ${path} was not removed!");
                }
            }
        }

        $this->_redirect('*/*/index');
    }
}