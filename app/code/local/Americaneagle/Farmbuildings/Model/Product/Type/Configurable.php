<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/15/14
 * Time: 8:34 AM
 */
class Americaneagle_Farmbuildings_Model_Product_Type_Configurable
	extends Mage_Catalog_Model_Product_Type_Configurable {

	public function isSalable($product = null){
		return true;
	}
	public function hasOptions($product = null){
		if ($this->getProduct($product)->getOptions()) {
			return true;
		}

		//$attributes = $this->getConfigurableAttributes($product);
		return true;
//		if (count($attributes)) {
//			foreach ($attributes as $attribute) {
//				/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $attribute */
//				if ($attribute->getData('prices')) {
//					return true;
//				}
//			}
//		}

		return false;
	}

	public function getConfigurableAttributes($product = null) {
		//Mage::log('returning from ' . __METHOD__);
		if (!$this->getProduct($product)->hasData($this->_configurableAttributes)) {
			/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $collection */
			//$collection = Mage::getResourceModel('catalog/product_type_configurable_attribute_collection');
			//$collection = new Varien_Db_Collection();
			//Mage_Core_Model_Resource_Db_Collection_Abstract
			$collection = Mage::getResourceModel('americaneagle_farmbuildings/attribute_collection');

//			$collection->addFieldToFilter('product_id', array('eq' => '22926'));
//			$collection->load();
			/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
			$conn = $collection->getConnection();

			/** @var Varien_Db_Select $select */
			$select = $conn->select();

			$select->from(array('super_attribute' => $conn->getTableName('catalog_product_super_attribute')), '*')
				->where('super_attribute.product_id = ?', '22926')
				->order('position');

			$res = $conn->fetchAll($select);

			foreach ($res as $row) {
				/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
				$att = Mage::getModel('catalog/product_type_configurable_attribute');
				$att->setData($row);
				$patt = Mage::getResourceModel('catalog/eav_attribute')->load($row['attribute_id']);
				$att->setData('product_attribute', $patt);
				$collection->addItem($att);
			}

			$collection->setIsLoaded(true);
			$this->getProduct($product)->setData($this->_configurableAttributes, $collection);
		}
		Varien_Profiler::stop('CONFIGURABLE:' . __METHOD__);
		return $this->getProduct($product)->getData($this->_configurableAttributes);
	}


	public function orig_getConfigurableAttributes($product = null) {
		Mage::log('returning from ' . __METHOD__);
		/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $collection */
		$collection = Mage::getResourceModel('catalog/product_type_configurable_attribute_collection');

		//$collection->addItem(new ());

		/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
		$att = Mage::getModel('catalog/product_type_configurable_attribute');

		//return;
		Varien_Profiler::start('CONFIGURABLE:' . __METHOD__);
		if (!$this->getProduct($product)->hasData($this->_configurableAttributes)) {
			$configurableAttributes = $this->getConfigurableAttributeCollection($product)
				->orderByPosition()
				->load();
			$this->getProduct($product)->setData($this->_configurableAttributes, $configurableAttributes);
		}
		Varien_Profiler::stop('CONFIGURABLE:' . __METHOD__);
		return $this->getProduct($product)->getData($this->_configurableAttributes);
	}

} 