<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 2/9/15
 * Time: 3:06 PM
 */

class Americaneagle_Totalogistix_Model_Region_Collection
	extends Mage_Directory_Model_Resource_Region_Collection {

	protected function _initSelect(){
		parent::_initSelect();
		$rm = Mage::getSingleton('directory/region');
		if($rm->getAmericaneagleTotalogisticsSelectAll() == 1) {
			return $this;
		}

		$codes = explode(',', Mage::getStoreConfig('carriers/totalogistix/exclude_regions'));
		$this->addFieldToFilter('code', array('nin' => $codes));
		return $this;
	}
}