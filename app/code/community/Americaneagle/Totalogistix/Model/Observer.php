<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/23/15
 * Time: 3:35 PM
 */
class Americaneagle_Totalogistix_Model_Observer
{
    public function beforeCollectTotals(Varien_Event_Observer $observer) {

    }
    public function afterLoadProductCollection($observer) {
        /** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
        $collection = $observer->getCollection();

        $ids = array();
        foreach ($collection->getItems() as $eid => $product) {
            $ids[] = $eid;
        }
        /** @var Magento_Db_Adapter_Pdo_Mysql $conn */
        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        /** @var Magento_Db_Adapter_Pdo_Mysql $select */
        $select = $conn->select();

        $from = $select->from(
            array('gs' => $conn->getTableName('gaboli_warehouse_stock')),
            array('product_id' => 'product_id', 'location_id' => 'location_id', 'qty' => 'qty')
        );
        $from->where(sprintf("gs.product_id in ('%s')", implode("','", $ids)));
        foreach($conn->fetchAll($select) as $row) {
            file_put_contents('/tmp/inventory.txt', sprintf("pid: %s, loc: %s, qty: %s\n", $row['product_id'],$row['location_id'], $row['qty']), FILE_APPEND);
//            $map[$row['option_id']] = array('val' => $row['val'], 'pos' => $row['pos']);
        }

        return;
    }
}