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
     * @param $customerId
     * @param Mage_Sales_Model_Order_Address $address
     * @return null|string
     */
    public function getShipToId($customerId, Mage_Sales_Model_Order_Address $address) {
        try {
            $loadShipToByAddress = new CustomerService\LoadShipTOByAddress($customerId,
                (new CustomerService\CustomerAddress())
                    ->setName($address->getName())
                    ->setAddress1($address->getStreet1())
                    ->setAddress2($address->getStreet2())
                    ->setAddress3($address->getStreet3())
                    ->setCity($address->getCity())
                    ->setState($address->getRegionCode())
                    ->setZipCode($address->getPostcode())
                    ->setCountry($this->findCountryIso3Code($address->getCountryId())));

            $res = $this->customerService->LoadShipTOByAddress($loadShipToByAddress);

            $this->soapLog($this->customerService, 'CustomerService:LoadShipTOByAddress', sprintf('Get address ship to %s', print_r($loadShipToByAddress, true)));
            return $res->getLoadShipTOByAddressResult() ? $res->getLoadShipTOByAddressResult() : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:LoadShipTOByAddress', sprintf('Exception: %s', $e->getMessage()));
            //throw $e;
            return null;
        }
    }

    /**
     * @param CustomerService\Customer $customer
     * @param bool $update
     * @return null|CustomerService\Customer
     */
    private function _createVisualCustomer(CustomerService\Customer $customer, $update = false){
        try {

            if (!$update) {
                $customer
                    ->setCurrencyID($this->getConfig()->getCurrencyId())
                    ->setTermsID($this->getConfig()->getTermsId())
                    ->setSalesRepID($this->getConfig()->getSalesRepId())
                    ->setTerritoryID($this->getConfig()->getTerritoryId())
                    ->setSiteID($this->getConfig()->getSiteId());

                $customerEntity = (new CustomerService\CustomerEntity())
                    ->setEntityID($this->getConfig()->getEntityId());
                $customerEntityArray = (new CustomerService\ArrayOfCustomerEntity())
                    ->setCustomerEntity(array($customerEntity));

                $customerSite = (new CustomerService\CustomerSite())
                    ->setSiteID($this->getConfig()->getSiteId());
                $customerSites = (new CustomerService\ArrayOfCustomerSite())
                    ->setCustomerSite(array($customerSite));
                $customer
                    ->setEntities($customerEntityArray)
                    ->setSites($customerSites);
            }

            $customerArray = (new CustomerService\ArrayOfCustomer())
                ->setCustomer(array($customer));

            $customerData = (new CustomerService\CustomerData())
                ->setCustomers($customerArray);

            $res = $this->customerService->CreateCustomer(
                new CustomerService\CreateCustomer($customerData));

            if (count($res->getCreateCustomerResult()->getCustomers()->getCustomer()) == 0) {
                return null;
            } else {
                $customer = $res->getCreateCustomerResult()->getCustomers()->getCustomer()[0];
            }

            $this->soapLog($this->customerService, 'CustomerService:CreateCustomer', sprintf('%s Customer %s',$update ? 'Update' : "Create", $customer->getCustomerID()));

            return $customer;

        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:CreateCustomer', sprintf('Exception: %s', $e->getMessage()));
            return null;
        }
    }


    /**
     * @param $CustomerId
     * @return null|CustomerService\Customer
     */
    public function createVisualFBCustomerById($CustomerId)
    {
        $customer = (new CustomerService\Customer())
            ->setCustomerID($CustomerId)
            ->setCustomerName($CustomerId);

        return $this->_createVisualCustomer($customer);
    }

    /**
     * Create or update customer record in Visual
     * @param Mage_Customer_Model_Customer $customer
     * @param Mage_Sales_Model_Order_Address $billing
     * @return null|CustomerService\Customer
     * @throws Exception
     */
    public function createVisualCustomer(Mage_Customer_Model_Customer &$customer, Mage_Sales_Model_Order_Address &$billing){

        if (!$billing) return null;

        $vCustomer = (new CustomerService\Customer())
            ->setBillingName($billing->getName())
            ->setBillingAddress1($billing->getStreet1())
            ->setBillingAddress2($billing->getStreet2())
            ->setBillingAddress3($billing->getStreet3())
            ->setBillingCity($billing->getCity())
            ->setBillingZipCode($billing->getPostcode())
            ->setBillingState($this->findRegionCode($billing->getRegionId()))
            ->setBillingCountry($this->findCountryIso3Code($billing->getCountry()))
            ->setUserDefined1($customer->getId());

        if ($customer->getId()) {
            $vCustomer->setUserDefined1($customer->getId());
        }

        $update = false;
        if ($customer && $customer->getVisualCustomerId()) {
            $vCustomer->setCustomerID($customer->getVisualCustomerId());
            $update = true;
        } else {
            $vCustomer
                ->setCustomerName($billing->getName())
                ->setAddress1($billing->getStreet1())
                ->setAddress2($billing->getStreet2())
                ->setAddress3($billing->getStreet3())
                ->setCity($billing->getCity())
                ->setZipCode($billing->getPostcode())
                ->setState($billing->getRegionCode())
                ->setCountry($this->findCountryIso3Code($billing->getCountry()))
                ->setContactFirstName($billing->getFirstname())
                ->setContactMiddleInitial($billing->getMiddlename() ? substr($billing->getMiddlename(),0,1) : null)
                ->setContactLastName($billing->getLastname())
                ->setContactMobileNumber($billing->getTelephone())
                ->setContactEmail($customer ? $customer->getEmail() : $billing->getEmail())
                ->setCustomerID(preg_replace("/[^0-9]/", '', $customer->getPhone()));
        }

        $vCustomer = $this->_createVisualCustomer($vCustomer, $update);

        if (is_null($vCustomer)) return null;

        if ($customer->getId() && !$customer->getVisualCustomerId()) {
            $customer->setVisualCustomerId($vCustomer->getCustomerID());
            $customer->save();
        }
        return $vCustomer;
    }

    /**
     * @param $customerId
     * @return null|CustomerService\Customer
     */
    public function getVisualCustomerById($customerId)
    {
        try {
            $cust = (new CustomerService\Customer())
                ->setCustomerID($customerId);

            $custData = (new CustomerService\CustomerData())
                ->setCustomers(array($cust));

            $res = $this->customerService->SearchCustomer(new CustomerService\SearchCustomer($custData));

            $this->soapLog($this->customerService, 'CustomerService:SearchCustomer', sprintf('Search for %s', $customerId));

            if (count($res->getSearchCustomerResult()->getCustomers()->getCustomer())) {
                return null;
            }

            $customer = $res->getSearchCustomerResult()->getCustomers()->getCustomer()[0];
            return $customer->getCustomerID() == $customerId ? $customer : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
            return null;
        }

        return null;
    }

    /**
     * @param $email
     * @return null|CustomerService\Customer
     */
    public function getVisualCustomerByEmail($email)
    {
        try {
            $customerData = (new CustomerService\CustomerData())
                ->setCustomers((new CustomerService\ArrayOfCustomer())
                    ->setCustomer(array(
                        (new CustomerService\Customer())
                            ->setContactEmail($email))));

            $res = $this->customerService->SearchCustomer(new CustomerService\SearchCustomer($customerData));

            $this->soapLog($this->customerService, 'CustomerService:SearchCustomer', sprintf('Search for %s', $email));

            if (count($res->getSearchCustomerResult()->getCustomers()->getCustomer())) {
                return null;
            }

            $customer = $res->getSearchCustomerResult()->getCustomers()->getCustomer()[0];
            return $customer ? $customer : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->customerService) ? $this->customerService : null, 'CustomerService:SearchCustomer', sprintf('Exception: %s', $e->getMessage()));
            return null;
        }
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

    /**
     * @param $event
     * @return $this
     * @throws Mage_Core_Exception
     */
    public function customerCustomerAuthenticated($event)
    {
        if($this->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $customer = $event->getModel();

        if (!empty($customer->getVisualCustomerId)) {
            $vCustomer = $this->getVisualCustomerById($customer->getVisualCustomerId);
            if(is_null($vCustomer)) {
                throw Mage::exception('Mage_Core', Mage::helper('customer')->__('We are not able to reach the service please try again later.'),
                    Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD
                );
            }
        }
    }

    /**
     * @param $countryCode
     * @return mixed
     */
    function findCountryId($countryCode){
        if (!Mage::registry("country_{$countryCode}")) {
            $country = Mage::getModel('directory/country')
                ->getCollection()
                ->addCountryCodeFilter($countryCode)
                ->getFirstItem();
            Mage::register("country_{$countryCode}", $country->getId());
        }

        return Mage::registry("country_{$countryCode}");
    }

    /**
     * @param $countryCode
     * @return mixed
     */
    function findCountryIso3Code($countryCode){
        if (!Mage::registry("country_iso3_{$countryCode}")) {
            $country = Mage::getModel('directory/country')
                ->getCollection()
                ->addCountryCodeFilter($countryCode)
                ->getFirstItem();
            Mage::register("country_iso3_{$countryCode}", $country->getIso3Code());
        }

        return Mage::registry("country_iso3_{$countryCode}");
    }


    /**
     * @param $countryCode
     * @param $regionCode
     * @return mixed
     */
    function findRegionId($countryCode, $regionCode){
        if (!Mage::registry("region_{$countryCode}_{$regionCode}")) {
            $region = Mage::getModel('directory/region')
                ->getCollection()
                ->addCountryCodeFilter($countryCode)
                ->addRegionCodeFilter($regionCode)
                ->getFirstItem();
            Mage::register("region_{$countryCode}_{$regionCode}", $region->getId());
        }

        return Mage::registry("region_{$countryCode}_{$regionCode}");
    }

    /**
     * @param $regionId
     * @return mixed
     */
    function findRegionCode($regionId){
        if (!Mage::registry("region_{$regionId}")) {
            $region = Mage::getModel('directory/region')
                ->load($regionId);
            Mage::register("region_{$regionId}", $region->getCode());
        }

        return Mage::registry("region_{$regionId}");
    }
}