<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/14/16
 * Time: 10:16 AM
 */

class Americaneagle_Totalogistix_Model_Attribute_Data_Street extends Mage_Eav_Model_Attribute_Data_Text
{
    /**
     * Validate city
     * return false
     *
     * @param array|string $value
     * @return boolean|array
     */
    public function validateValue($value)
    {
        if (preg_match("/p\.* *o\.* *box/i", current($value)) && $_POST['billing']['use_for_shipping']) {
            return array('We cannot ship to P.O. box addresses.');
        }

        if (isset($_POST['shipping']) && preg_match("/p\.* *o\.* *box/i", current($_POST['shipping']['street']))) {
            return array('We cannot ship to P.O. box addresses.');
        }
    }

}