<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 9/24/14
 * Time: 4:05 PM
 */
class Americaneagle_Totalogistix_Helper_Data extends Mage_Core_Helper_Abstract
{
    /** @var Mage_Shipping_Model_Rate_Request $req */
    private $req;

    private function getCartChecksum() {
        $str = $this->req->getDestPostcode();
        foreach ($this->req->getAllItems() as $item) {
            $str .= $item->getProductId() . $item->getQty() * $item->getWeight();
        }
        return hash('sha1', $str);
    }

    public function getPriceSheets(Mage_Shipping_Model_Rate_Request $request) {
        $this->req = $request;
        $cartcs = $this->getCartChecksum();
        $sess = Mage::getSingleton('core/session');
        if (Mage::getStoreConfigFlag('carriers/totalogistix/rate_cache')
            && $sess->getTlxPriceSheet()
            && $sess->getTlxPriceSheet()['hash'] == $cartcs
            && $sess->getTlxPriceSheet()['sheet']
            && isset($sess->getTlxPriceSheet()['expires'])
            && $sess->getTlxPriceSheet()['expires'] > time()
        ) {
            return $sess->getTlxPriceSheet()['sheet'];
        } else {
            $xItems = new SimpleXMLElement('<Items></Items>');
            foreach ($request->getAllItems() as $item) {
                if ($item->getProductType() == 'simple') {
                    $xitem = $xItems->addChild('Item');
                    $xitem->addChild('Class', $item->getProduct()->getClass() ? $item->getProduct()->getClass() : '70');
                    if($item->getProduct()->getTlxShipLtl()) {
                        $xitem->addChild('Length', $item->getProduct()->getTlxShipLength());
                        $xitem->addChild('Width', $item->getProduct()->getTlxShipWidth());
                        $xitem->addChild('Height', $item->getProduct()->getTlxShipHeight());
                        if($item->getProduct()->getTlxPalletWeight()) {
                            $xitem->addChild('Weight', intval(($item->getWeight() + $item->getProduct()->getTlxPalletWeight()) ));
                        } else {
                            $xitem->addChild('Weight', intval($item->getWeight() ));
                        }
                    } else {
                        $xitem->addChild('Weight', intval($item->getWeight() ));
                    }
                    $xitem->addChild('Quantity', $item->getQty());

                }
            }

            if($request->getDestRegionCode() == 'AK'){
               $isValid = $this->isValidAlaskaCity($request->getDestCity());
                if (!$isValid){
                    //throw new Exception('Wrong City');
                    Mage::getSingleton('core/session')->addError('Please check the spelling of your city.');
                    return false;
                }
            }


            $client = new Zend_Http_Client();
            $client->setUri($this->getServiceUri());
            $client->setParameterPost('sZip', $this->getOriginZip($request));
            $client->setParameterPost('AccessID', $this->getAccessId());
            $client->setParameterPost('Service', $this->getAccessorial());
            $client->setParameterPost('Date', $this->getShipDate());
            $client->setParameterPost('cZip', $request->getDestPostcode());
           // if($request->getDestRegionCode() == 'AK'){
                $client->setParameterPost('cCity', $request->getDestCity());
                $client->setParameterPost('cState', $request->getDestRegionCode());
           // }
            /* if i worked with tlx, i would be embarrased for asking implementers to do this... */
            $dom = dom_import_simplexml($xItems);
            $notxml = $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
            $client->setParameterPost('Items', $notxml);
            $client->setParameterPost('Profile', $this->getProfile());


            $response = $client->request('POST');
            Mage::log("TOTALogistix: PostBody: " . urldecode($client->getLastRequest()));

            $xml = simplexml_load_string($response->getBody());
            $status = $xml->xpath('/Response')[0]->{"Status"};
            Mage::log('TOTALogistix: received response: ' . $xml->asXML());
            if ($status === false) {
                Mage::logException("Failed to load response from TOTALogistix");
            }
            $prices = $xml->xpath('/Response/PriceSheet');
            if ($prices === false) {
                Mage::logException("Failed to load shipping price sheets");
            }
            $sheets = array();
            foreach ($prices as $price) {
                $ps = new Varien_Object();

                $ps->setCarrier((string)$price->{'Carrier'});
                $ps->setChargeAmount((string)$price->{'ChargeAmount'});
                $ps->setCarrierName((string)$price->{'CarrierName'});
                $ps->setErpShipCode((string)$price->{'ErpShipCode'});
                $sheets[] = $ps;
            }
            $sess->setTlxPriceSheet(array('hash' => $cartcs, 'sheet' => $sheets, 'expires' => time() + 3600));
            return $sheets;
        }
    }

