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
     * @param CustomerService\Customer $customer
     * @param bool $update
     * @return null|CustomerService\Customer
     */
    private function _createVisualCustomer(CustomerService\Customer $customer, $update = false){
        try {

            $customer
                ->setCurrencyID($this->getConfig()->getCurrencyId())
                ->setTermsID($this->getConfig()->getTermsId())
                ->setSalesRepID($this->getConfig()->getSalesRepId())
                ->setTerritoryID($this->getConfig()->getTerritoryId());

            if (!$update) {
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

            /*$res = $this->customerService->CreateCustomer(
                new CustomerService\CreateCustomer($customerData));

            $this->soapLog($this->customerService, 'CustomerService:CreateCustomer', sprintf('Create Customer %s', $cid));

            if (count($res->getCreateCustomerResult()->getCustomers()->getCustomer()) == 0) {
                return null;
            }
            $customer = $res->getSearchCustomerResult()->getCustomers()->getCustomer()[0];
            return $customer->getCustomerID() == $cid ? $customer : null;*/
            return null;
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
     * @param Mage_Customer_Model_Customer $cust
     * @return null|CustomerService\Customer
     */
    public function createVisualCustomer(Mage_Customer_Model_Customer $cust){

        $billing = $cust->getDefaultBillingAddress();
        $shipping = $cust->getDefaultShippingAddress();

        if (!$billing || !$shipping) return null;

        $customer = (new CustomerService\Customer())
            ->setCustomerName($shipping->getName())
            ->setAddress1($shipping->getStreet1())
            ->setAddress2($shipping->getStreet2())
            ->setAddress3($shipping->getStreet3())
            ->setCity($shipping->getCity())
            ->setZipCode($shipping->getPostcode())
            ->setState($this->findRegionCode($shipping->getRegionId()))
            ->setCountry($this->findCountryIso3Code($shipping->getCountry()))
            ->setBillingName($billing->getName())
            ->setBillingAddress1($billing->getStreet1())
            ->setBillingAddress2($billing->getStreet2())
            ->setBillingAddress3($billing->getStreet3())
            ->setBillingCity($billing->getCity())
            ->setBillingZipCode($billing->getPostcode())
            ->setBillingState($this->findRegionCode($billing->getRegionId()))
            ->setBillingCountry($this->findCountryIso3Code($billing->getCountry()))
            ->setUserDefined1($cust->getId());


        $update = false;
        if ($cust->getVisualCustomerId()) {
            $customer->setCustomerID($cust->getVisualCustomerId());
            $update = true;
        } else {
            $customer
                ->setContactFirstName($billing->getFirstname())
                ->setContactMiddleInitial($billing->getMiddlename() ? substr($billing->getMiddlename(),0,1) : null)
                ->setContactLastName($billing->getLastname())
                ->setContactMobileNumber($billing->getTelephone())
                ->setContactEmail($cust->getEmail());
        }

        return null; //$this->_createVisualCustomer($customer, $update);
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