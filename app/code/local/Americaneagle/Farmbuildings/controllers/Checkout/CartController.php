<?php
require_once(Mage::getModuleDir('controllers', 'Mage_Checkout') . DS . 'CartController.php');

class Americaneagle_Farmbuildings_Checkout_CartController extends
	Mage_Checkout_CartController
{
	public function configureAction()
	{
		// Extract item and product to configure
		$id = (int) $this->getRequest()->getParam('id');
		$quoteItem = null;
		$cart = $this->_getCart();
		if ($id) {
			$quoteItem = $cart->getQuote()->getItemById($id);
		}

		if (!$quoteItem) {
			$this->_getSession()->addError($this->__('Quote item is not found.'));
			$this->_redirect('checkout/cart');
			return;
		}

		try {
			$params = new Varien_Object();
			$params->setCategoryId(false);
			$params->setConfigureMode(true);
			$params->setBuyRequest($quoteItem->getBuyRequest());
			Mage::register('super_attribute_array', $params->getBuyRequest()->getSuperAttribute());
			Mage::helper('catalog/product_view')->prepareAndRender($quoteItem->getProduct()->getId(), $this, $params);
		} catch (Exception $e) {
			$this->_getSession()->addError($this->__('Cannot configure product.'));
			Mage::logException($e);
			$this->_goBack();
			return;
		}
	}

} 