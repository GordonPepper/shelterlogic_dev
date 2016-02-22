<?php
class Shelterlogic_Orderprefix_Model_Eav_Entity_Type extends Mage_Eav_Model_Entity_Type
{
    const XML_PATH_ORDER_PREFIX = 'shelterlogic/orderprefix/order';
    const XML_PATH_ORDER_START_NUMBER = 'shelterlogic/orderprefix/startnumber';

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

            $originalIncrementId = Mage::getStoreConfig(self::XML_PATH_ORDER_PREFIX, $storeId) . $originalIncrementId;
        }

        return $originalIncrementId;
    }
}