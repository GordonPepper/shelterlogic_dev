<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 5/13/16
 * Time: 9:07 AM
 */
require_once 'Mage/Checkout/controllers/OnepageController.php';

class Shelterlogic_Checkout_OnepageController extends Mage_Checkout_OnepageController
{

    private function registerAccessorial() {

        $accessorial = Mage::app()->getRequest()->getPost();
        if (is_null($accessorial['billing'])) {
            $vals = Mage::getSingleton('core/session')->getAccessorialParams();
        } else {
            if (array_key_exists('is_notify', $accessorial['billing'])) {
                $vals[] = 'NFY';
            }
            if (array_key_exists('is_residential', $accessorial['billing'])) {
                $vals[] = 'REP';
            }
            if (array_key_exists('is_lift_gate', $accessorial['billing'])) {
                $vals[] = 'LFT';
            }
            if (array_key_exists('is_inside_delivery', $accessorial['billing'])) {
                $vals[] = 'IDL';
            }
            if (empty($vals)) {
                $vals[] = 'NFY';
            }

            $vals = implode(',', $vals);
        }
        Mage::getSingleton('core/session')->setAccessorialParams($vals);

    }
    /**
     * Save checkout billing address
     */
    public function saveBillingAction()
    {
        $this->registerAccessorial();
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
                    $result['goto_section'] = 'shipping_method';
                    $result['update_section'] = array(
                        'name' => 'shipping-method',
                        'html' => $this->_getShippingMethodsHtml()
                    );

                    $result['allow_sections'] = array('shipping');
                    $result['duplicateBillingInfo'] = 'true';
                } else {
                    $result['goto_section'] = 'shipping';
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }

    /**
     * Shipping address save action
     */
    public function saveShippingAction()
    {
        $this->registerAccessorial();
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
            $result = $this->getOnepage()->saveShipping($data, $customerAddressId);

            if (!isset($result['error'])) {
                $result['goto_section'] = 'shipping_method';
                $result['update_section'] = array(
                    'name' => 'shipping-method',
                    'html' => $this->_getShippingMethodsHtml()
                );
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}