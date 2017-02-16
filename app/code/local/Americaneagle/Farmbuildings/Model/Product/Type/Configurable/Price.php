<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/20/14
 * Time: 3:55 PM
 */
class Americaneagle_Farmbuildings_Model_Product_Type_Configurable_Price extends
	Mage_Catalog_Model_Product_Type_Configurable_Price {

	public function getFinalPrice($qty = null, $product) {
		if (is_null($qty) && !is_null($product->getCalculatedFinalPrice())) {
			return $product->getCalculatedFinalPrice();
		}
		$sp = $product->getCustomOption('simple_product');
		if (isset($sp)){
            if($sp instanceof Mage_Wishlist_Model_Item_Option) {
                $spid = $sp->getProductId();
            } else {
                $spid = $sp->getProduct()->getId();
            }
			$relatedProduct = Mage::getModel('catalog/product')->load($spid);
            $finalPrice = Mage::getModel('americaneagle_visual/priceobserver')->getShelterlogicPriceRule(Mage::getSingleton('customer/session')->getCustomer(), $relatedProduct, $product->getId());

            //$finalPrice = $relatedProduct->getPrice();
			$product->setFinalPrice($finalPrice);
			return $finalPrice;
		}

		$basePrice = $this->getBasePrice($product, $qty);
		$finalPrice = $basePrice;
		$product->setFinalPrice($finalPrice);
		Mage::dispatchEvent('catalog_product_get_final_price', array('product' => $product, 'qty' => $qty));
		$finalPrice = $product->getData('final_price');

		$finalPrice += $this->getTotalConfigurableItemsPrice($product, $finalPrice);
		$finalPrice += $this->_applyOptionsPrice($product, $qty, $basePrice) - $basePrice;
		$finalPrice = max(0, $finalPrice);

		$product->setFinalPrice($finalPrice);
		return $finalPrice;
	}

} 