<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 3/3/15
 * Time: 2:33 PM
 */

class Americaneagle_Visual_Block_Adminhtml_Sales_Order_View_Tab_Visual
	extends Mage_Adminhtml_Block_Template
	implements Mage_Adminhtml_Block_Widget_Tab_Interface {

	protected function _prepareLayout()
	{
		$onclick = "submitAndReloadArea($('order_history_block').parentNode, '".$this->getSubmitUrl()."')";
		$button = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setData(array(
				'label'   => Mage::helper('sales')->__('Submit Comment'),
				'class'   => 'save',
				'onclick' => $onclick
			));
		$this->setChild('submit_button', $button);
		return parent::_prepareLayout();
	}

	/**
	 * Retrieve order model instance
	 *
	 * @return Mage_Sales_Model_Order
	 */
	public function getOrder()
	{
		return Mage::registry('current_order');
	}

	/**
	 * Return Tab label
	 *
	 * @return string
	 */
	public function getTabLabel() {
		return Mage::helper('sales')->__('VISUAL Status');
	}

	/**
	 * Return Tab title
	 *
	 * @return string
	 */
	public function getTabTitle() {
		return Mage::helper('sales')->__('VISUAL Status');
	}

	/**
	 * Can show tab in tabs
	 *
	 * @return boolean
	 */
	public function canShowTab() {
		return true;
	}

	/**
	 * Tab is hidden
	 *
	 * @return boolean
	 */
	public function isHidden() {
		return false;
	}

	protected function _construct() {
		parent::_construct();
		$this->setTemplate('americaneagle/vstatus.phtml');
	}
	public function getSubmitUrl()
	{
		return $this->getUrl('*/sales_visual/setStatus', array('order_id'=>$this->getOrder()->getId()));
	}

}