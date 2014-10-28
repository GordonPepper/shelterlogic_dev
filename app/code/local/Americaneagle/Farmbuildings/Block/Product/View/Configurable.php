<?php

class Americaneagle_Farmbuildings_Block_Product_View_Configurable
	extends Mage_Catalog_Block_Product_View_Type_Configurable {
	public function _construct() {
		//parent::_construct();
	}

	public function getJsonConfig() {
		//return 'foo';
		$cache = Mage::app()->getCache();
		$option = $cache->getOption('automatic_serialization');
		$key = 'attributeTree' . $this->getProduct()->getId();
		$cache->setOption('automatic_serialization', true);
		//$dstart = microtime(true);
		$tree = $cache->load($key);
		//$dend = $dstart  - microtime(true);
		//$tree = false;
		if ($tree === false) {
			$tree = Mage::helper('farmbuildings')->getAttributeTree($this->getProduct());
			$cache->save($tree, $key);
		} else {
			//Mage::log(sprintf('using cached tree, took %F to deserialize', $dend));
		}
		$cache->setOption('automatic_serialization', $option); // must reset the option

		$sa = Mage::registry('super_attribute_array');
		if ($sa) {
			$config = array('reconfigure' => 'true');

			$current = "";
			foreach($sa as $attid => $selected_opt_id) {
				foreach($tree[$attid]['options'] as $opt_id => $option) {
					$selected = $opt_id == $selected_opt_id ? 1 : 0;
					if(isset($option['children']['id'])){
						$config['attributes'][$attid][] = array('id' => $opt_id, 'val' => $option['val'], 'pos' => $option['pos'], 'selected' => $selected, 'pid' => $option['children']['id']);
					} else {
						$config['attributes'][$attid][] = array('id' => $opt_id, 'val' => $option['val'], 'pos' => $option['pos'], 'selected' => $selected);
					}
				}

				usort($config['attributes'][$attid], function($a, $b) {
					return ($a['pos'] > $b['pos']);
				});
				$tree = &$tree[$attid]['options'][$selected_opt_id]['children'];
			}

			return json_encode($config);
		} else {
			$firstOption = array();
			$keys = array_keys($tree);

			foreach ($tree[$keys[0]]['options'] as $optid => $option) {
				$firstOption[] = array('id' => $optid, 'val' => $option['val'], 'pos' => $option['pos']);
			}
			usort($firstOption, function ($a, $b) {
				return ($a['pos'] > $b['pos']);
			});
			return json_encode(array('id' => $keys[0], 'code' => $tree[$keys[0]]['code'], 'options' => $firstOption));
		}
	}
}
