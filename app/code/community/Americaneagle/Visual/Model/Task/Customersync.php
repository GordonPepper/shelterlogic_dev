<?php

/**
 * Customer Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-11-9
 */

class Americaneagle_Visual_Model_Task_Customersync
{

    /** @var  Americaneagle_Visual_Helper_Customer helper */
    private $helper;

    private $pageSize = 1000;
    private $productSkuList = array();
    private $countInsert = 0;
    private $countUpdate = 0;
    private $errors = array();
    private $startDate;

    /** @var  Americaneagle_Visual_Helper_UserDefinedFieldService $customerHelper */
    private $customerHelper;

    /** @var  Mage_Core_Model_Store store */
    private $store;

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        $this->helper = Mage::helper('americaneagle_visual/customer');

        if($this->helper->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $parameters = $schedule->getParameters();
        $this->store = Mage::getModel('core/store');
        $date = new DateTime();
        $date->sub(new DateInterval('P1D'));
        $this->startDate = $date->format('Y-m-d');

        $message = '';

        if ($parameters) {
            $parameters = json_decode($parameters);
            if ($parameters->store_ids) {
                $store_ids = $parameters->store_ids;
            } else {
                return false;
            }
            if (isset($parameters->page_size)) {
                $this->pageSize = (int)$parameters->page_size;
            }
            if ($parameters->skip_date_filter) {
                $this->startDate = null;
            }
        } else {
            return false;
        }

        foreach ($store_ids as $storeId) {
            $this->store->load($storeId);
            $this->helper->getConfig()->setStore($this->store);

            $startTime = microtime(true);

            $this->getRecursiveCustomers(0);

            if (count($this->errors) > 0) {
                $message .= 'Store ' . $storeId . ' - Items imported: ' . $this->countInsert . ' - Items updated: ' . $this->countUpdate .  ' Time:' . (microtime(true)-$startTime) . ' Errors:(' . count($this->errors) . ')' . json_encode($this->errors, JSON_PRETTY_PRINT) . "\r\n";
            } else {
                $message .= 'Store ' . $storeId . ' - Items imported: ' . $this->countInsert . ' - Items updated: ' . $this->countUpdate .' Time:' . (microtime(true)-$startTime) . "\r\n";
            }

            $this->countInsert = 0;
            $this->countUpdate = 0;
            $this->errors = array();
        }

        return $message;
    }


