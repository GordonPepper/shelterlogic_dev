<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_PaypalUk
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * PayPal Bill Me Later method
 */
class Mage_PaypalUk_Model_Bml extends Mage_Paypal_Model_Bml
{
    /**
     * Payment method code
     * @var string
     */
    protected $_code  = Mage_Paypal_Model_Config::METHOD_WPP_PE_BML;

    /**
     * Checkout payment form
     * @var string
     */
    protected $_formBlockType = 'paypaluk/bml_form';

    /**
     * Checkout redirect URL getter for onepage checkout
     *
     * @return string
     */
    public function getCheckoutRedirectUrl()
    {
        return Mage::getUrl('paypaluk/bml/start');
    }
}
