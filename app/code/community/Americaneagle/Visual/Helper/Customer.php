<?php
/**
 * Created by PhpStorm.
 * User: Levente Albert
 * Date: 11/25/15
 * Time: 11:25 AM
 */
require('Americaneagle/Visual/wsdl/CustomerService/autoload.php');

use Visual\CustomerService as CustomerService;

class Americaneagle_Visual_Helper_Customer extends Americaneagle_Visual_Helper_Visual
{
    /** @var Visual\CustomerService\CustomerService */
    private $customerService;

    public function __construct()
    {
        parent::__construct();
        $this->customerService = new CustomerService\CustomerService($this->getOptions());
        $this->customerService->__setSoapHeaders($this->getHeader());
    }


    /**
     * @param Mage_Sales_Model_Order_Address $address
     * @param $customerId
     * @return bool|CustomerService\CustomerAddress
     */
    public function addNewAddress(Mage_Sales_Model_Order_Address $address, $customerId)
    {
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
                    $customerId,
                    $newAddress,
                    'FLEMING'));

            $this->soapLog($this->customerService, 'CustomerService:AddNewAddress', sprintf('Add New Address %s', print_r($newAddress, true)));
            return $res->getAddNewAddressResult();
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:AddNewAddress', sprintf('Exception: %s', $e->getMessage()));
            //throw $e;
            return false;
        }
    }


    /**
     * @param $cid
     * @return null|CustomerService\Customer
     */
    public function createVisualCustomer($cid)
    {
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

            if (count($res->getCreateCustomerResult()->getCustomers()->getCustomer()) == 0) {
                return null;
            }
            $customer = $res->getSearchCustomerResult()->getCustomers()->getCustomer()[0];
            return $customer->getCustomerID() == $cid ? $customer : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:CreateCustomer', sprintf('Exception: %s', $e->getMessage()));
            return null;
        }
    }

    /**
     * @param $cid
     * @return null|CustomerService\Customer
     */
    public function getVisualCustomerById($cid)
    {
        try {
            $cust = (new CustomerService\Customer())
                ->setCustomerID($cid);

            $custData = (new CustomerService\CustomerData())
                ->setCustomers(array($cust));

            $res = $this->customerService->SearchCustomer(new CustomerService\SearchCustomer($custData));

            $this->soapLog($this->customerService, 'CustomerService:SearchCustomer', sprintf('Search for %s', $cid));

            if (count($res->getSearchCustomerResult()->getCustomers()->getCustomer())) {
                return null;
            }

            $customer = $res->getSearchCustomerResult()->getCustomers()->getCustomer()[0];
            return $customer->getCustomerID() == $cid ? $customer : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
            return null;
        }

        return null;
    }

    /**
     * @param $start
     * @param $count
     * @param $startDate
     * @return null|CustomerService\CustomerDataResponse
     * @throws Exception
     */
    public function getNewCustomers($start, $count, $startDate)
    {
        try {
            $params = new CustomerService\GetCustomerList($this->getConfig()->getSiteId(), "N", $start, $count, null, null, $startDate != null ? "Y" : null, $startDate, null, null, $this->getConfig()->getTerritoryId());

            $res = $this->customerService->GetCustomerList($params)->getGetCustomerListResult();
            $this->soapLog($this->customerService, 'CustomerService:GetCustomerList', sprintf('Search for %s', 'Fred%'));

            return $res;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:GetCustomerList', sprintf('Exception: %s', $e->getMessage()));
            throw $e;
        }

        return null;
    }
}