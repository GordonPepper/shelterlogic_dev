<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 4:41 PM
 */

class Americaneagle_Visual_Model_Observer extends Mage_Core_Model_Abstract {


	public function pushOrders(Mage_Cron_Model_Schedule $observer) {
		/**
		 * Ok, so lets see what we can't do about logging
		 */

		$log = Mage::getModel('americaneagle_visual/soaplog');
		$log->setCode('foo is aardvark');
		$log->setMessage("foo is the aardvark");
		$log->setLogData("bar is malacious");
		$log->save();

		/**
		 * ok, logging seems to be mostly under control. we
		 * will want to add a new column and re-purpose the data
		 * column so we end up with "request" and "response"
		 * columns.
		 */

//		$model = Mage::getModel('americaneagle_visual/soaplog');
//		$collection = $model->getCollection();
//		foreach($collection as $log) {
//			$log->setLogData('bulk update');
//			$log->setCode('test_code2');
//			$log->setMessage('this is the message');
//			$log->save();
//		}
	}

} 