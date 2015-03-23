<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 3/4/15
 * Time: 11:56 AM
 */

class Americaneagle_Visual_Adminhtml_Sales_VisualController
extends Mage_Adminhtml_Controller_Action {
	public function setStatusAction() {
		if ($order = $this->_initOrder()) {
			try{
				$response = false;

				$flag = $this->getRequest()->getParam('flag');
				$order->setAeSentToVisual($flag);
				$order->save();

				$this->loadLayout('empty');
				$this->renderLayout();
			} catch (Exception $e) {
				$response = array(
					'error' => true,
					'message' => $e->getMessage()
				);
			}
			if(is_array($response)) {
				$this->getResponse()->setBody(json_encode($response));
			}
		}
	}
	protected function _initOrder()
	{
		$id = $this->getRequest()->getParam('order_id');
		$order = Mage::getModel('sales/order')->load($id);

		if (!$order->getId()) {
			$this->setFlag('', self::FLAG_NO_DISPATCH, true);
			return false;
		}
		Mage::register('current_order', $order);
		return $order;
	}

}