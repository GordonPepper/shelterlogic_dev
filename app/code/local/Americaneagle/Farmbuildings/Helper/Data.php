<?php
class AeAttribute {
	public $id;
	public $code;
	public $options;
	public function __construct($i, $v) {
		$this->id = $i;
		$this->code = $v;
		$this->options = array();
	}
	public function getOption($id) {
		foreach ($this->options as $opt) {
			if($opt->id == $id) {
				return $opt;
			}
		}
		return false;
	}
}
class AeOption {
	public $id;
	public $val;
	public $pos;
	public $children;
	public function __construct($i, $v, $p) {
		$this->id = $i;
		$this->val = $v;
		$this->pos = $p;
		$this->children = array();
	}
	public function getChild($id) {
		foreach ($this->children as $child){
			if ($child->id == $id)
				return $child;
		}
		return false;
	}
}

class Americaneagle_Farmbuildings_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getAttributeTree($configprod) {


		/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
		$conn = Mage::getSingleton('core/resource')->getConnection('core_read');
		Mage::log(sprintf('found product with id: %s', $configprod->getProduct()->getId()));


		/** @var Magento_Db_Adapter_Pdo_Mysql $select */
		$select = $conn->select();
		/** @var Varien_Db_Select $from */
		$from = $select->from(
			array('e' => $conn->getTableName('catalog_product_entity')),
			array(
				'id' => 'e.entity_id',
				'style' => 'at_style.value',
				'fabric_material' => 'at_fabric_material.value',
				'fabric_color' => 'at_fabric_color.value',
				'length' => 'at_length.value',
				'width' => 'at_width.value',
				'height' => 'at_height.value'
			)
		);
		$from->joinInner(
			array('link_table' => $conn->getTableName('catalog_product_super_link')),
			'link_table.product_id = e.entity_id',
			array());
		$atts = $configprod->getProduct()->getTypeInstance(true)->getConfigurableAttributes($configprod->getProduct());
		$where = array();
		$where[] = 'link_table.parent_id = ' . $configprod->getProduct()->getId();
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
//		Mage::log(sprintf('created select: %s', $select->__toString()));
		$labelMap = $this->getAttributeLabelMap($attmap);
		$tree = array();
		foreach($conn->fetchAll($select) as $row){
			$root = &$tree;
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
			}
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
		$from = $select->from(
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

	public function first_getAttributeTree($configprod){
		//$product = $this->getProduct();
		//return "{product name is: {$product->getName()}";
		/**
		 * Ok, so the plan here is to pull a attribute "tree" out of the cache
		 * for this product. we want this as cached data because we are going
		 * to call this via async javascript to get each level of options.
		 * After the final selection, we return the product ID that matches
		 * the select options. we can use the original configurator as a road
		 * map, but we don't need all the product id's, just the attribute id
		 * mapping. So we define our tree to have count($allowedAttributes)
		 * levels, The "key" of each node is the attributes value id, the
		 * "value" of each node is an AeAttribute as defined at the bottom
		 * of this file
		 */
		$allowedProducts = $configprod->getAllowProducts();
		/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $allowedAttributes */
		$allowedAttributes = $configprod->getAllowAttributes();

		$attsArray = $allowedAttributes->getItems();
		$tree = new AeOption('0', 'root', 0);

		Varien_Profiler::start('FARMBUILDINGS_BUILD_TREE:'.__METHOD__);
		foreach ($allowedProducts as $product) {
			$option = $tree;
			foreach($attsArray as $att) {
				$childAtt = $option->getChild($att->getAttributeId());
				if($childAtt === false){
					$childAtt = new AeAttribute($att->getAttributeId(), $att->getProductAttribute()->getAttributeCode());
					$option->children[] = $childAtt;
				}

				$id = $product->getData($att->getProductAttribute()->getAttributeCode());
				$childOpt = $childAtt->getOption($id);
				if($childOpt === false) {
					$childOpt = new AeOption($id, $configprod->getLabelById($id, $att->getPrices()), $configprod->getPositionById($id, $att->getPrices()));
					$childAtt->options[] = $childOpt;
				}
				$option = &$childOpt;
			}
		}
		Varien_Profiler::stop('FARMBUILDINGS_BUILD_TREE:'.__METHOD__);

		file_put_contents('/tmp/treeout.json', json_encode($tree, JSON_PRETTY_PRINT));
		file_put_contents('/tmp/treeout.php', serialize($tree));
		return $tree;
	}

	public function getTree() {
		$cache = Mage::app()->getCache();
		$option = $cache->getOption('automatic_serialization');
		$key = 'attributeTree';
		$cache->setOption('automatic_serialization', true);

		$tree = $cache->load($key);

		if($tree === false) {
			Mage::logException("oops, tree does not exist! must build new tree");
			//$tree = $this->getAttributeTree();

			//$cache->save($tree, $key);
		}
		$cache->setOption('automatic_serialization', $option); // must reset the option
		return $tree;
	}

}

