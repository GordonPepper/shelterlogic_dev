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
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


class Mage_Adminhtml_Model_System_Config_Backend_Seo_Product extends Mage_Core_Model_Config_Data
{
    /**
     * Refresh category url rewrites if configuration was changed
     *
     * @return Mage_Adminhtml_Model_System_Config_Backend_Seo_Product
     */
    protected function _afterSave()
    {
        /**
         * Index model responsible for rewrites index
         */
//        if ($this->isValueChanged()) {
//            Mage::getSingleton('catalog/url')->refreshRewrites();
//        }
        return $this;
    }
}
