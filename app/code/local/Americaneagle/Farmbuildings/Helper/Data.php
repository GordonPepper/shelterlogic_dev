<?php

class Americaneagle_Farmbuildings_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getAttributeTree($product) {

		/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
		$conn = Mage::getSingleton('core/resource')->getConnection('core_read');

		/** @var Magento_Db_Adapter_Pdo_Mysql $select */
		$select = $conn->select();
		/** @var Varien_Db_Select $from */
		$atts = $product->getTypeInstance(true)->getConfigurableAttributes($product);
		$fields = array();
		$fields['id'] = 'e.entity_id';
		foreach($atts as $att) {
			$code = $att->getProductAttribute()->getAttributeCode();
			$fields[$code] = 'at_' . $code . '.value';
		}
		$from = $select->from(
			array('e' => $conn->getTableName('catalog_product_entity')),
			$fields
		);
		$from->joinInner(
			array('link_table' => $conn->getTableName('catalog_product_super_link')),
			'link_table.product_id = e.entity_id',
			array());
		$where = array();
		$where[] = 'link_table.parent_id = ' . $product->getId();
		$where[] = "((e.required_options != '1') OR (e.required_options IS NULL))";

		$attmap = array();
		foreach($atts as $att) {
			$alias = 'at_' . $att->getProductAttribute()->getAttributeCode();
			$attid = $att->getProductAttribute()->getId();
			$from->joinInner(
				array( $alias => $conn->getTableName('catalog_product_entity_int')),
				"$alias.entity_id = e.entity_id AND $alias.attribute_id = '$attid' AND $alias.store_id = 0",
				array()
			);
			$where[] = "$alias.value IS NOT NULL";
			$attmap[] = array(
				'id' => $attid,
				'code' => $att->getProductAttribute()->getAttributeCode()
			);
		}
		$from->where(implode(' AND ', $where));
		$labelMap = $this->getAttributeLabelMap($attmap);
		$tree = array();
		foreach($conn->fetchAll($select) as $row){
			$root = &$tree;
			$lastid = '';
			foreach($attmap as $att) {
				if(!isset($root[$att['id']])){
					$root[$att['id']] = array(
						'code' => $att['code'],
						'options' => array()
					);
				}
				if(!isset($root[$att['id']]['options'][$row[$att['code']]])){
					$root[$att['id']]['options'][$row[$att['code']]] = array(
						'val' => $labelMap[$row[$att['code']]]['val'],
						'pos' => $labelMap[$row[$att['code']]]['pos'],
						'children' => array()
					);
				}
				$root = &$root[$att['id']]['options'][$row[$att['code']]]['children'];
				$lastid = $row['id'];
			}
			$root['id'] = $lastid;
		}
		return $tree;
	}

	public function getAttributeLabelMap($attmap) {
		$in = array();
		foreach ($attmap as $att) {
			$in[] = "'" . $att['id'] . "'";
		}

		/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
		$conn = Mage::getSingleton('core/resource')->getConnection('core_read');
		/** @var Magento_Db_Adapter_Pdo_Mysql $select */
		$select = $conn->select();
		/** @var Varien_Db_Select $from */
		$select->from(
			array('eao' => $conn->getTableName('eav_attribute_option')),
			array('option_id' => 'eao.option_id',
				'val' => 'eaov.value',
				'pos' => 'eao.sort_order')
		)->joinInner(
			array('eaov' => $conn->getTableName('eav_attribute_option_value')),
			'eaov.option_id = eao.option_id',
			array()
		)->where('eao.attribute_id in (' . implode(',', $in) . ')');

		$map = array();
		foreach($conn->fetchAll($select) as $row) {
			$map[$row['option_id']] = array('val' => $row['val'], 'pos' => $row['pos']);
		}
		return $map;
	}

	public function getTree($pid) {
		$cache = Mage::app()->getCache();
		$key = 'attributeTree' . $pid;

		$tree = $cache->load($key);

		if($tree === false) {
			$product = Mage::getModel('catalog/product')->load($pid);
			$tree = $this->getAttributeTree($product);
			$cache->save(serialize($tree), $key);
			return $tree;
		} else {
			return unserialize($tree);
		}
	}

	public function getAdditionalData($pid, $spid) {
		$product = Mage::getModel('catalog/product')->load($pid);
		$sproduct = Mage::getModel('catalog/product')->load($spid);
		$additional = array();
		foreach($this->getSpAttributes($sproduct) as $adds) {
			$additional[$adds['code']] = $product->getData($adds['code']);
		}
		$vals = array(
			'price' => $product->getPrice(),
			'sku' => $product->getSku(),
			'weight' => $product->getWeight(),
			'attribs' => $additional
		);

		return $vals;
	}
	public function getSpAttributes($product)
	{
		$data = array();
		$attributes = $product->getAttributes();
		foreach ($attributes as $attribute) {
//            if ($attribute->getIsVisibleOnFront() && $attribute->getIsUserDefined() && !in_array($attribute->getAttributeCode(), $excludeAttr)) {
			if ($attribute->getIsVisibleOnFront()) {
				$value = $attribute->getFrontend()->getValue($product);

				if (!$product->hasData($attribute->getAttributeCode())) {
					$value = Mage::helper('catalog')->__('N/A');
				} elseif ((string)$value == '') {
					$value = Mage::helper('catalog')->__('No');
				} elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
					$value = Mage::app()->getStore()->convertPrice($value, true);
				}

				if (is_string($value) && strlen($value)) {
					$data[$attribute->getAttributeCode()] = array(
						'label' => $attribute->getStoreLabel(),
						'value' => $value,
						'code'  => $attribute->getAttributeCode()
					);
				}
			}
		}
		return $data;
	}

}