    /**
     * @param $page
     * @throws Exception
     */
    function getRecursiveCustomers($page){
//        printf("\nGetting page %d\n", $page + 1);

        /** @var Visual\CustomerService\CustomerDataResponse $newCustomersResponse */
        $newCustomersResponse = $this->helper->getNewCustomers($page * $this->pageSize + 1, $this->pageSize, $this->startDate);
        $customerList = $newCustomersResponse->getCustomerList()->getCustomerListItem();

//        printf("Processing %d items\n", count($customerList));

        $fail = false;

        for ($i = 0; $i < count($customerList); $i++) {
            $customerItem = $customerList[$i];
            /** @var Mage_Customer_Model_Customer $customer */
            $customer = $this->findCustomerByVisualId($customerItem->getID());
            $vCustomer = $customerItem->getCustomer();

            $this->customerHelper = Mage::helper('americaneagle_visual/UserDefinedFieldService');

            $webLogin = $this->customerHelper->getWebLogin($customerItem->getID());
            if(is_null($webLogin)) {
                continue;
            }

            if ($customer == null) {
                $customer = Mage::getModel("customer/customer");
                $customer
                    ->setWebsiteId($this->store->getWebsiteId())
                    ->setStore($this->store)
                    ->setGroupId(strtolower($vCustomer->getPriceGroup())=='exclusive' ? $this->helper->getConfig()->getExclusiveGroupId() : $this->helper->getConfig()->getGeneralGroupId()) //adding it to the General or exclusive group
                    ->setFirstname($vCustomer->getContactFirstName())
                    ->setMiddlename($vCustomer->getContactMiddleInitial())
                    ->setLastname($vCustomer->getContactLastName())
                    ->setEmail($webLogin)
                    ->setPhone($vCustomer->getContactPhoneNumber())
                    ->setPassword($customer->generatePassword())
                    ->setVisualCustomerId(strtoupper($vCustomer->getCustomerID()))
                    ->setCreditStatus($vCustomer->getCreditStatus())
                    ->setDiscountPercent($vCustomer->getDiscountPercent())
                    ->setTermsId($vCustomer->getTermsID())
                    ->setTaxExempt($vCustomer->getTaxExempt())
                    ->setCustomerTerms($this->customerHelper->getCustomerTerms($customerItem->getID()));
//                if($this->customerHelper->getWebLogin($customerItem->getID()) != null)
//                    $customer->setEmail($this->customerHelper->getWebLogin($customerItem->getID()));

                try {
                    $customer->save();
                    $this->countInsert++;
                }
                catch (Exception $e) {
                    $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                    $fail = true;
                }

                $countryId = $vCustomer->getCountry();
                if(strtoupper($vCustomer->getCountry()) == 'USA') {
                    $countryId = 'US';
                }

                $address = Mage::getModel("customer/address")
                    ->setCustomerId($customer->getId())
                    ->setFirstname($vCustomer->getContactFirstName())
                    ->setMiddlename($vCustomer->getContactMiddleInitial())
                    ->setLastname($vCustomer->getContactLastName())
                    ->setCountryID($countryId)
                    ->setRegionId($this->helper->findRegionId($vCustomer->getBillingCountry(), $vCustomer->getBillingState()))
                    ->setPostcode($vCustomer->getBillingZipCode())
                    ->setCity($vCustomer->getBillingCity())
                    ->setStreet(array($vCustomer->getBillingAddress1(),
                        $vCustomer->getBillingAddress2(),
                        $vCustomer->getBillingAddress3()))
                    ->setState($vCustomer->getBillingState())
                    ->setTelephone($vCustomer->getContactPhoneNumber())
                    ->setIsDefaultBilling('1')
                    ->setIsDefaultShipping('0')
                    ->setSaveInAddressBook('1');

                try {
                    $address->save();
                }
                catch (Exception $e) {
                    $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                }

                if (!$fail) {
                    if (!$this->isSameShipping($vCustomer) && $vCustomer->getBillingCountry() != '') {

                        list($firstname, $middlename, $lastname) = explode(' ', $vCustomer->getBillingName(), 3);

                        /** @var Mage_Customer_Model_Address $address */
                        $address = Mage::getModel("customer/address")
                            ->setCustomerId($customer->getId())
                            ->setFirstname($firstname)
                            ->setMiddlename($middlename)
                            ->setLastname($lastname)
                            ->setCountryId($this->helper->findCountryId($vCustomer->getCountry()))
                            ->setRegionId($this->helper->findRegionId($vCustomer->getBillingCountry(), $vCustomer->getBillingState()))
                            ->setPostcode($vCustomer->getBillingZipCode())
                            ->setCity($vCustomer->getBillingCity())
                            ->setStreet(array($vCustomer->getBillingAddress1(),
                                $vCustomer->getBillingAddress2(),
                                $vCustomer->getBillingAddress3()))
                            ->setIsDefaultBilling('1')
                            ->setIsDefaultShipping('0')
                            ->setSaveInAddressBook('1');

                        try {
                            $address->save();
                        }
                        catch (Exception $e) {
                            $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                        }
                    }

                    list($firstname, $middlename, $lastname) = explode(' ', $vCustomer->getCustomerName(), 3);

                    $address = Mage::getModel("customer/address")
                        ->setCustomerId($customer->getId())
                        ->setFirstname($firstname)
                        ->setMiddlename($middlename)
                        ->setLastname($lastname)
                        ->setCountryId($this->helper->findCountryId($vCustomer->getCountry()))
                        ->setRegionId($this->helper->findRegionId($vCustomer->getCountry(), $vCustomer->getState()))
                        ->setPostcode($vCustomer->getZipCode())
                        ->setCity($vCustomer->getCity())
                        ->setStreet(array($vCustomer->getAddress1(),
                            $vCustomer->getAddress2(),
                            $vCustomer->getAddress3()))
                        ->setIsDefaultBilling($this->isSameShipping($vCustomer)?'1':'0')
                        ->setIsDefaultShipping('1')
                        ->setSaveInAddressBook('1');

                    try {
                        $address->save();
                    }
                    catch (Exception $e) {
                        $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                    }
                }
            } else {
                $customer
                    ->setFirstname($vCustomer->getContactFirstName())
                    ->setMiddlename($vCustomer->getContactMiddleInitial())
                    ->setLastname($vCustomer->getContactLastName())
                    ->setPhone($vCustomer->getContactPhoneNumber())
                    ->setGroupId(strtolower($vCustomer->getPriceGroup())=='exclusive' ? $this->helper->getConfig()->getExclusiveGroupId() : $this->helper->getConfig()->getGeneralGroupId()) //adding it to the General or exclusive group
                    ->setCreditStatus($vCustomer->getCreditStatus())
                    ->setDiscountPercent($vCustomer->getDiscountPercent())
                    ->setTermsId($vCustomer->getTermsID())
                    ->setTaxExempt($vCustomer->getTaxExempt())
                    ->setCustomerTerms($this->customerHelper->getCustomerTerms($customerItem->getID()))
                    ->setEmail($webLogin);
//                    if($this->customerHelper->getWebLogin($customerItem->getID()) != null)
//                        $customer->setEmail($this->customerHelper->getWebLogin($customerItem->getID()));

                try {
                    $customer->save();
                    $this->countUpdate++;
                }
                catch (Exception $e) {
                    $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                }

                $customer = Mage::getModel('customer/customer')->load($customer->getId());
                $address = Mage::getModel('customer/address');

                $countryId = $vCustomer->getCountry();
                if(strtoupper($vCustomer->getCountry()) == 'USA') {
                    $countryId = 'US';
                }
                if ($default_billing_id = $customer->getDefaultBilling()) {
                    $address->load($default_billing_id);
                } else {

                    $address
                        ->setCustomerId($customer->getId())
                        ->setIsDefaultShipping('1')
                        ->setSaveInAddressBook('1');

                    $customer->addAddress($address);
                }

                $dataShipping = array(
                    'firstname'  => $vCustomer->getContactFirstName(),
                    'middlename' =>$vCustomer->getContactMiddleInitial(),
                    'lastname'   => $vCustomer->getContactLastName(),
                    'street'     => array($vCustomer->getBillingAddress1(), $vCustomer->getBillingAddress2(), $vCustomer->getBillingAddress3()),
                    'city'       => $vCustomer->getBillingCity(),
//                  'region'     => $someFixedState,
                    'region_id'  => $this->helper->findRegionId($vCustomer->getBillingCountry(), $vCustomer->getBillingState()),
                    'postcode'   => $vCustomer->getBillingZipCode(),
                    'country_id' => $countryId,
                    'telephone'  => $vCustomer->getContactPhoneNumber(),
                );

                try{
                    $address
                        ->addData($dataShipping)
                        ->save();
                } catch (Exception $e) {
                    $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                }
            }
            //$this->helper->progressBar($i + 1, count($customerList));
        }

        if ($newCustomersResponse->getCustomerCount() == $this->pageSize) {
            $this->getRecursiveCustomers($page + 1);
        }
    }

    /**
     * @param $visualId
     * @return null|Mage_Customer_Model_Customer
     */
    function findCustomerByVisualId($visualId){
        $customer = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect(array('visual_customer_id'))
            ->addAttributeToFilter('visual_customer_id', array('eq' => $visualId))
            ->getFirstItem();
        return $customer->getId() == null ? null : $customer;
    }

    /**
     * @param  \Visual\CustomerService\Customer $customer
     * @return bool
     */
    function isSameShipping($customer) {
        return
            $customer->getCustomerName() == $customer->getBillingName() &&
            $customer->getBillingAddress1() == $customer->getAddress1() &&
            $customer->getBillingAddress2() == $customer->getAddress2() &&
            $customer->getBillingAddress3() == $customer->getAddress3() &&
            $customer->getBillingCity() == $customer->getCity() &&
            $customer->getBillingState() == $customer->getState() &&
            $customer->getBillingZipCode() == $customer->getZipCode() &&
            $customer->getBillingCountry() == $customer->getCountry();
    }
}
