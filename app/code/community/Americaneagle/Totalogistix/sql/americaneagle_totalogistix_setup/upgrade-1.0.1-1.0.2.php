<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/24/15
 * Time: 3:25 PM
 */
/** @var Mage_Customer_Model_Entity_Setup $this */

$this->startSetup();

$this->removeAttribute('customer_address', 'is_residential');
$this->removeAttribute('customer_address', 'is_limited_access');

$this->endSetup();
