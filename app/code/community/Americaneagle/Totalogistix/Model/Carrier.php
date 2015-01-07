<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 9/26/14
 * Time: 1:48 PM
 */
class Americaneagle_Totalogistix_Model_Carrier
	extends Mage_Shipping_Model_Carrier_Abstract
	implements Mage_Shipping_Model_Carrier_Interface {
	protected $_code = 'totalogistix';

	/**
	 * Get allowed shipping methods
	 *
	 * @return array
	 */
	public function getAllowedMethods() {
		Mage::log('TOTALogistix: getAllowedMethods called');
		return array(
			'standard' => 'Standard delivery'
		);
	}

	/**
	 * Collect and get rates
	 *
	 * @param Mage_Shipping_Model_Rate_Request $request
	 * @return Mage_Shipping_Model_Rate_Result|bool|null
	 */
	public function collectRates(Mage_Shipping_Model_Rate_Request $request) {
		Mage::log('TOTALogistix: collectRates called');
		if (!$this->getConfigFlag('active')) {
			return false;
		}
		$result = Mage::getModel('shipping/rate_result');
		$prices = Mage::helper('americaneagle_totalogistix')->getPriceSheets($request);
		foreach($prices as $price) {
			$rate = Mage::getModel('shipping/rate_result_method');
			$rate->setCarrier($this->_code);
			$rate->setCarrierTitle($this->getConfigData('title'));
			$rate->setMethod($price->getErpShipCode());
			$rate->setMethodTitle($price->getCarrierName());
			$rate->setPrice($price->getChargeAmount());
			$result->append($rate);
		}
		return $result;

	}

} 