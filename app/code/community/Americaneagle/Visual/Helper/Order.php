<?php
/**
 * Created by PhpStorm.
 * User: Levente Albert
 * Date: 11/25/15
 * Time: 11:25 AM
 */
require('Americaneagle/Visual/wsdl/SalesOrderService/autoload.php');

use Visual\SalesOrderService as SalesOrderService;

class Americaneagle_Visual_Helper_Order extends Americaneagle_Visual_Helper_Visual
{
    /** @var Visual\CustomerService\CustomerService */
    private $orderService;

    public function __construct()
    {
        parent::__construct();
        $this->orderService = new SalesOrderService\SalesOrderService($this->getOptions());
        $this->orderService->__setSoapHeaders($this->getHeader());
    }

    /**
     * @param Mage_Sales_Model_Order $order
     * @param $customerId
     * @param $shipToId
     * @param null $shipVIA
     * @return bool|SalesOrderService\CreateSalesOrderResponse
     */
    public function addNewOrderForAddress(Mage_Sales_Model_Order $order, $customerId, $shipToId, $shipVIA = null)
    {
        try {
            $lines = array();
            $line = 1;
            $isLTL = false;
            /** @var Mage_Sales_Model_Order_Item $item */
            $orderStockSource = Mage::getModel('gaboli_warehouse/order_stock_source')
                    ->getCollection()
                    ->join(array('l' => 'gaboli_warehouse/location'),
                        'location_id = l.id',
                        array('warehouse_code' => 'name'))
                    ->join(array('oi' => 'sales/order_item'),
                        'sales_quote_item_id = oi.quote_item_id',
                        array('item_id'))
                    ->addFieldToFilter('oi.order_id', array('eq' => $order->getId()))
                    ->load();

            foreach ($order->getAllItems() as $item) {
                if ($item->getProductType() == 'simple' && $item->getParentItem() != null) {
                    continue;
                }
                /** @var  Mage_Catalog_Model_Product $product */
                $product = $item->getProduct();
                if ($product->getTlxPalletWeight() > 0 && $product->getTlxShipLtl()) {
                    $isLTL = true;
                }

                foreach ($orderStockSource as $stockItem){
                    if ($stockItem->getItemId() == $item->getId()) {
                        $lineItem = (new SalesOrderService\CustomerOrderLine($item->getQtyOrdered(), false))
                            ->setLineNo($line)
                            ->setPartID($item->getSku())
                            ->setUnitPrice($item->getPrice())
                            ->setLineDescription($item->getName())
                            ->setLineStatus('A')
                            ->setCreateNewWorkOrder(1)
                            ->setQTY($stockItem->getQty())
                            ->setFreightCost($order->getShippingAmount())
                            ->setWarehouseID($stockItem->getWarehouseCode());

                        if ($item->getProductType() == 'simple' && $product->getProductCode()) {
                            $lineItem->setProductCode($product->getProductCode());
                        } elseif ($item->getProductType() == 'configurable' && $item->getChildrenItems()) {
                            $childProduct = current($item->getChildrenItems())->getProduct();
                            if ($childProduct->getProductCode()) {
                                $lineItem->setProductCode($childProduct->getProductCode());
                            }
                        }
                        $lines[] = $lineItem;
                        $line++;
                    }
                }
            }

            /** return nothing if there are no line items. */
            if (count($lines) == 0) {
                return null;
            } else {}

            /** @var Mage_Sales_Model_Order_Address $billingAddress */
            $billingAddress = $order->getBillingAddress();

            /** @var SalesOrderService\CustomerOrderHeader $newOrderHeader */
            $newOrderHeader = (new SalesOrderService\CustomerOrderHeader())
                ->setCustomerOrderID($order->getIncrementId())
                ->setOrderDate(new DateTime($order->getCreatedAt()))
                ->setCustomerID($customerId)
                ->setDesiredShipDate($this->getConfig()->getLeadTimeDate($order->getCreatedAt()))
                ->setShipToID($shipToId)
                ->setStatus('R')
                ->setShipVIA(!is_null($shipVIA) ? $shipVIA : ($isLTL ? 'LTL' : 'PACKAGE'))
                ->setCarrierID($this->getConfig()->stripCarrierCode($order->getShippingMethod()))
                ->setContactFirstName($billingAddress->getFirstname())
                ->setContactLastName($billingAddress->getLastname())
                ->setContactPhoneNumber($billingAddress->getTelephone())
                ->setContactEmail($billingAddress->getEmail())
                ->setSiteID($this->getConfig()->getSiteId())
                ->setCurrencyID($this->getConfig()->getCurrencyId())
                ->setCustomerPurchaseOrderID($order->getPayment()->getCcTransId())
                ->setFOB($this->getConfig()->getFob())
                ->setTerritoryID($this->getConfig()->getTerritoryId())
                ->setLines((new SalesOrderService\ArrayOfCustomerOrderLine())
                    ->setCustomerOrderLine($lines));

            $newOrderData = (new SalesOrderService\CustomerOrderData())
                ->setOrders((new SalesOrderService\ArrayOfCustomerOrderHeader())
                    ->setCustomerOrderHeader(array($newOrderHeader)));

            $res = $this->orderService->CreateSalesOrder(new SalesOrderService\CreateSalesOrder($newOrderData));

            $this->soapLog($this->orderService, 'CustomerService:addNewOrderForAddress', sprintf('Add New Order'));
            return $res;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->orderService) ? $this->orderService : null, 'CustomerService:addNewOrderForAddress', sprintf('Exception: %s', $e->getMessage()));
            //throw $e;
            return false;
        }

    }

    /**
     * @param Mage_Sales_Model_Resource_Order_Collection $coll
     * @throws Exception
     */
    public function auditCollectionPush(Mage_Sales_Model_Resource_Order_Collection $coll) {
        $max = 0;
        $fails = array();
        foreach($coll as $order) {
            $count = intval($order->getAeVisualPushAttempt());
            $order->setAeVisualPushAttempt($count + 1);
            $order->save();
            if($count > $max)
                $max = $count;
            if($count > 1)
                $fails[] = $order->getIncrementId();
        }
        if($max == 10 || $max == 75 || ($max > 0 && ($max % 200) == 0)){
            $email = $this->getConfig()->getPushFailEmail();
            $f_name = $this->getConfig()->getPushFailFromName();
            $f_email =$this->getConfig()->getPushFailFromEmail();
            if($email) {
                mail(
                    $email,
                    'Order push to VISUAL failure notice',
                    "NOTICE: The following orders have failed to push to VISUAL:\r\n" . implode("\r\n", $fails) . "\r\n\r\nPlease review the VISUAL Soap log for more information.",
                    "From: $f_name <$f_email>"
                );
            }
        }
    }
}