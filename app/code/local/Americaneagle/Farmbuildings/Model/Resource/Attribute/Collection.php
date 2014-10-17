<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/15/14
 * Time: 4:00 PM
 */

class Americaneagle_Farmbuildings_Model_Resource_Attribute_Collection
	extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('americaneagle_farmbuildings/product_type_configurable', 'catalog/product_type_configurable_attribute');
	}
	public function setIsLoaded($val){
		$this->_isCollectionLoaded = $val;
	}

} 