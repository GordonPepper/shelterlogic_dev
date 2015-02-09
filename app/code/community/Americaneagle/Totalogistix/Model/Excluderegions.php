<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 2/9/15
 * Time: 4:14 PM
 */

class Americaneagle_Totalogistix_Model_Excluderegions {
	public function toOptionArray() {
		$h=Mage::helper('americaneagle_totalogistix');
		$allRegions = array();
		$rm = Mage::getSingleton('directory/region');
		$rm->setData('americaneagle_totalogistics_select_all', 1);

		$countryIds = array();

		$countryCollection = Mage::helper('directory/data')
			->getCountryCollection()->loadByStore(Mage::app()->getStore()->getId());
		foreach ($countryCollection as $country) {
			$countryIds[] = $country->getCountryId();
		}

		$collection = $rm->getResourceCollection()
			->addCountryFilter($countryIds)
			->load();

		foreach($collection as $region) {
			$allRegions[] = array('value' => $region->getCode(), 'label' => $region->getDefaultName());
		}
		return $allRegions;

	}

}