<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/24/14
 * Time: 10:32 AM
 */

class Americaneagle_Farmbuildings_Block_Checkout_Onepage extends
	Mage_Checkout_Block_Onepage
{
	public function getSteps()
	{
        if(Mage::getStoreConfigFlag('checkout/options/allow_registered_checkout')){
            return parent::getSteps();
        }
		$steps = array();
		$stepCodes = $this->_getStepCodes();
		$stepCodes = array_diff($stepCodes, array('login'));

		if ($this->isCustomerLoggedIn()) {
			$stepCodes = array_diff($stepCodes, array('login'));
		}

		foreach ($stepCodes as $step) {
			$steps[$step] = $this->getCheckout()->getStepData($step);
		}

		return $steps;
	}

    /**
     * @return string
     */
    public function getActiveStep()
	{
        if(Mage::getStoreConfigFlag('checkout/options/allow_registered_checkout')){
            return parent::getActiveStep();
        }
        return 'billing';
	}

} 