<?php

class Americaneagle_Farmbuildings_Block_Product_View_Configurable
	extends Mage_Catalog_Block_Product_View_Type_Configurable
{
	public function _construct() {
		//parent::_construct();
	}

	public function getJsonConfig() {
		//return 'foo';
		$cache = Mage::app()->getCache();
		$option = $cache->getOption('automatic_serialization');
		$key = 'attributeTree';
		$cache->setOption('automatic_serialization', true);
		//$dstart = microtime(true);
		$tree = $cache->load($key);
		//$dend = $dstart  - microtime(true);
		$tree = false;
		if($tree === false) {
			$tree = Mage::helper('farmbuildings')->getAttributeTree($this);
			$cache->save($tree, $key);
		} else {
			//Mage::log(sprintf('using cached tree, took %F to deserialize', $dend));
		}
		$cache->setOption('automatic_serialization', $option); // must reset the option
		/*
		 * so here we will just send the root values
		 */

		$firstOption = array();
		$keys = array_keys($tree);

		foreach ($tree[$keys[0]]['options'] as $optid => $option) {
			$firstOption[] = array('id' => $optid, 'val' => $option['val'], 'pos' => $option['pos']);
		}
		usort($firstOption, function($a,$b){return ($a['pos'] > $b['pos']); });
		return json_encode(array('id' => $keys[0], 'code' => $tree[$keys[0]]['code'], 'options' => $firstOption));

	}


	public function getPositionById($id, $prices) {
		for($i = 0; $i < count($prices); $i++) {
			if($prices[$i]['value_index'] == $id) {
				return $i;
			}
		}
	}

	public function getLabelById($id, $prices) {
		foreach ($prices as $price) {
			if ($price['value_index'] == $id) {
				return $price['label'];
			}
		}
	}
	public function getAttCodes(Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $allow) {
		$atts = array();
		foreach ($allow as $att) {
			$atts[] = $att->getProductAttribute()->getAttributeCode();
		}

		return $atts;
	}

	public function orig_getJsonConfig()
	{
		$attributes = array();
		$options    = array();
		$store      = $this->getCurrentStore();
		$taxHelper  = Mage::helper('tax');
		$currentProduct = $this->getProduct();

		$preconfiguredFlag = $currentProduct->hasPreconfiguredValues();
		if ($preconfiguredFlag) {
			$preconfiguredValues = $currentProduct->getPreconfiguredValues();
			$defaultValues       = array();
		}

		foreach ($this->getAllowProducts() as $product) {
			$productId  = $product->getId();

			foreach ($this->getAllowAttributes() as $attribute) {
				$productAttribute   = $attribute->getProductAttribute();
				$productAttributeId = $productAttribute->getId();
				$attributeValue     = $product->getData($productAttribute->getAttributeCode());
				if (!isset($options[$productAttributeId])) {
					$options[$productAttributeId] = array();
				}

				if (!isset($options[$productAttributeId][$attributeValue])) {
					$options[$productAttributeId][$attributeValue] = array();
				}
				$options[$productAttributeId][$attributeValue][] = $productId;
			}
		}

		$this->_resPrices = array(
			$this->_preparePrice($currentProduct->getFinalPrice())
		);

		foreach ($this->getAllowAttributes() as $attribute) {
			$productAttribute = $attribute->getProductAttribute();
			$attributeId = $productAttribute->getId();
			$info = array(
				'id'        => $productAttribute->getId(),
				'code'      => $productAttribute->getAttributeCode(),
				'label'     => $attribute->getLabel(),
				'options'   => array()
			);

			$optionPrices = array();
			$prices = $attribute->getPrices();
			if (is_array($prices)) {
				foreach ($prices as $value) {
					if(!$this->_validateAttributeValue($attributeId, $value, $options)) {
						continue;
					}
					$currentProduct->setConfigurablePrice(
						$this->_preparePrice($value['pricing_value'], $value['is_percent'])
					);
					$currentProduct->setParentId(true);
					Mage::dispatchEvent(
						'catalog_product_type_configurable_price',
						array('product' => $currentProduct)
					);
					$configurablePrice = $currentProduct->getConfigurablePrice();

					if (isset($options[$attributeId][$value['value_index']])) {
						$productsIndex = $options[$attributeId][$value['value_index']];
					} else {
						$productsIndex = array();
					}

					$info['options'][] = array(
						'id'        => $value['value_index'],
						'label'     => $value['label'],
						'price'     => $configurablePrice,
						'oldPrice'  => $this->_prepareOldPrice($value['pricing_value'], $value['is_percent']),
						'products'  => $productsIndex,
					);
					$optionPrices[] = $configurablePrice;
				}
			}
			/**
			 * Prepare formated values for options choose
			 */
			foreach ($optionPrices as $optionPrice) {
				foreach ($optionPrices as $additional) {
					$this->_preparePrice(abs($additional-$optionPrice));
				}
			}
			if($this->_validateAttributeInfo($info)) {
				$attributes[$attributeId] = $info;
			}

			// Add attribute default value (if set)
			if ($preconfiguredFlag) {
				$configValue = $preconfiguredValues->getData('super_attribute/' . $attributeId);
				if ($configValue) {
					$defaultValues[$attributeId] = $configValue;
				}
			}
		}

		$taxCalculation = Mage::getSingleton('tax/calculation');
		if (!$taxCalculation->getCustomer() && Mage::registry('current_customer')) {
			$taxCalculation->setCustomer(Mage::registry('current_customer'));
		}

		$_request = $taxCalculation->getDefaultRateRequest();
		$_request->setProductClassId($currentProduct->getTaxClassId());
		$defaultTax = $taxCalculation->getRate($_request);

		$_request = $taxCalculation->getRateRequest();
		$_request->setProductClassId($currentProduct->getTaxClassId());
		$currentTax = $taxCalculation->getRate($_request);

		$taxConfig = array(
			'includeTax'        => $taxHelper->priceIncludesTax(),
			'showIncludeTax'    => $taxHelper->displayPriceIncludingTax(),
			'showBothPrices'    => $taxHelper->displayBothPrices(),
			'defaultTax'        => $defaultTax,
			'currentTax'        => $currentTax,
			'inclTaxTitle'      => Mage::helper('catalog')->__('Incl. Tax')
		);

		$config = array(
			'attributes'        => $attributes,
			'template'          => str_replace('%s', '#{price}', $store->getCurrentCurrency()->getOutputFormat()),
			'basePrice'         => $this->_registerJsPrice($this->_convertPrice($currentProduct->getFinalPrice())),
			'oldPrice'          => $this->_registerJsPrice($this->_convertPrice($currentProduct->getPrice())),
			'productId'         => $currentProduct->getId(),
			'chooseText'        => Mage::helper('catalog')->__('Choose an Option...'),
			'taxConfig'         => $taxConfig
		);

		if ($preconfiguredFlag && !empty($defaultValues)) {
			$config['defaultValues'] = $defaultValues;
		}

		$config = array_merge($config, $this->_getAdditionalConfig());

		return Mage::helper('core')->jsonEncode($config);
	}

}
/*
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


class old_AeAttribute {
	public $id;
	public $value;
	public $kids;
	public function hasChild($id) {
		foreach ($this->kids as $child) {
			if ($child->id == $id)
				return true;
		}
		return false;
	}
	public function getChild($id) {
		foreach($this->kids as $child) {
			if ($child->id == $id)
				return $child;
		}
	}
	public function __construct($i, $v){
		$this->id = $i;
		$this->value = $v;
	}

}
*/