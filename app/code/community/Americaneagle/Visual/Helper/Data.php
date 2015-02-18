<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 4:31 PM
 */

class Americaneagle_Visual_Helper_Data extends Mage_Core_Helper_Abstract {
	const CONFIG_ENABLED = 'aevisual/general/enabled';
	const CONFIG_SERVICE_PATH = 'aevisual/general/service_host';
	const CONFIG_SERVICE_KEY = 'aevisual/general/service_key';
	const CONFIG_EXTERNAL_REF_GROUP = 'aevisual/general/external_ref_group';
	const CONFIG_CURRENCY_ID = 'aevisual/general/currency_id';
	const CONFIG_SITE_ID = 'aevisual/general/site_id';
	const CONFIG_TERMS_ID = 'aevisual/general/terms_id';
	const CONFIG_ENTITY_ID = 'aevisual/general/entity_id';
	const CONFIG_CUSTOMER_ID = 'aevisual/general/customer_id';
	const CONFIG_PART_ID = 'aevisual/general/part_id';
	const CONFIG_SALES_REP_ID = 'aevisual/general/sales_rep_id';
	const CONFIG_TERRITORY_ID = 'aevisual/general/territory_id';
	const CONFIG_WAREHOUSE_ID = 'aevisual/general/warehouse_id';
	const CONFIG_FOB = 'aevisual/general/fob';

	const CONFIG_SOAPLOG_ENABLE = 'aevisual/logging/soaplog_enable';
	const CONFIG_SOAPLOG_TTL = 'aevisual/logging/soaplog_ttl';

	public function getSoaplogTtl() {
		return Mage::getStoreConfig(self::CONFIG_SOAPLOG_TTL);
	}

	/* This call should not be in this helper. consider moving */
	public function getLeadTimeDate($d){
		$lead = Mage::getStoreConfig('carriers/totalogistix/lead_time');
		return strtotime("$d + $lead days");
	}
	public function getServiceHost() {
		return Mage::getStoreConfig(self::CONFIG_SERVICE_PATH);
	}
	public function getSoaplogEnable() {
		return Mage::getStoreConfig(self::CONFIG_SOAPLOG_ENABLE);
	}
	public function getEnabled(){
		return Mage::getStoreConfig(self::CONFIG_ENABLED);
	}
	public function getServiceKey() {
		return Mage::getStoreConfig(self::CONFIG_SERVICE_KEY);
	}
	public function getExternalRefGroup() {
		return Mage::getStoreConfig(self::CONFIG_EXTERNAL_REF_GROUP);
	}
	public function getCurrencyId() {
		return Mage::getStoreConfig(self::CONFIG_CURRENCY_ID);
	}
	public function getSiteId() {
		return Mage::getStoreConfig(self::CONFIG_SITE_ID);
	}
	public function getTermsId() {
		return Mage::getStoreConfig(self::CONFIG_TERMS_ID);
	}
	public function getEntityId() {
		return Mage::getStoreConfig(self::CONFIG_ENTITY_ID);
	}
	public function getCustomerId() {
		return Mage::getStoreConfig(self::CONFIG_CUSTOMER_ID);
	}
	public function getPartId() {
		return Mage::getStoreConfig(self::CONFIG_PART_ID);
	}
	public function getSalesRepId() {
		return Mage::getStoreConfig(self::CONFIG_SALES_REP_ID);
	}
	public function getTerritoryId() {
		return Mage::getStoreConfig(self::CONFIG_TERRITORY_ID);
	}
	public function getWarehouseId() {
		return Mage::getStoreConfig(self::CONFIG_WAREHOUSE_ID);
	}
	public function getFob(){
		return Mage::getStoreConfig(self::CONFIG_FOB);
	}
	public function stripCarrierCode($code) {
		$parts = explode('_', $code);
		if(count($parts) > 1) {
			array_shift($parts);
		}
		return implode('_', $parts);
	}

}