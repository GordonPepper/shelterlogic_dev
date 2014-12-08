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
	const CONFIG_SOAPLOG_ENABLE = 'aevisual/general/soaplog_enable';
	const CONFIG_SERVICE_KEY = 'aevisual/general/service_key';

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
} 