<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 10:06 AM
 */

class Americaneagle_SchedulerExtensions_Block_Adminhtml_Cronlog_View
extends Mage_Adminhtml_Block_Widget_Container
{
    private $logFile;
    /**
     * Americaneagle_SchedulerExtensions_Block_Adminhtml_Cronlog_View constructor.
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        parent::__construct($args);
    }
    public function getHeaderText() {
        return $this->__('Log Contents');
    }
    protected function _prepareLayout() {
        $this->_addButton('back', array(
            'label'   => 'Back',
            'onclick' => "setLocation('" . $this->getUrl('*/*/index') . "')",
            'class'   => 'back'
        ));

        return parent::_prepareLayout();
    }
    public function getLogFileName() {
        if(empty($this->logFile)){
            $this->setLogFile();
        }
        return $this->logFile->getFilename();
    }
    public function getLogContents() {
        return implode("\n", $this->logFile->getFileContents());
    }
    private function setLogFile() {
        $this->logFile = Mage::getModel('americaneagle_schedulerExtensions/cronlog');
        $this->logFile->load($this->getRequest()->getParam('job_code'));
    }
}