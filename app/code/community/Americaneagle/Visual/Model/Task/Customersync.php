<?php

/**
 * Customer Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-11-9
 */

class Americaneagle_Visual_Model_Task_Customersync
{

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    /** @var  Americaneagle_Visual_Helper_Visual vhelper */
    private $vhelper;


    /**
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return $this|bool|string
     * @throws Exception
     */
    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        if(Mage::helper('americaneagle_visual')->getEnabled() == 0) {
            return $this;
        }
        $this->vhelper = Mage::helper('americaneagle_visual/visual');

        $parameters = $schedule->getParameters();
        $websiteId = 0;
        $store = Mage::getModel('core/store');
        if ($parameters) {
            $parameters = json_decode($parameters);
            $websiteId = $parameters->website_id;
            $store->load($parameters->store_id);
        } else {
            return false;
        }


        /*$customerId = Mage::getStoreConfig('aevisual/general/customer_id');

        $resp = $this->vhelper->getVisualCustomerById($customerId);
        if(empty($resp))
            return;*/ // helper logs exception

        /*$customerCollection = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect(array('visual_customer_id'))
            ->addAttributeToFilter('website_id', array('eq' => $parameters->website_id));


        if($customerCollection->count() == 0){
            echo 'AE Visual: No customers to push';
            return;
        } else {
            echo $customerCollection->count();
        }

        foreach($customerCollection as $customer) {
            $visualId = $customer->getVisualCustomerId();
            print_r($visualId);
        }*/


        $count = 0;

        $letters = range('A', 'Z');

        $startTime = microtime(true);

        /*foreach ($letters as $one) {
            foreach ($letters as $two) {
                $timePre = microtime(true);
                $newCustomers = $this->vhelper->getNewCustomers("{$one}{$two}");
                echo "Q:".$one.$two." Qty:".count($newCustomers)." T:".(microtime(true) - $timePre)."\n";
                $count += count($newCustomers);
            }
        }*/

        $newCustomers = $this->vhelper->getNewCustomers("FRED M");

        foreach($newCustomers as $cust){
            $customer = $this->findCustomerByVisualId($cust->getCustomerID());

            if ($customer == null) {
                $customer = Mage::getModel("customer/customer");
                $customer
                    ->setWebsiteId($websiteId)
                    ->setStore($store)
                    ->setGroupId(1) //adding it to the General group
                    ->setFirstname($cust->getContactFirstName())
                    ->setMiddlename($cust->getContactMiddleInitial())
                    ->setLastname($cust->getContactLastName())
                    ->setEmail($cust->getContactEmail())
                    ->setPassword($customer->generatePassword())
                    ->setVisualCustomerId($cust->getCustomerID());

                try{
                    $customer->save();
                    $count++;
                }

                catch (Exception $e) {
                    return $e->getMessage();
                }

                if (!$this->isSameShipping($cust)) {
                    $address = Mage::getModel("customer/address")
                        ->setCustomerId($customer->getId())
                        ->setFirstname(strstr($cust->getBillingName(), ' ', true))
                        ->setLastname(substr(strstr($cust->getBillingName(), ' '), 1))
                        ->setCountryId($this->findCountryId($cust->getBillingCountry()))
                        ->setRegionId($this->findRegionId($cust->getBillingCountry(), $cust->getBillingState()))
                        ->setPostcode($cust->getBillingZipCode())
                        ->setCity($cust->getBillingCity())
                        ->setTelephone($cust->getContactPhoneNumber())
                        ->setFax($cust->getContactFaxNumber())
                        ->setStreet(array($cust->getBillingAddress1(),
                            $cust->getBillingAddress2(),
                            $cust->getBillingAddress3()))
                        ->setIsDefaultBilling('1')
                        ->setIsDefaultShipping('0')
                        ->setSaveInAddressBook('1');

                    try{
                        $address->save();
                    }
                    catch (Exception $e) {
                        return $e->getMessage();
                    }
                }

                $address = Mage::getModel("customer/address")
                    ->setCustomerId($customer->getId())
                    ->setFirstname($cust->getContactFirstName())
                    ->setLastname($cust->getContactLastName())
                    ->setCountryId($this->findCountryId($cust->getCountry()))
                    ->setRegionId($this->findRegionId($cust->getCountry(), $cust->getState()))
                    ->setPostcode($cust->getZipCode())
                    ->setCity($cust->getCity())
                    ->setTelephone($cust->getContactPhoneNumber())
                    ->setFax($cust->getContactFaxNumber())
                    ->setStreet(array($cust->getAddress1(),
                            $cust->getAddress2(),
                            $cust->getAddress3()))
                    ->setIsDefaultBilling($this->isSameShipping($cust)?'1':'0')
                    ->setIsDefaultShipping('1')
                    ->setSaveInAddressBook('1');

                try{
                    $address->save();
                }
                catch (Exception $e) {
                    return $e->getMessage();
                }
            }

        }

        return 'Items imported: ' . $count . ' Time:'.(microtime(true)-$startTime);
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
     * @param $countryCode
     * @return mixed
     */
    function findCountryId($countryCode){
        if (!Mage::registry($countryCode)) {
            $country = Mage::getModel('directory/country')
                ->getCollection()
                ->addCountryCodeFilter($countryCode)
                ->getFirstItem();
            Mage::register($countryCode, $country->getId());
        }

        return Mage::registry($countryCode);
    }


    /**
     * @param $countryCode
     * @param $regionCode
     * @return mixed
     */
    function findRegionId($countryCode, $regionCode){
        if (!Mage::registry("{$countryCode}_{$regionCode}")) {
            $region = Mage::getModel('directory/region')
                ->getCollection()
                ->addCountryCodeFilter($countryCode)
                ->addRegionCodeFilter($regionCode)
                ->getFirstItem();
            Mage::register("{$countryCode}_{$regionCode}", $region->getId());
        }

        return Mage::registry("{$countryCode}_{$regionCode}");
    }

    /**
     * @param  \Visual\CustomerService\Customer $customer
     * @return bool
     */
    function isSameShipping($customer) {
        return
            $customer->getBillingAddress1() == null ||
            ($customer->getCustomerName() == $customer->getBillingName() &&
            $customer->getBillingAddress1() == $customer->getAddress1() &&
            $customer->getBillingAddress2() == $customer->getAddress2() &&
            $customer->getBillingAddress3() == $customer->getAddress3() &&
            $customer->getBillingCity() == $customer->getCity() &&
            $customer->getBillingState() == $customer->getState() &&
            $customer->getBillingZipCode() == $customer->getZipCode() &&
            $customer->getBillingCountry() == $customer->getCountry());
    }
}