    private function getAccessorial() {
        $vals = explode(',', Mage::getStoreConfig('carriers/totalogistix/accessorial'));
        if ($this->req->getIsResidential() == 1) {
            $vals[] = 'REP';
        }
        if ($this->req->getIsLimitedAccess() == 1) {
            $vals[] = 'LTD';
        }
        return implode(',', $vals);
    }

    private function getShipDate() {
        $lead = Mage::getStoreConfig('carriers/totalogistix/lead_time');
        $d = new Zend_Date();
        $d->add($lead, Zend_Date::DAY);
        return $d->toString('MM/dd/YYYY');    //	$client->setParameterGet('date', '10/10/2014');
    }

    private function getProfile() {
        return Mage::getStoreConfig('carriers/totalogistix/profile');
    }

    private function getAccessId() {
        return Mage::getStoreConfig('carriers/totalogistix/access_id');
    }

    private function getOriginZip(Mage_Shipping_Model_Rate_Request $request = null) {
        /*
         * so, here is the plan.
         * 1) we need to get a list of warehouses in order of increasing distance to the customer zip
         * 2) we need to know which warehouses the products in the cart are available at.
         * 3) we try to find a warehouse which has all products, list order from (1)
         * 4) if we can't find such a warehouse, we ship each product from the first available warehouse
         */
        if (empty($request)) {
            return Mage::getStoreConfig('carriers/totalogistix/origin_zip');
        }
        $warehouses = $this->getDistanceOrderedWarehouses($request->getDestPostcode());
        $this->addWarehouseStockToProducts($request);
        $closestWarehouse = $this->getClosestWarehouseWithAllProducts($request, $warehouses);
        if (isset($closestWarehouse)) {
            foreach ($warehouses as $warehouse) {
                if ($warehouse['location_id'] == $closestWarehouse) {
                    /*
                     * put shippment data in the session to be used to determine
                     * warehouse stock level reductions
                     */
                    Mage::getSingleton('core/session')->setWarehouseFulfillment(array(
                        'single_warehouse' => true,
                        'location_id' => $warehouse['location_id']
                    ));
                    return $warehouse['zipcode'];
                }
            }
            Mage::throwException('Closest warehouse mismatch');
        } else {
            list($closestWarehouse, $quoteMap) = $this->getBestWarehouse($request, $warehouses);
            foreach ($warehouses as $warehouse) {
                if ($warehouse['location_id'] == $closestWarehouse) {
                    Mage::getSingleton('core/session')->setWarehouseFulfillment(array(
                        'single_warehouse' => false,
                        'fulfillment' => $quoteMap
                    ));
                    return $warehouse['zipcode'];
                }
            }
            Mage::throwException('Closest warehouse mismatch');
        }
        Mage::throwException('Unable to determine origin zip');
        return null;
    }

    private function getBestWarehouse(Mage_Shipping_Model_Rate_Request $request, array $warehouses) {
        /*
         * so here we iterate over the products. and start fulfilling the item from the closest
         * warehouse, preferring a warehouse that has all items. we simply remember the last warehouse used
         */
        $quoteMap = array();
        foreach ($request->getAllItems() as $item) {
            if($item->getProduct()->getTypeId() != "simple"){
                continue;
            }
            $bestWarehouse = 0;
            $totalFilled = 0;
            $fill = array(); // [{qty: #, warehouse: location_id}, {...},...], save the fill in the product
            for ($i = 0; $i < count($warehouses); $i++) {
                $bestWarehouse = max($i, $bestWarehouse);

                $available = $item->getWarehouse()[$warehouses[$i]['location_id']];
                if ($available >= $item->getQty()) {
                    $fill = array(array('qty' => $item->getQty(), 'location_id' => $warehouses[$i]['location_id']));
                    $totalFilled = $item->getQty();
                    break;
                } else {
                    $thisFill = min($available, $item->getQty() - $totalFilled);
                    $fill[] = array('qty' => $thisFill, 'location_id' => $warehouses[$i]['location_id']);
                    $totalFilled += $thisFill;
                }
            }
            if ($totalFilled < $item->getQty()) {

                Mage::throwException('Failed to fill full cart quantity from all warehouses');
            }
            $quoteMap[$item->getId()] = $fill;
        }
        return array($warehouses[$bestWarehouse]['location_id'], $quoteMap);
    }

