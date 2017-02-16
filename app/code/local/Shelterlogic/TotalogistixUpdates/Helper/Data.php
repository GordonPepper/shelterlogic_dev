<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 5/12/16
 * Time: 10:53 AM
 */

class Shelterlogic_TotalogistixUpdates_Helper_Data extends Americaneagle_Totalogistix_Helper_Data
{
    protected function getAccessorial() {
        return Mage::getSingleton('core/session')->getAccessorialParams();
    }
}