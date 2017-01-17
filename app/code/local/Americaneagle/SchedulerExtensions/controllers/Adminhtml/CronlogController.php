<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 8:12 AM
 */

class Americaneagle_SchedulerExtensions_Adminhtml_CronlogController
    extends Aoe_Scheduler_Controller_AbstractController {

    public function indexAction()
    {
        $this->checkHeartbeat();
        $this->loadLayout();
        $this->_setActiveMenu('system');
        $this->renderLayout();
    }
    public function viewAction() {
        $this->checkHeartbeat();
        $this->loadLayout();
        $this->_setActiveMenu('system');

        $this->renderLayout();
    }
    public function deleteAction()
    {
        $ids = $this->getRequest()->getParam('job_codes');
        $deleted = array();
        foreach ($ids as $id) {
            $model = Mage::getModel('americaneagle_schedulerExtensions/cronlog')->load($id);
            if($model->getIsMainLog()) {
                $this->_getSession()->addNotice(sprintf("Core log file %s cannot be deleted.", $model->getFilename()));
            } else {
                $this->_getSession()->addSuccess('job error file');
                $model->delete();
                $deleted[] = $id;
            }
        }
        $message = $this->__('Deleted log file(s) for job code(s) "%s"', implode(', ', $deleted));
        $this->_getSession()->addSuccess($message);
        if (($logFile = Mage::getStoreConfig('system/cron/logFile'))) {
            Mage::log($message, null, $logFile);
        }
        $this->_redirect('*/*/index');
    }

}