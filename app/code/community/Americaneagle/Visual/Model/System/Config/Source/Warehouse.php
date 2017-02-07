<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 2/7/17
 * Time: 7:42 AM
 */

class Americaneagle_Visual_Model_System_Config_Source_Warehouse
{
    protected $_options;
    public function toOptionArray($isMultiselect = false) {
        if(!$this->_options){
            $this->_options = Mage::getResourceModel('gaboli_warehouse/location_collection')
                ->loadData()
                ->toOptionArray(false);
        }
        $options = $this->_options;
        if(!$isMultiselect){
            array_unshift($options, array('value'=>'', 'label'=> Mage::helper('adminhtml')->__('--Please Select--')));
        }

        return $options;

    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        $optArray = $this->toOptionArray(true);
        $options = [];
        foreach ($optArray as $item) {
            $options[$item['value']] = $item['label'];
        }
        return $options;
    }
}