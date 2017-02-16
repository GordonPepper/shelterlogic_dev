<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 10:12 AM
 */

class Americaneagle_SchedulerExtensions_Model_Cronlog extends Mage_Core_Model_Abstract
{
    public function _construct() {
        $this->_init('americaneagle_schedulerExtensions/cronlog');
    }

    /**
     * @param int $id
     * @param null $field
     * @return $this
     */
    public function load($id, $field = null)
    {
        $this->setData($this->getResourceCollection()->getItemByColumnValue('job_code', $id)->getData());
        return $this;
    }

    public function getFileContents() {
        $file = implode(DIRECTORY_SEPARATOR, array($this->getPath(), $this->getFilename()));

        return file($file);
    }
    public function delete() {
        $file = implode(DIRECTORY_SEPARATOR, array($this->getPath(), $this->getFilename()));

        unlink($file);
    }
    public function getPath()
    {
        $parts = array(Mage::getBaseDir('var'), 'log');
        if(!$this->getIsMainLog()) {
            $parts[] = 'cron';
        }
        return implode(DIRECTORY_SEPARATOR, $parts);
    }
}