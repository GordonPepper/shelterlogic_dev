<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 8:26 AM
 */



class Americaneagle_SchedulerExtensions_Model_Resource_Cronlog
    extends Varien_Object
{
    protected $_idFieldName;

    public function _construct()
    {
        $this->_idFieldName = 'job_code';
    }

}