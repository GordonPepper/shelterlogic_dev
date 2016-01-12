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
    private $count = 0;
    private $errors = array();
    private $startDate;

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
        if ($parameters) {
            $parameters = json_decode($parameters);
            if ($parameters->store_id) {
                $this->store->load($parameters->store_id);
                $this->helper->getConfig()->setStore($this->store);
            } else {
                return false;
            }
            if ($parameters->page_size) {
                $this->pageSize = (int)$parameters->page_size;
            }
            if ($parameters->skip_date_filter) {
                $this->startDate = null;
            }
        } else {
            return false;
        }
        $this->startDate = null;
        $startTime = microtime(true);

        $this->getRecursiveCustomers(0);

        if (count($this->errors) > 0) {
            return 'Items imported: ' . $this->count . ' Time:' . (microtime(true)-$startTime) . ' Errors:(' . count($this->errors) . ')' . json_encode($this->errors, JSON_PRETTY_PRINT);
        } else {
            return 'Items imported: ' . $this->count . ' Time:' . (microtime(true)-$startTime);
        }
    }


    /**
     * @param $page
     * @throws Exception
     */
    function getRecursiveCustomers($page){
        printf("\nGetting page %d\n", $page + 1);

        /** @var Visual\CustomerService\CustomerDataResponse $newCustomersResponse */
        $newCustomersResponse = $this->helper->getNewCustomers($page * $this->pageSize + 1, $this->pageSize, $this->startDate);
        $customerList = $newCustomersResponse->getCustomerList()->getCustomerListItem();

        printf("Processing %d items\n", count($customerList));

        $fail = false;

        for ($i = 0; $i < count($customerList); $i++) {
            $customerItem = $customerList[$i];
            $customer = $this->findCustomerByVisualId($customerItem->getID());
            $vCustomer = $customerItem->getCustomer();

            if ($customer == null) {
                /** @var Mage_Customer_Model_Customer $customer */
                $customer = Mage::getModel("customer/customer");
                $customer
                    ->setWebsiteId($this->store->getWebsiteId())
                    ->setStore($this->store)
                    ->setGroupId(strtolower($vCustomer->getPriceGroup())=='exclusive' ? $this->helper->getConfig()->getExclusiveGroupId() : $this->helper->getConfig()->getGeneralGroupId()) //adding it to the General or exclusive group
                    ->setFirstname($vCustomer->getContactFirstName())
                    ->setMiddlename($vCustomer->getContactMiddleInitial())
                    ->setLastname($vCustomer->getContactLastName())
                    ->setEmail($vCustomer->getContactEmail())
                    ->setPhone($vCustomer->getContactPhoneNumber())
                    ->setPassword($customer->generatePassword())
                    ->setVisualCustomerId($vCustomer->getCustomerID())
                    ->setCreditStatus($vCustomer->getCreditStatus())
                    ->setDiscountPercent($vCustomer->getDiscountPercent());

                try{
                    $customer->save();
                    $this->count++;
                }

                catch (Exception $e) {
                    $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                    $fail = true;
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
                            ->setCountryId($this->helper->findCountryId($vCustomer->getBillingCountry()))
                            ->setRegionId($this->helper->findRegionId($vCustomer->getBillingCountry(), $vCustomer->getBillingState()))
                            ->setPostcode($vCustomer->getBillingZipCode())
                            ->setCity($vCustomer->getBillingCity())
                            ->setStreet(array($vCustomer->getBillingAddress1(),
                                $vCustomer->getBillingAddress2(),
                                $vCustomer->getBillingAddress3()))
                            ->setIsDefaultBilling('1')
                            ->setIsDefaultShipping('0')
                            ->setSaveInAddressBook('1');

                        try{
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

                    try{
                        $address->save();
                    }
                    catch (Exception $e) {
                        $this->errors[] = array('ID' => $customerItem->getID(), 'Error' => $e->getMessage());
                    }
                }
            }
            $this->helper->progressBar($i + 1, count($customerList));
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
