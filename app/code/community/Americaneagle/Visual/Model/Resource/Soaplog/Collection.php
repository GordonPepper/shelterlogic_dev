<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/26/14
 * Time: 2:44 PM
 */

class Americaneagle_Visual_Model_Resource_Soaplog_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
	protected function _construct() {
		$this->_init('americaneagle_visual/soaplog');
	}
} 