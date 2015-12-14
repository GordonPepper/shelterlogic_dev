<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 12/10/2015
 * Time: 5:27 PM
 */
require_once 'Mage/Wishlist/controllers/IndexController.php';

class Shelterlogic_Wishlist_AjaxController extends Mage_Wishlist_IndexController
{
    public function toggleAction()
    {
        $status = '';
        try {
            $productId = $this->getRequest()->getParam('product');
            if (!$productId) {
                Mage::throwException($this->__('Product is not specified.'));
            }
            if ($item = $this->_getWishlistItem($productId)) {
                $this->_removeWishlistItem($item);
                $status = 'removed';
            } else {
                $this->_addProductToWishlist($productId);
                $status = 'added';
            }
        } catch (Exception $e) {
            $status = 'error';
            Mage::getSingleton('core/session')->addError($e->getMessage());
        }

        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->getResponse()->setBody(json_encode(array('status' => $status)));
    }

    protected function _getWishlistItem($productId)
    {
        /** @var Mage_Wishlist_Model_Wishlist $wishlist */
        $wishlist = $this->_getWishlist();
        $itemCollection = $wishlist->getItemCollection();
        foreach ($itemCollection as $item) {
            /** @var Mage_Wishlist_Model_Item $item */
            if ($item->getProductId() == $productId) {
                return $item;
            }
        }

        return false;
    }

    protected function _getWishlist()
    {
        $wishlist = parent::_getWishlist();
        if (!$wishlist) {
            Mage::throwException($this->__('Wishlist does not exist or session is expired.'));
        }
        return $wishlist;
    }

    protected function _addProductToWishlist($productId)
    {
        $wishlist = $this->_getWishlist();
        $session = Mage::getSingleton('customer/session');
        $product = Mage::getModel('catalog/product')->load($productId);
        if (!$product->getId() || !$product->isVisibleInCatalog()) {
            Mage::throwException($this->__('Cannot specify product.'));
        }

        try {
            $requestParams = $this->getRequest()->getParams();
            if ($session->getBeforeWishlistRequest()) {
                $requestParams = $session->getBeforeWishlistRequest();
                $session->unsBeforeWishlistRequest();
            }
            $buyRequest = new Varien_Object($requestParams);

            $result = $wishlist->addNewItem($product, $buyRequest);
            if (is_string($result)) {
                Mage::throwException($result);
            }
            $wishlist->save();

            Mage::dispatchEvent(
                'wishlist_add_product',
                array(
                    'wishlist' => $wishlist,
                    'product' => $product,
                    'item' => $result
                )
            );

            Mage::helper('wishlist')->calculate();
        } catch (Mage_Core_Exception $e) {
            Mage::throwException($this->__('An error occurred while adding item to wishlist: %s', $e->getMessage()));
        } catch (Exception $e) {
            Mage::throwException($this->__('An error occurred while adding item to wishlist.'));
        }
    }

    protected function _removeWishlistItem($item)
    {
        $wishlist = $this->_getWishlist();
        /** @var Mage_Wishlist_Model_Item $item */
        $item->delete();
        $wishlist->save();
        Mage::helper('wishlist')->calculate();
    }
}