<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/30/14
 * Time: 4:28 PM
 */

// Change current directory to the directory of current script
chdir(dirname(__FILE__));

require 'app/Mage.php';

if (!Mage::isInstalled()) {
	echo "Application is not installed yet, please complete install wizard first.";
	exit;
}


$app = Mage::app('admin');
$app->setUseSessionInUrl(false);

umask(0);

$collection = Mage::getModel('sales/order')->getCollection();

foreach($collection as $order) {
	echo sprintf("found order number %s\n", $order->getId());
	try {
		$order->delete();
		echo sprintf("order deleted\n");
	} catch (Exception $e) {
		echo sprintf("failed to delete order: %s\n", $e->getMessage());
	}
}