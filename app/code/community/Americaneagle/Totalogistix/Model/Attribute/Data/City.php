<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 2/2/16
 * Time: 11:55 AM
 */


class Americaneagle_Totalogistix_Model_Attribute_Data_City extends Mage_Eav_Model_Attribute_Data_Text
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
        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $data = $this->getExtractedData('region_id');
        if ($data != '2') {
            return parent::validateValue($value);
        }
        $select = $conn->select();
        /** @var Varien_Db_Select $from */
        $from = $select->from(
            array('aetc' => $conn->getTableName('ae_totalogistix_city')),
            array('city_id' => 'city_id', 'city' => 'city')
        );
        $from->where("city = ? ", $value);

        $count = count($conn->fetchAll($select));

        if ($count > 0 ){
            return parent::validateValue($value);
        } else {
            return array('Please check the spelling of your City');
        }
    }

}