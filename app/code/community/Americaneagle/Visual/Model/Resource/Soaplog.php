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

	public function cleanSoaplog($days) {
		$readAdapter    = $this->_getReadAdapter();
		$writeAdapter = $this->_getWriteAdapter();

		while(intval($days) > 0) {
			/** @var Varien_Db_Select $select */
			$select = $readAdapter->select()
				->from(
					array('soaplog' => $this->getTable('americaneagle_visual/soaplog')),
					array('soaplog_id' => 'soaplog.soaplog_id'))
				->where('soaplog.datetime < DATE_ADD(UTC_TIMESTAMP, INTERVAL -? DAY)', intval($days))
				->limit(100);

			$ids = $readAdapter->fetchCol($select);

			if( ! $ids )
				break;

			$condition = array('soaplog_id IN (?)' => $ids);
			$writeAdapter->delete($this->getTable('americaneagle_visual/soaplog'), $condition);
		}
	}
} 