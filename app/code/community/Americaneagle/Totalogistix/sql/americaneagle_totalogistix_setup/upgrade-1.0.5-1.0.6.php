<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/14/16
 * Time: 10:17 AM
 */

/** @var Mage_Customer_Model_Entity_Setup $this */
$this->startSetup();

/**
 * create a log table for soap requests
 */

/** @var Varien_Db_Adapter_Interfac e $conn */
$conn = $this->getConnection();

$this->updateAttribute('customer_address', 'street', 'data_model', 'americaneagle_totalogistix/attribute_data_street');

$this->endSetup();