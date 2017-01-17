<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/17/17
 * Time: 8:17 AM
 */

class Americaneagle_SchedulerExtensions_Block_Adminhtml_Cronlog
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'americaneagle_schedulerExtensions';
        $this->_controller = 'adminhtml_cronlog';
        $this->_headerText = $this->__('Cronjob Logs');

        $this->removeButton('add');
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

}