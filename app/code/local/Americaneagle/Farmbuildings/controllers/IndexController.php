<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/10/14
 * Time: 4:24 PM
 */
class Americaneagle_Farmbuildings_IndexController
	extends Mage_Core_Controller_Front_Action {

	public function getAdditionalData($product)
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


	public function productAction() {
		$params = json_decode(file_get_contents('php://input'));
		$product = Mage::getModel('catalog/product')->load($params[0]->pid);
		$sproduct = Mage::getModel('catalog/product')->load($params[0]->spid);
		$additional = array();
		foreach($this->getAdditionalData($sproduct) as $adds) {
			$additional[$adds['code']] = $product->getData($adds['code']);
		}
		$vals = array(
			'price' => $product->getPrice(),
			'sku' => $product->getSku(),
			'weight' => $product->getWeight(),
			'attribs' => $additional
		);
		echo json_encode($vals);
	}

	public function indexAction() {
		$postVars = json_decode(file_get_contents('php://input'));

		$tree = Mage::helper('farmbuildings')->getTree($postVars->pid);
		//echo sprintf("tree root: '%s', root id: '%s'", $tree->val, $tree->id);
		foreach($postVars->options as $att) {
			$attid = substr($att->id, 9); //strlen('attribute') = 9
			foreach($tree as $id => $attval) {
				if($id == $attid) {
					foreach($attval['options'] as $optid => $opt) {
						if($att->value == $optid) {
							$tree = $opt['children'];
							break;
						}
					}
					break;
				}
			}
		}
		$nextAtt = $tree;
		$nextOpts = array();

		$keys = array_keys($nextAtt);
		foreach ($nextAtt[$keys[0]]['options'] as $id => $opt) {
			if(isset($opt['children']['id'])) {
				$nextOpts[] = array('id' => $id, 'val' => $opt['val'], 'pid' => $opt['children']['id']);
			} else {
				$nextOpts[] = array('id' => $id, 'val' => $opt['val']);
			}
		}
		echo json_encode(array('attributeid' => $keys[0], 'options' => $nextOpts));
	}

}