<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 12/12/14
 * Time: 8:19 AM
 */

require_once('Americaneagle/Visual/wsdl/CustomerService/autoload.php');
require_once('Americaneagle/Visual/wsdl/SalesOrderService/autoload.php');

use Visual\CustomerService;
use Visual\SalesOrderService;

class Americaneagle_Visual_Helper_Visual extends Mage_Core_Helper_Abstract {
	/** @var Americaneagle_Visual_Helper_Data helper */
	private $helper;
	/** @var Visual\CustomerService\CustomerService */
	private $customerService;
	/** @var Visual\CustomerService\OrderService */
	private $orderService;

	public function __construct() {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}
		$options = array();
		if ($this->helper->getSoaplogEnable()) {
			$options['trace'] = 1;
		}
		$options['soap_version'] = SOAP_1_2;

		$header = new SoapHeader('http://tempuri.org/', 'Header', array(
				'Key' => $this->helper->getServiceKey(),
				'ExternalRefGroup' => $this->helper->getExternalRefGroup()));

		$this->customerService = new CustomerService\CustomerService($options);
		$this->customerService->__setSoapHeaders($header);

		$this->orderService = new SalesOrderService\SalesOrderService($options);
		$this->orderService->__setSoapHeaders($header);
	}

	public function addNewOrderForAddress(Mage_Sales_Model_Order $order, $sid) {
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
					->setContactPhoneNumber( $billingAddress->getTelephone())
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

	public function addNewAddress(Mage_Sales_Model_Order_Address $address) {
		try {
			$newAddress = (new CustomerService\CustomerAddress())
					->setName($address->getName())
					->setAddress1($address->getStreet1())
					->setAddress2($address->getStreet2())
					->setAddress3($address->getStreet3())
					->setCity($address->getCity())
					->setState($address->getRegionCode())
					->setZipCode($address->getPostcode())
					->setCountry($address->getCountryId() == 'US' ? 'USA' : $address->getCountryId());

			$res = $this->customerService->AddNewAddress(
					new CustomerService\AddNewAddress(
						$this->helper->getCustomerId(),
						$newAddress,
						'FLEMING'));

			$this->soapLog($this->customerService, 'CustomerService:AddNewAddress', sprintf('Add New Address %s', print_r($newAddress, true)));
			return $res;
		} catch (Exception $e) {
			$this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:AddNewAddress', sprintf('Exception: %s', $e->getMessage()));
			//throw $e;
			return false;
		}
	}

	public function createVisualCustomerId($cid) {
		try {

			$customerEntity = (new CustomerService\CustomerEntity())
					->setEntityID($this->helper->getEntityId());

			$customerSite = (new CustomerService\CustomerSite())
					->setSiteID($this->helper->getSiteId());

			$customer = (new CustomerService\Customer())
					->setCustomerID($cid)
					->setCustomerName($cid)
					->setCurrencyID($this->helper->getCurrencyId())
					->setTermsID($this->helper->getTermsId())
					->setSalesRepID($this->helper->getSalesRepId())
					->setTerritoryID($this->helper->getTerritoryId())
					->setEntities(array($customerEntity))
					->setSites(array($customerSite));

			$customerData = (new CustomerService\CustomerData())
					->setCustomers(array($customer));

			$res = $this->customerService->CreateCustomer(
					new CustomerService\CreateCustomer($customerData));

			$this->soapLog($this->customerService, 'CustomerService:CreateCustomer', sprintf('Create Customer %s', $cid));
			return $res;
		} catch (Exception $e) {
			$this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:CreateCustomer', sprintf('Exception: %s', $e->getMessage()));
			throw $e;
		}
	}

	public function getVisualCustomerById($cid) {
		try {
			$cust = (new CustomerService\Customer())
					->setCustomerID($cid);

			$custData = (new CustomerService\CustomerData())
					->setCustomers(array($cust));

			$res = $this->customerService->SearchCustomer(new CustomerService\SearchCustomer($custData));

			$this->soapLog($this->customerService, 'CustomerService:SearchCustomer', sprintf('Search for %s', $cid));
			return $res;
		} catch (Exception $e) {
			$this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
			throw $e;
		}

		return null;
	}

	public function getNewCustomers($keyword) {
		try {
			$cust = (new CustomerService\Customer())
					->setTerritoryID('WEB')
					->setCustomerName("{$keyword}%");

			$custData = (new CustomerService\CustomerData())
					->setCustomers(array($cust));

			$req = new CustomerService\SearchCustomerLike($custData);

			$res = $this->customerService->SearchCustomerLike($req);
			$this->soapLog($this->customerService, 'CustomerService:SearchCustomerLike', sprintf('Search for %s', 'Fred%'));
			return $res->getSearchCustomerLikeResult()->getCustomers()->getCustomer();
		} catch (Exception $e) {
			$this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
			throw $e;
		}

		return null;
	}

	public function soapLog(SoapClient $client, $code, $message) {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}
		if (!$this->helper->getSoaplogEnable()) {
			return;
		}
		$log = Mage::getModel('americaneagle_visual/soaplog');
		$log->setCode($code);
		$log->setDatetime(Varien_Date::now());
		$log->setMessage($message);
		$log->setRequestData($client->__getLastRequest());
		$log->setResponseData($client->__getLastResponse());
		$log->save();
	}

	public function soapLogException($client, $code, $message) {

		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}
		if (!$this->helper->getSoaplogEnable()) {
			return;
		}
		$log = Mage::getModel('americaneagle_visual/soaplog');
		$log->setCode($code);
		$log->setDatetime(Varien_Date::now());
		$log->setMessage($message);
		if (isset($client)) {
			$log->setRequestData($client->__getLastRequest());
			$log->setResponseData($client->__getLastResponse());
		}
		$log->save();

	}
} 