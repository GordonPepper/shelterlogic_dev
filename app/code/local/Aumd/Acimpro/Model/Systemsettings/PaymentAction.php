<?php
/**
 */
 
class Aumd_Acimpro_Model_Systemsettings_PaymentAction
{
	public function toOptionArray()
	{
		return array(
			array(
				'value' => Aumd_Acimpro_Model_PaymentMethod::PAYMENT_ACTION_AUTH,
				'label' => Mage::helper('acimpro')->__('Authorize')
			),
			array(
				'value' => Aumd_Acimpro_Model_PaymentMethod::PAYMENT_ACTION_AUTH_CAPTURE,
				'label' => Mage::helper('acimpro')->__('Authorize and Capture')
			)
		);
	}
}

?>

