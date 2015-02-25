<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 12/12/14
 * Time: 8:19 AM
 */
class Americaneagle_Visual_Helper_Visual extends Mage_Core_Helper_Abstract {
	/** @var Americaneagle_Visual_Helper_Data helper */
	private $helper;

	public function addNewOrderForAddress(Mage_Sales_Model_Order $order, $sid) {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}
		try {
			$options = array();
			if ($this->helper->getSoaplogEnable()) {
				$options['trace'] = 1;
			}
			$options['soap_version'] = SOAP_1_2;

			$client = new SoapClient($this->helper->getServiceHost() . 'SalesOrderService.asmx?wsdl', $options);
			$header = new SoapHeader('http://tempuri.org/', 'Header', array(
				'Key' => $this->helper->getServiceKey(),
				'ExternalRefGroup' => $this->helper->getExternalRefGroup()
			));
			$client->__setSoapHeaders($header);

			$lines = array();
			$line = 1;
			/** @var Mage_Sales_Model_Order_Item $item */
			foreach ($order->getAllItems() as $item) {
				if ($item->getProductType() == 'simple' && $item->getParentItem() != null) {
					continue;
				}
				$lines[] = array(
					'LineNo' => $line,
					'QTY' => $item->getQtyOrdered(),
					'PartID' => $item->getSku(),
					'UnitPrice' => $item->getPrice(),
					'LineDescription' => $item->getName(),
					'LineStatus' => 'A',
					'AutoAllocateInventory' => 0,
					'CreateNewWorkOrder' => 1,
					'FreightCost' => $order->getShippingAmount(),
					'WarehouseID' => $this->helper->getWarehouseId(),
					'ProductCode' => current($item->getChildrenItems())->getProduct()->getProductCode()
				);
				$line++;

			}

			/** @var Mage_Sales_Model_Order_Address $billingAddress */
			$billingAddress = $order->getBillingAddress();
			$newOrder = array(
				'data' => array(
					'ReturnErrorInResponse' => 0,
					'UseIndependentTransactions' => 0,
					'Orders' => array(
						'CustomerOrderHeader' => array(
							'CustomerOrderID' => $order->getIncrementId(),
							'OrderDate' => date('c', strtotime($order->getCreatedAt())),
							'CustomerID' => $this->helper->getCustomerId(),
							'DesiredShipDate' => date('c', $this->helper->getLeadTimeDate($order->getCreatedAt())),
							'ShipToId' => $sid,
							'Status' => 'F',
							'ShipVIA' => 'LTL',
							'CarrierID' => $this->helper->stripCarrierCode($order->getShippingMethod()),
							'ContactFirstName' => $billingAddress->getFirstname(),
							'ContactLastName' => $billingAddress->getLastname(),
							'ContactPhoneNumber' => $billingAddress->getTelephone(),
							'ContactEmail' => $billingAddress->getEmail(),
							'SiteID' => $this->helper->getSiteId(),
							'CurrencyID' => $this->helper->getCurrencyId(),
							'CustomerPurchaseOrderID' => $order->getPayment()->getCcTransId(),
							'FOB' => $this->helper->getFob(),
							'Lines' => array(
								'CustomerOrderLine' => $lines
							)
						)
					)
				)
			);


			$res = $client->CreateSalesOrder($newOrder);
			$this->soapLog($client, 'CustomerService:addNewOrderForAddress', sprintf('Add New Order'));
			return $res;

		} catch (Exception $e) {
			$this->soapLogException(isset($client) ? $client : null, 'CustomerService:addNewOrderForAddress', sprintf('Exception: %s', $e->getMessage()));
			//throw $e;
			return false;
		}

	}

	public function addNewAddress(Mage_Sales_Model_Order_Address $address) {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}

		try {
			$options = array();
			if ($this->helper->getSoaplogEnable()) {
				$options['trace'] = 1;
			}
			$options['soap_version'] = SOAP_1_2;

			$client = new SoapClient($this->helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
			$header = new SoapHeader('http://tempuri.org/', 'Header', array(
				'Key' => $this->helper->getServiceKey(),
				'ExternalRefGroup' => $this->helper->getExternalRefGroup()
			));
			$client->__setSoapHeaders($header);
			$newAddress = array(
				'customerID' => $this->helper->getCustomerId(),
				'caData' => array(
					'Name' => $address->getName(),
					'Address1' => $address->getStreet1(),
					'Address2' => $address->getStreet2(),
					'Address3' => $address->getTelephone(),
					'City' => $address->getCity(),
					'State' => $address->getRegionCode(),
					'ZipCode' => $address->getPostcode(),
					'Country' => $address->getCountryId() == 'US' ? 'USA' : $address->getCountryId()
				),
				'siteFormat' => 'FLEMING'
			);

			$res = $client->AddNewAddress($newAddress);
			$this->soapLog($client, 'CustomerService:AddNewAddress', sprintf('Add New Address %s', print_r($newAddress, true)));
			return $res;

		} catch (Exception $e) {
			$this->soapLogException(isset($client) ? $client : null, 'CustomerService:AddNewAddress', sprintf('Exception: %s', $e->getMessage()));
			//throw $e;
			return false;
		}

	}

	public function createVisualCustomerId($cid) {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}

		try {
			$options = array();
			if ($this->helper->getSoaplogEnable()) {
				$options['trace'] = 1;
			}
			$options['soap_version'] = SOAP_1_2;

			$client = new SoapClient($this->helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
			$header = new SoapHeader('http://tempuri.org/', 'Header', array(
				'Key' => $this->helper->getServiceKey(),
				'ExternalRefGroup' => $this->helper->getExternalRefGroup()
			));
			$client->__setSoapHeaders($header);
			$res = $client->CreateCustomer(
				array(
					'data' => array(
						'Customers' => array(
							'Customer' => array(
								'CustomerID' => $cid,
								'CustomerName' => $cid,
								'CurrencyID' => $this->helper->getCurrencyId(),
								'TermsID' => $this->helper->getTermsId(),
								'SalesRepID' => $this->helper->getSalesRepId(),
								'TerritoryID' => $this->helper->getTerritoryId(),
								'Entities' => array(
									'CustomerEntity' => array(
										'EntityID' => $this->helper->getEntityId()
									)
								),
								'Sites' => array(
									'CustomerSite' => array(
										'SiteID' => $this->helper->getSiteId()
									)
								)
							)
						)
					)
				)
			);
			$this->soapLog($client, 'CustomerService:CreateCustomer', sprintf('Create Customer %s', $cid));
			return $res;

		} catch (Exception $e) {
			$this->soapLogException(isset($client) ? $client : null, 'CustomerService:CreateCustomer', sprintf('Exception: %s', $e->getMessage()));
			throw $e;
		}
	}

	public function getVisualCustomerById($cid) {
		if (!isset($this->helper)) {
			$this->helper = Mage::helper('americaneagle_visual');
		}

		try {

			$options = array();
			if ($this->helper->getSoaplogEnable()) {
				$options['trace'] = 1;
			}
			$options['soap_version'] = SOAP_1_2;

			$client = new SoapClient($this->helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
			$header = new SoapHeader('http://tempuri.org/', 'Header', array(
				'Key' => $this->helper->getServiceKey()));
			$client->__setSoapHeaders($header);
			$res = $client->SearchCustomer(
				array(
					'data' => array(
						'Customers' => array(
							'Customer' => array(
								'CustomerID' => $cid)
						)
					)
				)
			);
			$this->soapLog($client, 'CustomerService:SearchCustomer', sprintf('Search for %s', $cid));
			return $res;
		} catch (Exception $e) {
			$this->soapLogException(isset($client) ? $client : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
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