<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/26/14
 * Time: 2:58 PM
 */

class Americaneagle_Visual_Model_Soaplog extends Mage_Core_Model_Abstract {
	public function _construct()
	{
		$this->_init('americaneagle_visual/soaplog');
	}


	public function getFormattedRequestData() {

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($this->getRequestData());
		return htmlentities($dom->saveXML());
	}
	public function getFormattedResponseData() {

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($this->getResponseData());
		return htmlentities($dom->saveXML());
	}

} 