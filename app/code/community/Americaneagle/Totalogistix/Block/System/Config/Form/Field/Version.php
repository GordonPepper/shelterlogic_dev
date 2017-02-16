<?php

class Americaneagle_Totalogistix_Block_System_Config_Form_Field_Version
	extends Mage_Adminhtml_Block_System_Config_Form_Field
{

	public function getElementHtml() {

		$modules = Mage::getConfig()->getNode('modules')->children();
		$info = $modules->Americaneagle_Totalogistix->asArray();

		return isset($info['version']) ? $info['version'] : '';
	}
	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
		return $this->getElementHtml();
	}
}
