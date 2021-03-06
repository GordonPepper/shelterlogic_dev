<?php

class Americaneagle_Farmbuildings_Block_Product_View_Configurable
	extends Mage_Catalog_Block_Product_View_Type_Configurable {

	public function getJsonConfig() {

		$tree = Mage::helper('farmbuildings')->getTree($this->getProduct()->getId());
		$sa = Mage::registry('super_attribute_array');
		if ($sa) {
			$config = array('reconfigure' => 'true');
			$pid = 0;
			foreach($sa as $attid => $selected_opt_id) {
				foreach($tree[$attid]['options'] as $opt_id => $option) {
					$selected = $opt_id == $selected_opt_id ? 1 : 0;
					if(isset($option['children']['id'])){
						$config['attributes'][$attid][] = array('id' => $opt_id, 'val' => $option['val'], 'pos' => $option['pos'], 'selected' => $selected, 'pid' => $option['children']['id']);
						$pid = $option['children']['id'];
					} else {
						$config['attributes'][$attid][] = array('id' => $opt_id, 'val' => $option['val'], 'pos' => $option['pos'], 'selected' => $selected);
					}
				}

				usort($config['attributes'][$attid], function($a, $b) {
					return ($a['pos'] > $b['pos']);
				});
				$tree = &$tree[$attid]['options'][$selected_opt_id]['children'];
			}

			$additional = Mage::helper('farmbuildings')->getAdditionalData($pid, $this->getProduct()->getId());
			//$additional['priceFormat'] = json_decode(Mage::helper('tax')->getPriceFormat($this->getStore()));
			$config['additional'] = $additional;

			return json_encode($config);
		} else {
			$firstOption = array();
			$keys = array_keys($tree);

			if (!is_null($tree[$keys[0]]['options'])) {
				foreach ($tree[$keys[0]]['options'] as $optid => $option) {
					//$firstOption[] = array('id' => $optid, 'val' => $option['val'], 'pos' => $option['pos']);
					if (isset($option['children']['id'])) {
						$firstOption[] = array('id' => $optid, 'val' => $option['val'], 'pos' => $option['pos'], 'pid' => $option['children']['id']);
					} else {
						$firstOption[] = array('id' => $optid, 'val' => $option['val'], 'pos' => $option['pos']);
					}
				}
			}
			usort($firstOption, function ($a, $b) {
				return ($a['pos'] > $b['pos']);
			});
			return json_encode(array('sp' => $tree['sp'], 'id' => $keys[0], 'code' => $tree[$keys[0]]['code'], 'options' => $firstOption));
		}
	}

    protected function _construct() {
        parent::_construct(); // TODO: Change the autogenerated stub
    }
}
