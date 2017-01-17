<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 8:27 AM
 */
class Americaneagle_SchedulerExtensions_Model_Resource_Cronlog_Collection
    extends Varien_Data_Collection
{
    public function __construct()
    {
        $vio = new Varien_Io_File();
        $dir = implode(DIRECTORY_SEPARATOR, array(Mage::getBaseDir('var'), 'log', 'cron'));
        $vio->open(array('path' => $dir));

        foreach ($vio->ls(Varien_Io_File::GREP_FILES) as $file) {
            $this->addItem(Mage::getResourceModel('americaneagle_schedulerExtensions/cronlog')
                               ->setData(array('job_code' => basename($file['text'],'.log'),
                                             'filename' => $file['text'],
                                             'size' => $file['size'],
                                             'mod_date' => $file['mod_date'])));
        }
        $vio->close();

        $dir = implode(DIRECTORY_SEPARATOR, array(Mage::getBaseDir('var'), 'log'));
        $vio->open(array('path' => $dir));
        foreach ($vio->ls(Varien_Io_File::GREP_FILES) as $file) {
            $this->addItem(Mage::getResourceModel('americaneagle_schedulerExtensions/cronlog')
                               ->setData(array('job_code' => basename($file['text'],'.log'),
                                             'filename' => $file['text'],
                                             'size' => $file['size'],
                                             'mod_date' => $file['mod_date'],
                                             'is_main_log' => true)));
        }
        $vio->close();
    }
}