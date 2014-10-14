<?php
class Americaneagle_Farmbuildings_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getAttributeTree($configprod){
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

//		file_put_contents('/tmp/treeout.json', json_encode($tree, JSON_PRETTY_PRINT));
//		file_put_contents('/tmp/treeout.php', serialize($tree));
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
