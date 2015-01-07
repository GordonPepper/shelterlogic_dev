<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 9/24/14
 * Time: 4:05 PM
 */
class Americaneagle_Totalogistix_Helper_Data extends Mage_Core_Helper_Abstract {
	private $req;

	public function getPriceSheets(Mage_Shipping_Model_Rate_Request $request) {

		$this->req = $request;
		$xItems = new SimpleXMLElement('<Items></Items>');
		foreach ($request->getAllItems() as $item) {
			if ($item->getProductType() == 'simple') {
				$xitem = $xItems->addChild('Item');
				$xitem->addChild('Class', $item->getProduct()->load($item->getProduct()->getId())->getClass());
				$xitem->addChild('Weight', intval($item->getWeight()));
			}
		}

		$client = new Zend_Http_Client();
		$client->setUri($this->getServiceUri());
		$client->setParameterPost('szip', $this->getOriginZip());
		$client->setParameterPost('AccessID', $this->getAccessId());
		$client->setParameterPost('service', $this->getAccessorial());
		$client->setParameterPost('date', $this->getShipDate());
		$client->setParameterPost('czip', $request->getDestPostcode());
		$client->setParameterPost('items', $xItems->asXML());
		$client->setParameterPost('profile', $this->getProfile());

		Mage::log("TOTALogistix: Posting Accessorial: " . $this->getAccessorial());
		Mage::log("TOTALogistix: Posting XML: " . $xItems->asXML());

		$response = $client->request('POST');
		$xml = simplexml_load_string($response->getBody());
		$status = $xml->xpath('/Response')[0]->{"Status"};
		Mage::log('TOTALogistix: received status: ' . $status->asXML());
		if ($status === false) {
			Mage::logException("Failed to load response from TOTALogistix");
		}
		$prices = $xml->xpath('/Response/PriceSheet');
		if ($prices === false) {
			Mage::logException("Failed to load shipping price sheets");
		}
		$sheets = array();
		foreach ($prices as $price) {
			$ps = new Varien_Object();

			$ps->setCarrier((string)$price->{'Carrier'});
			$ps->setChargeAmount((string)$price->{'ChargeAmount'});
			$ps->setCarrierName((string)$price->{'CarrierName'});
			$ps->setErpShipCode((string)$price->{'ErpShipCode'});
			$sheets[] = $ps;
		}

		return $sheets;
	}

	private function getProfile() {
		return Mage::getStoreConfig('carriers/totalogistix/profile');
	}
	private function getAccessorial() {
		$vals = explode(',', Mage::getStoreConfig('carriers/totalogistix/accessorial'));
		if ($this->req->getIsResidential() == 1) {
			$vals[] = 'REP';
		}
		if ($this->req->getIsLimitedAccess() == 1) {
			$vals[] = 'LTD';
		}
		return implode(',', $vals);
	}

	private function getShipDate() {
		$lead = Mage::getStoreConfig('carriers/totalogistix/lead_time');
		$d = new Zend_Date();
		$d->add($lead, Zend_Date::DAY);
		return $d->toString('MM/dd/YYYY');    //	$client->setParameterGet('date', '10/10/2014');
	}

	private function getAccessId() {
		return Mage::getStoreConfig('carriers/totalogistix/access_id');
	}

	private function getOriginZip() {
		return Mage::getStoreConfig('carriers/totalogistix/origin_zip');
	}

	private function getServiceUri() {
		return Mage::getStoreConfig('carriers/totalogistix/service_url');
	}
}