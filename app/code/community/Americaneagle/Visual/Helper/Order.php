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
     * @param $sid
     * @return bool|SalesOrderService\CreateSalesOrderResponse
     */
    public function addNewOrderForAddress(Mage_Sales_Model_Order $order, $sid)
    {
        try {
            $lines = array();
            $line = 1;
            /** @var Mage_Sales_Model_Order_Item $item */
            foreach ($order->getAllItems() as $item) {
                if ($item->getProductType() == 'simple' && $item->getParentItem() != null) {
                    continue;
                }
                $lineItem = (new SalesOrderService\CustomerOrderLine($item->getQtyOrdered(), false))
                    ->setLineNo($line)
                    ->setPartID($item->getSku())
                    ->setUnitPrice($item->getPrice())
                    ->setLineDescription($item->getName())
                    ->setLineStatus('A')
                    ->setCreateNewWorkOrder(1)
                    ->setFreightCost($order->getShippingAmount())
                    ->setWarehouseID($this->helper->getWarehouseId())
                    ->setProductCode(current($item->getChildrenItems())->getProduct()->getProductCode());
                $lines[] = $lineItem;
                $line++;
            }

            /** @var Mage_Sales_Model_Order_Address $billingAddress */
            $billingAddress = $order->getBillingAddress();

            $newOrderHeader = (new \Visual\SalesOrderService\CustomerOrderHeader())
                ->setCustomerOrderID($order->getIncrementId())
                ->setOrderDate(date('c', strtotime($order->getCreatedAt())))
                ->setCustomerID($this->helper->getCustomerId())
                ->setDesiredShipDate(date('c', $this->helper->getLeadTimeDate($order->getCreatedAt())))
                ->setShipToID($sid)
                ->setStatus('R')
                ->setShipVIA('LTL')
                ->setCarrierID($this->helper->stripCarrierCode($order->getShippingMethod()))
                ->setContactFirstName($billingAddress->getFirstname())
                ->setContactLastName($billingAddress->getLastname())
                ->setContactPhoneNumber($billingAddress->getTelephone())
                ->setContactEmail($billingAddress->getEmail())
                ->setSiteID($this->helper->getSiteId())
                ->setCurrencyID($this->helper->getCurrencyId())
                ->setCustomerPurchaseOrderID($order->getPayment()->getCcTransId())
                ->setFOB($this->helper->getFob())
                ->setTerritoryID($this->helper->getTerritoryId())
                ->setLines($lines);

            $newOrderData = (new SalesOrderService\CustomerOrderData())
                ->setOrders(array($newOrderHeader));

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
            $count = intval($order->getData('ae_visual_push_attempt'));
            $order->setData('ae_visual_push_attempt', $count + 1);
            $order->save();
            if($count > $max)
                $max = $count;
            if($count > 1)
                $fails[] = $order->getIncrementId();
        }
        if($max == 10 || $max == 75 || ($max > 0 && ($max % 200) == 0)){
            $email = Mage::getStoreConfig('aevisual/logging/pushfail_email');
            $f_name = Mage::getStoreConfig('trans_email/ident_general/name');
            $f_email = Mage::getStoreConfig('trans_email/ident_general/email');
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