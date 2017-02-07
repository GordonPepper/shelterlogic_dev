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
    const CONFIG_FORCE_WAREHOUSE_ID = 'aevisual/general/force_warehouse';
	const CONFIG_WAREHOUSE_ID = 'aevisual/general/warehouse_id';
	const CONFIG_FOB = 'aevisual/general/fob';
	const CONFIG_GENERAL_GROUP_ID = 'aevisual/general/general_group_id';
	const CONFIG_EXCLUSIVE_GROUP_ID = 'aevisual/general/exclusive_group_id';

	const CONFIG_SOAPLOG_ENABLE = 'aevisual/logging/soaplog_enable';
	const CONFIG_SOAPLOG_TTL = 'aevisual/logging/soaplog_ttl';

	const CONFIG_PUSH_FAIL_EMAIL = 'aevisual/logging/pushfail_email';
	const CONFIG_PUSH_FAIL_FROM_NAME = 'trans_email/ident_general/name';
	const CONFIG_PUSH_FAIL_FROM_EMAIL = 'trans_email/ident_general/email';

	const CONFIG_TLX_LEAD_TIME = 'carriers/totalogistix/lead_time';


	/** @var  Mage_Core_Model_Store store */
	private $store;

	public function getSoaplogTtl() {
		return Mage::getStoreConfig(self::CONFIG_SOAPLOG_TTL, $this->store);
	}

	/* This call should not be in this helper. consider moving */
	public function getLeadTimeDate($d){
		$lead = Mage::getStoreConfig(self::CONFIG_TLX_LEAD_TIME, $this->store);
		return (new DateTime($d))->add(new DateInterval("P{$lead}D"));
	}
	public function getServiceHost() {
		return Mage::getStoreConfig(self::CONFIG_SERVICE_PATH, $this->store);
	}
	public function getSoaplogEnable() {
		return Mage::getStoreConfig(self::CONFIG_SOAPLOG_ENABLE, $this->store);
	}
	public function getEnabled(){
		return Mage::getStoreConfig(self::CONFIG_ENABLED, $this->store);
	}
	public function getServiceKey() {
		return Mage::getStoreConfig(self::CONFIG_SERVICE_KEY, $this->store);
	}
	public function getExternalRefGroup() {
		return Mage::getStoreConfig(self::CONFIG_EXTERNAL_REF_GROUP, $this->store);
	}
	public function getCurrencyId() {
		return Mage::getStoreConfig(self::CONFIG_CURRENCY_ID, $this->store);
	}
	public function getSiteId() {
		return Mage::getStoreConfig(self::CONFIG_SITE_ID, $this->store);
	}
	public function getTermsId() {
		return Mage::getStoreConfig(self::CONFIG_TERMS_ID, $this->store);
	}
	public function getEntityId() {
		return Mage::getStoreConfig(self::CONFIG_ENTITY_ID, $this->store);
	}
	public function getCustomerId() {
		return Mage::getStoreConfig(self::CONFIG_CUSTOMER_ID, $this->store);
	}
	public function getPartId() {
		return Mage::getStoreConfig(self::CONFIG_PART_ID, $this->store);
	}
	public function getSalesRepId() {
		return Mage::getStoreConfig(self::CONFIG_SALES_REP_ID, $this->store);
	}
	public function getTerritoryId() {
		return Mage::getStoreConfig(self::CONFIG_TERRITORY_ID, $this->store);
	}
    public function getForceWarehouseID() {
        return Mage::getStoreConfig(self::CONFIG_FORCE_WAREHOUSE_ID, $this->store);
    }
    public function getWarehouseId() {
		$id = Mage::getStoreConfig(self::CONFIG_WAREHOUSE_ID, $this->store);
		$options = Mage::getModel('americaneagle_visual/system_config_source_warehouse')
            ->getOptions();
		return $options[$id];
	}
	public function getFob(){
		return Mage::getStoreConfig(self::CONFIG_FOB, $this->store);
	}
	public function getGeneralGroupId(){
		return Mage::getStoreConfig(self::CONFIG_GENERAL_GROUP_ID, $this->store);
	}
	public function getExclusiveGroupId(){
		return Mage::getStoreConfig(self::CONFIG_EXCLUSIVE_GROUP_ID, $this->store);
	}
	public function getPushFailEmail(){
		return Mage::getStoreConfig(self::CONFIG_PUSH_FAIL_EMAIL, $this->store);
	}
	public function getPushFailFromName(){
		return Mage::getStoreConfig(self::CONFIG_PUSH_FAIL_FROM_NAME, $this->store);
	}
	public function getPushFailFromEmail(){
		return Mage::getStoreConfig(self::CONFIG_PUSH_FAIL_FROM_EMAIL, $this->store);
	}

	public function stripCarrierCode($code) {
		$parts = explode('_', $code);
		if(count($parts) > 1) {
			array_shift($parts);
		}
		return implode('_', $parts);
	}

	/**
	 * @param Mage_Core_Model_Store $store
	 */
	public function setStore($store)
	{
		$this->store = $store;
        return $this;
	}

}