    private function getClosestWarehouseWithAllProducts(Mage_Shipping_Model_Rate_Request $request, array $warehouses) {
        /*
         * so here we need to iterate over the warehouses. the first warehouse to have all items on hand will be
         * returned. otherwise return null
         */
        foreach ($warehouses as $warehouse) {
            $found = true;
            foreach ($request->getAllItems() as $item) {
                if ($item->getProductType() != 'simple') {
                    continue;
                }
                if($warehouse['name'] == 'SHELTERLOGIC' && $item->getProduct()->getStockItem()->getManageStock() == false){
                    return $warehouse['location_id'];
                }
                if ($item->getQty() > $item->getWarehouse()[$warehouse['location_id']]) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                return $warehouse['location_id'];
            }
        }

        return null;
    }

    private function addWarehouseStockToProducts(Mage_Shipping_Model_Rate_Request $request = null) {
        $ids = array();
        foreach ($request->getAllItems() as $item) {
            if ($item->getProductType() == 'simple') {
                $ids[] = $item->getProductId();
            }
        }
        /** @var Magento_Db_Adapter_Pdo_Mysql $conn */
        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        /** @var Magento_Db_Adapter_Pdo_Mysql $select */
        $select = $conn->select();
        /** @var Varien_Db_Select $from */
        $from = $select->from(
            array('gs' => $conn->getTableName('gaboli_warehouse_stock')),
            array('product_id' => 'product_id', 'location_id' => 'location_id', 'qty' => 'qty')
        );
        $from->order(array('product_id', 'location_id'));
        $from->where(sprintf("gs.product_id in ('%s')", implode("','", $ids)));

        $rows = $conn->fetchAll($select);

        $products = $request->getAllItems();

        /** @var Mage_Sales_Model_Quote_Item $product */
        foreach ($products as $product) {
            $warehouse = array();
            foreach ($rows as $row) {
                if ($row['product_id'] == $product->getProductId()) {
                    $warehouse[$row['location_id']] = $row['qty'];
                }
            }
            $product->setWarehouse($warehouse);
        }
    }

    private function getDistanceOrderedWarehouses($postcode) {
        /*
         * ok, so here we want a list of the gaboli warehouse locations
         * ordered by distance to $postcode
         */
        /** @var Magento_Db_Adapter_Pdo_Mysql $conn */
        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        /** @var Magento_Db_Adapter_Pdo_Mysql $select */
        $select = $conn->select();

        /** @var Varien_Db_Select $from */
        $from = $select->from(
            array('gwl' => $conn->getTableName('gaboli_warehouse_location')),
            array('location_id' => 'id', 'zipcode' => 'zipcode', 'name' => 'name')
        );
        $from->joinInner(
            array('source' => 'ae_totalogistix_zipcode'),
            'source.zip_code = gwl.zipcode',
            array()
        );
        $from->joinInner(
            array('dest' => 'ae_totalogistix_zipcode'),
            'dest.zip_code = ' . $conn->quote($postcode),
            array()
        );

        $from->order('asin(sqrt(pow(sin(abs(radians(source.latitude) - radians(dest.latitude)) / 2), 2)
                   + cos(radians(source.latitude))
                     * cos(radians(dest.latitude))
                     * pow(sin(abs(radians(source.longitude) - radians(dest.longitude)) / 2), 2)))');

        return $conn->fetchAll($select);
    }

    private function getServiceUri() {
        return Mage::getStoreConfig('carriers/totalogistix/service_url');
    }

    public function isValidAlaskaCity ($alaskacity) {

        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');

        $select = $conn->select();
        /** @var Varien_Db_Select $from */
        $from = $select->from(
            array('aetc' => $conn->getTableName('ae_totalogistix_city')),
            array('city_id' => 'city_id', 'city' => 'city')
        );
       $from->where("city = ? ",$alaskacity);

        $count = count($conn->fetchAll($select));

        if ($count > 0 )
            return true;
        else
            return false;

    }

}