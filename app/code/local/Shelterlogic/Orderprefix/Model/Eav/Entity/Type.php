<?php
class Shelterlogic_Orderprefix_Model_Eav_Entity_Type extends Mage_Eav_Model_Entity_Type
{
    const XML_PATH_ORDER_PREFIX       = 'shelterlogic/orderprefix/order';
    const XML_PATH_ORDER_START_NUMBER = 'shelterlogic/orderprefix/startnumber';
    const XML_PATH_DEALER_ENABLED     = 'shelterlogic/orderprefix/dealer_prefix_enabled';
    const XML_PATH_DEALER_PREFIX      = 'shelterlogic/orderprefix/dealer_prefix';
    const XML_PATH_DEALER_GROUP       = 'shelterlogic/orderprefix/dealer_group';

    protected $_allowEntities = array('order');

    public function fetchNewIncrementId($storeId = null)
    {
        $originalIncrementId = parent::fetchNewIncrementId($storeId);

        if (in_array($this->getEntityTypeCode(), $this->_allowEntities)) {
            if ($originalIncrementId) {
                $startNumber = Mage::getStoreConfig(self::XML_PATH_ORDER_START_NUMBER, $storeId);
                if ($startNumber > $originalIncrementId) {
                    $entityStoreConfig = Mage::getModel('eav/entity_store')
                        ->loadByEntityStore($this->getId(), $storeId);
                    $entityStoreConfig->setIncrementLastId($startNumber);
                    $entityStoreConfig->save();
                    $originalIncrementId = $startNumber;
                }
            }

            $originalIncrementId = $this->getCustomOrderPrefix($storeId) . $originalIncrementId;
        }

        return $originalIncrementId;
    }

    protected function getCustomOrderPrefix($storeId)
    {
        $prefix = false;
        if (Mage::getStoreConfigFlag(self::XML_PATH_DEALER_ENABLED, $storeId)) {
            $session = Mage::getSingleton('checkout/session');
            if ($session->hasQuote()) {
                $customerGroup = $session->getQuote()->getCustomerGroupId();
                $dealerGroups = Mage::getStoreConfig(self::XML_PATH_DEALER_GROUP, $storeId);
                if ($dealerGroups) {
                    $dealerGroups = explode(',', $dealerGroups);
                }

                if ($customerGroup && $dealerGroups && in_array($customerGroup, $dealerGroups)) {
                    $prefix = Mage::getStoreConfig(self::XML_PATH_DEALER_PREFIX, $storeId);
                }
            }
        }

        if ($prefix === false) {
            $prefix = Mage::getStoreConfig(self::XML_PATH_ORDER_PREFIX, $storeId);
        }

        return $prefix;
    }
}