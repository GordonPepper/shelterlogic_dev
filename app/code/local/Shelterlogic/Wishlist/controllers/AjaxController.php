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
    public function preDispatch()
    {
        $grandParent = get_parent_class(get_parent_class($this));
        call_user_func(array($grandParent, 'preDispatch'));

        if (!$this->_skipAuthentication && !Mage::getSingleton('customer/session')->authenticate($this)) {
            Mage::getSingleton('customer/session')->addError(
                'In order to add an item to your wishlist, you must first login. <br/>
                The product will be added to your wishlist automatically after that.'
            );
            $this->setFlag('', 'no-dispatch', true);
            if (!Mage::getSingleton('customer/session')->getBeforeWishlistUrl()) {
                Mage::getSingleton('customer/session')->setBeforeWishlistUrl($this->_getRefererUrl());
            }
            Mage::getSingleton('customer/session')->setBeforeWishlistRequest($this->getRequest()->getParams());
        }
        if (!Mage::getStoreConfigFlag('wishlist/general/active')) {
            $this->norouteAction();
            return;
        }
    }

    protected function _addItemToWishList()
    {
        $wishlist = $this->_getWishlist();
        if (!$wishlist) {
            return $this->norouteAction();
        }

        $session = Mage::getSingleton('customer/session');

        $productId = (int)$this->getRequest()->getParam('product');
        if (!$productId) {
            $this->_redirect('*/');
            return;
        }

        $product = Mage::getModel('catalog/product')->load($productId);
        if (!$product->getId() || !$product->isVisibleInCatalog()) {
            $session->addError($this->__('Cannot specify product.'));
            $this->_redirect('*/');
            return;
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

            $referer = $session->getBeforeWishlistUrl();
            if ($referer) {
                $session->setBeforeWishlistUrl(null);
            } else {
                $referer = $this->_getRefererUrl();
            }

            /**
             *  Set referer to avoid referring to the compare popup window
             */
            $session->setAddActionReferer($referer);

            Mage::helper('wishlist')->calculate();

            $message = $this->__('%1$s has been added to your wishlist. Click <a href="%2$s">here</a> to continue shopping.',
                $product->getName(), Mage::helper('core')->escapeUrl($referer));
            $session->addSuccess($message);
        } catch (Mage_Core_Exception $e) {
            $session->addError($this->__('An error occurred while adding item to wishlist: %s', $e->getMessage()));
        }
        catch (Exception $e) {
            $session->addError($this->__('An error occurred while adding item to wishlist.'));
        }

        $this->_redirect('wishlist/index/index', array('wishlist_id' => $wishlist->getId()));
    }

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
        $wishlist = $this->_getWishlistAjax();
        $itemCollection = $wishlist->getItemCollection();
        foreach ($itemCollection as $item) {
            /** @var Mage_Wishlist_Model_Item $item */
            if ($item->getProductId() == $productId) {
                return $item;
            }
        }

        return false;
    }

    protected function _getWishlistAjax()
    {
        $wishlist = $this->_getWishlist();
        if (!$wishlist) {
            Mage::throwException($this->__('Wishlist does not exist or session is expired.'));
        }
        return $wishlist;
    }

    protected function _addProductToWishlist($productId)
    {
        $wishlist = $this->_getWishlistAjax();
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
        $wishlist = $this->_getWishlistAjax();
        /** @var Mage_Wishlist_Model_Item $item */
        $item->delete();
        $wishlist->save();
        Mage::helper('wishlist')->calculate();
    }
}