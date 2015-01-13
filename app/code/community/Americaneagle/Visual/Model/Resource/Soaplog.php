<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/26/14
 * Time: 2:42 PM
 */

class Americaneagle_Visual_Model_Resource_Soaplog extends Mage_Core_Model_Resource_Db_Abstract {
	/**
	 * Resource initialization
	 */
	protected function _construct() {
		$this->_init('americaneagle_visual/soaplog', 'soaplog_id');
	}

} 