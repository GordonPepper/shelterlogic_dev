<?php
/**
 * Created by PhpStorm.
 * User: astayart
 * Date: 4/2/14
 * Time: 2:17 PM
 */

header("Content-Type: text/html");
ini_set('display_errors', true);
//error_reporting(E_ALL | E_STRICT);


require 'app/Mage.php';
//Mage::setIsDeveloperMode(true);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
/** @var Mage $app */
$app = Mage::app();

class databaseTester extends Mage_Core_Model_Resource {
	public function __construct() {
	}

	public function getDesignConnection($config) {
		return $this->_newConnection('pdo_mysql', $config);
	}
}

$factory = new databaseTester();

$f = $app->getRequest()->getParam('f');

$allowedFunctions = array(
    'changeChildVis',
    'filterExport',
    'findEmptyCategories',
    'prepImageImport',
    'findDuplicateSku',
    'warehouseDistance',
    'categoryImages',
	'fillUrlKey',
	'processImport',
	'toggleBaseUrl',
	'configCompare',
	'decryptACIMConfig',
	'quickTest',
	'extendwareDecrypt',
	'countryRegion',
	'totaLogistixSampleCall',
	'fb_getItemList',
	'getNextConfig',
	'tarCheck',
	'wfKeyGen',
	'trimImportFile',
	'cleanImportFile',
	'getProductAttributes',
	'reviewSimpleImport',
	'productList',
	'getConfigurableAttributes',
	'updateProductImages',
	'mailTest',
	'triggerJob',
	'inspectSysconfig',
	'adminDump',
	'visualTesting',
	'getOrdersWithFlag',
	'getCimValuesDecrypt'
);

$html = new HtmlOutputter();

$html->startHtml()->startHead("M-TEST")->startBody();
$html->para('<a href="/shop/mtest.php">home</a>');

if (isset($f) && in_array($f, $allowedFunctions)) {
	try {
		$html->para("executing function: " . $f);
		call_user_func($f);
		$html->endBody()->endHtml();
	} catch (Exception $e) {
		$html->para("failed to run function $f");
		$html->para($e->getMessage());
		$html->pre($e->getTraceAsString());
	}
} else {
	$html->para("mtest php is designed to take an arg 'f' and execute a designated function");
	$html->para("allowed functions:");
	showAllowedFunctions($html);
	$html->endBody()->endHtml();
	exit;
}

function changeChildVis(){
    global $html;
    $products = Mage::getModel('catalog/product')
        ->getCollection()
        ->addAttributeToSelect('*')
        ->addAttributeToFilter('type_id', 'configurable');

    foreach ($products as $product) {
        $html->para(sprintf("found product: %s", $product->getName()));

        $children = Mage::getModel('catalog/product_type_configurable')->setProduct($product)->getUsedProductCollection();
        foreach ($children as $child) {
            $child->setVisibility('3');
            $child->save();
        }
    }
}

function findEmptyCategories() {
    global $html;
    /** @var Mage_Catalog_Model_Resource_Category_Collection $categories */
    $categories = Mage::getModel('catalog/category')->getCollection();

    $categories->addAttributeToSelect('*');
    $categories->addFieldToFilter('children_count', array('eq' => '0'));
    $number = $categories->count();
    $delete = array();

    foreach ($categories as $category) {
        $name = $category->getName();
        //$html->para(sprintf('found category: %s', $name));

        /** @var Mage_Catalog_Model_Resource_Product_Collection $pc */
        $pc = $category->getProductCollection();
        $pc->addAttributeToSelect('*');
        $count = $pc->count();
        if($count == 0) {
            $html->para(sprintf('category %s (%d) has %d products, marking for deletion', $name, $category->getId(), $count));
            $delete[] = $category->getId();
        }
    }
    $html->para(sprintf('i have found %d categories to delete', count($delete)));
    foreach ($delete as $id) {
        $html->para(sprintf('going to delete category id %d', $id));
        Mage::getModel('catalog/category')->load($id)->delete();
        $html->para(sprintf('deleted category id: %d', $id));
    }

}

function warehouseDistance(){
    global $html;
    $helper = Mage::helper('americaneagle_totalogistix');
    //$list = $helper->getDistanceOrderedWarehouses('94116');
}

function fillUrlKey() {
	global $html;
	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')->getCollection();
    //$collection->addWebsiteFilter(0);
	$collection->addAttributeToFilter('url_key', array('null' => true), 'left');
	$collection->addAttributeToSelect('name');
	//$collection->setPageSize(200);
	$found = 0;
    /** @var Mage_Catalog_Model_Product $product */
    foreach ($collection as $product) {
		//$html->para(sprintf('product without urlkey: %d, named: %s', $product->getId(), $product->getName()));
        //$html->para(sprintf('i am a %s', get_class($product)));
        $product->setDataChanges(true);
        $product->save();
		$found++;
	}

	$html->para(sprintf('i changed %d items with no url key', $found));
}

function categoryImages() {
    global $html;


    $collection = Mage::getModel('catalog/category')->getCollection();
    /** @var Mage_Catalog_Model_Category $current_category */

    $collection->addAttributeToSelect('image')
        ->addAttributeToSelect('name')
        ->addAttributeToFilter('is_active', 1)
        ->addIdFilter(25);

    $sid = Mage::app()->getStore()->getId();
    $html->para('store id is ' . $sid);
    foreach($collection as $cat) {
        $html->para(sprintf('found catid %d, name: %s with image %s', $cat->getId(), $cat->getName(), $cat->getImage()));
    }

}

function findDuplicateSku(){
    global $html;
    $file = new CsvReader('/media/sf_Magento/SL_Product Data_6.csv',',', true);
    $skus = array();
    while($file->nextRow()) {
        if(isset($skus[$file->item('SKU')]) ) {
            $skus[$file->item('SKU')]++;
        } else {
            $skus[$file->item("SKU")] = 1;
        }
    }
    $file->close();
    foreach ($skus as $sku => $count) {
        if($count > 1){
            $html->para(sprintf('found duplicate sku: %s', $sku));
        }

    }
}

function toggleBaseUrl() {
	global $html, $app;

	$newbase = $app->getRequest()->getParam('tobase');
	if (!empty($newbase)) {
		$current = base64_decode($newbase);
		Mage::getConfig()->saveConfig(
			'web/unsecure/base_url', $current
		);
		Mage::getConfig()->saveConfig(
			'web/secure/base_url', $current
		);

	} else {
		$current = Mage::getStoreConfig('web/unsecure/base_url');
	}

	$sites = array();
	$sites['design'] = 'http://farmbuildings-design.idevdesign.net/';
	$sites['updates'] = 'http://farmbuildings-updates.idevdesign.net/';
	$sites['local'] = 'http://farmbuildings.com.local/';

	$html->para(sprintf('unsecure base_url currently set to %s', $current));

	foreach ($sites as $key => $value) {
		if ($current != $value) {
			$parms = $app->getRequest()->getParams();
			$parms['tobase'] = base64_encode($value);
			$html->para(sprintf('Change to <a href="%s">%s</a>', implode('?', array($app->getRequest()->getBaseUrl(), http_build_query($parms))), $key));
			$app->getRequest()->getRequestUri();
		}
	}


}

function decryptACIMConfig() {
	global $html;
	$apikey = (string)Mage::getStoreConfig('payment/acimpro/api_key');
	$transkey = (string)Mage::getStoreConfig('payment/acimpro/transaction_key');
	$html->para(sprintf('got  api key: %s', $apikey));
	$html->para(sprintf('got  trans key: %s', $transkey));
}

function configCompare() {
	global $html, $factory;

	$dbDesign = $factory->getDesignConnection(array(
		'host' => 'cl-mgnto-4vap02',
		'username' => 'farm-ent',
		'password' => 'DB2#JBk%',
		'dbname' => 'farmbuildings',
		'initStatements' => 'SET NAMES utf8',
		'model' => 'mysql4'
	));

	$sth = $dbDesign->query("select CONCAT(scope_id, '_', path) AS jpath, value
from core_config_data
where path not like 'ewcore_licensing%' and path not like 'advanced/modules_disable_output%'
order by path, scope_id");
	$sth->execute();
	$drows = $sth->fetchAll();

	$dbUpdate = $factory->getDesignConnection(array(
		'host' => 'cl-mgnto-4vap02',
		'username' => 'farmb-iis-121',
		'password' => 'hj#4f1uywe',
		'dbname' => 'farmbuildings_updates',
		'initStatements' => 'SET NAMES utf8',
		'model' => 'mysql4'
	));

	$sth = $dbUpdate->query("select CONCAT(scope_id, '_', path) AS jpath, value
from core_config_data
where path not like 'ewcore_licensing%' and path not like 'advanced/modules_disable_output%'
order by path, scope");
	$sth->execute();
	$urows = $sth->fetchAll();

	/* merge alg yet again... design on the left, updates on the right */
	$left = 0;
	$right = 0;
	$cfg = array();
	while ($left < count($drows) && $right < count($urows)) {
		$cmp = strcmp($drows[$left]['jpath'], $urows[$right]['jpath']);
		if ($drows[$left]['jpath'] == 'web/default/cms_home_page' || $urows[$right]['jpath'] == 'web/default/cms_no_cookies') {
			$debug = 1;
		}

		if ($cmp < 0) {
			// so this means on design not updates
//			$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//			$dfg[$drows[$left]['path']]['updates'] = '__NOT_SET__';
			$cfg[] = array(
				'path' => $drows[$left]['jpath'],
				'dpath' => $drows[$left]['jpath'],
				'upath' => $urows[$right]['jpath'],
				'dvalue' => $drows[$left]['value'],
				'uvalue' => $urows[$right]['value']
			);
			//$html->para(sprintf('config item %s on design, not updates. value: "%s"', $drows[$left]['path'], substr($drows[$left]['value'], 0, 45)));
			$left++;
		} elseif ($cmp > 0) {
//			$dfg[$urows[$right]['path']]['design'] = '__NOT_SET__';
//			$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
			$cfg[] = array(
				'path' => $urows[$right]['jpath'],
				'dpath' => $drows[$left]['jpath'],
				'upath' => $urows[$right]['jpath'],
				'dvalue' => $drows[$left]['value'],
				'uvalue' => $urows[$right]['value']
			);

			//$html->para(sprintf('config item %s on updates, not design. value:" %s"', $urows[$right]['path'], substr($urows[$right]['value'], 0, 45)));
			$right++;
		} else {
			// same, so compare values
			$vcmp = strcmp($drows[$left]['value'], $urows[$right]['value']);
			if ($vcmp != 0) {
//				$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//				$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
				$cfg[] = array(
					'path' => $urows[$right]['jpath'],
					'dpath' => $drows[$left]['jpath'],
					'upath' => $urows[$right]['jpath'],
					'dvalue' => $drows[$left]['value'],
					'uvalue' => $urows[$right]['value']
				);
			}
			$left++;
			$right++;
		}
	}

	//finally we close out the remaining side:
	while ($left < count($drows)) {
		// only drows remain
//		$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//		$dfg[$drows[$left]['path']]['updates'] = '__NOT_SET__';
		$cfg[] = array(
			'path' => $drows[$left]['jpath'],
			'dpath' => $drows[$left]['jpath'],
			'upath' => $urows[$right]['jpath'],
			'dvalue' => $drows[$left]['value'],
			'uvalue' => $urows[$right]['value']
		);
		$left++;
	}
	while ($right < count($urows)) {
		// only urows remain
//		$dfg[$urows[$right]['path']]['design'] = '__NOT_SET__';
//		$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
		$cfg[] = array(
			'path' => $urows[$right]['jpath'],
			'dpath' => $drows[$left]['jpath'],
			'upath' => $urows[$right]['jpath'],
			'dvalue' => $drows[$left]['value'],
			'uvalue' => $urows[$right]['value']
		);
		$right++;
	}

	// now for a table of diffs:
	$html->startTable(array('path', 'dpath', 'upath', 'dvalue', 'uvalue'));
	foreach ($cfg as $vals) {
		$html->tableRow($vals);
	}
	$html->endTable();

}

function    quickTest() {
	global $html;
	$html->para('generic stub, put whatever you like here.');

	$helper = Mage::helper('americaneagle_visual');
	$options = array();
	$options['trace'] = 1;
	$options['soap_version'] = SOAP_1_2;
	try {
		$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);

	} catch (Exception $e) {
		$html->para('got exception');
	}

}


function countryRegion() {
	global $html;
	/** @var Mage_Directory_Helper_Data $dhelper */
	$dhelper = Mage::helper('directory');
	$storeId = Mage::app()->getWebsite()->getDefaultGroup()->getDefaultStoreId();
	/** @var Mage_Directory_Model_Resource_Country_Collection $coll */
	$coll = $dhelper->getCountryCollection();
	$html->para('got coll: its a ' . get_class($coll));
	$coll->loadByStore($storeId);
	$html->para('found  country, its a ' . get_class($coll->getFirstItem()));

	/** @var Mage_Directory_Model_Country $country */
	$country = $coll->getFirstItem();
	$locale = Mage::app()->getLocale()->getLocaleCode();
	$html->para('using locale: ' . $locale);
}

function getCimValuesDecrypt() {
	global $html;
	$encrypted = Mage::getStoreConfig('payment/acimpro/api_key');
	$decrypted = Mage::helper('core')->decrypt($encrypted);
	$html->para(sprintf('encrypted value: %s, decrypted value: %s', $encrypted, $decrypted));
	$encrypted = Mage::getStoreConfig('payment/acimpro/transaction_key');
	$decrypted = Mage::helper('core')->decrypt($encrypted);
	$html->para(sprintf('encrypted value: %s, decrypted value: %s', $encrypted, $decrypted));
}

function visualTesting() {
	global $html;
	/** @var Americaneagle_Visual_Helper_Data $helper */
	$helper = Mage::helper('americaneagle_visual');

	$options = array();
	if ($helper->getSoaplogEnable()) {
		$options['trace'] = 1;
	}
	$options['soap_version'] = SOAP_1_2;

//	$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
//	$html->startList();
//	foreach($client->__getFunctions() as $func) {
//		preg_match('/^(.*?)\s+(.*?)\((.*?)\)$/',$func, $m);
//		$html->listItem("{$m[1]} <b>{$m[2]}</b> ( {$m[3]} )");
//	}
//	$html->endList();
//
//	return;

	$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
	$header = new SoapHeader('http://tempuri.org/', 'Header', array(
		'Key' => $helper->getServiceKey()));
	$client->__setSoapHeaders($header);
	try {
		$res = $client->SearchCustomer(
			array(
				'data' => array(
					'Customers' => array(
						'Customer' => array(
							'CustomerID' => '1234')
					)
				)
			)
		);

	} catch (Exception $e) {
		$html->para('got exception: ' . $e->getMessage());
	}
	$html->para('the request was: ');
	$xml = new DOMDocument();
	$xml->loadXML($client->__getLastRequest());
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;

	$html->pre(print_r(htmlentities($xml->saveXML()), true));

	$html->para('the response was');
	$r = new DOMDocument();
	$r->preserveWhiteSpace = false;
	$r->formatOutput = true;
	$r->loadXML($client->__getLastResponse());
	$html->pre(htmlentities($r->saveXML()));
}

function getOrdersWithFlag() {
	global $html;
	$collection = Mage::getModel('sales/order')->getCollection();
	$collection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));
	$html->para(sprintf('found %d orders', $collection->count()));

	foreach ($collection as $order) {
		//$html->para(sprintf('order is a %s', get_class($order)));
		/** @var Mage_Sales_Model_Order_Address $address */
		$address = $order->getShippingAddress();
		$html->pre(sprintf("name: %s\n addr1: %s\n addr2: %s\ncity: %s State: %s Zip: %s country: %s",
			$address->getName(),
			$address->getStreet1(),
			$address->getStreet2(),
			$address->getCity(),
			$address->getRegionCode(),
			$address->getPostcode(),
			$address->getCountry()
		));
		//$html->para(sprintf('address is a %s', get_class($address)));
	}

}

function adminDump() {
	global $html;
	$config = Mage::getConfig()->loadModulesConfiguration('adminhtml.xml')->getNode();
	$html->para(sprintf('got a config, and it is a  %s', get_class($config)));

}

function inspectSysconfig() {
	global $html;
	$config = Mage::getConfig()->loadModulesConfiguration('system.xml')->getNode();
	$doc = new DOMDocument();
	$doc->loadXML($config->asXML());
	$xpath = new DOMXPath($doc);

	$frontend_types = array();
	$nl = $xpath->query('/config/sections/*/groups/*/fields/*/frontend_type/text()');
	foreach ($nl as $n) {
		$frontend_types[$n->nodeValue] = $n->nodeValue;
	}
	foreach ($frontend_types as $t) {
		$html->para('got type: ' . $t);
	}
}

function triggerJob() {
	global $html;
	$jobCode = 'americaneagle_visual';

	/**
	 * so we are going to emulate the _processJob() function
	 * to just run our job on demand, by job_code. to do this
	 * we need to create a schedule item and a jobConfig,
	 * then we can run the parts of Mage_Core_Model_Observer::_processJob()
	 * as needed.
	 */

	$schedule = Mage::getModel('cron/schedule');
	$schedule->setJobCode($jobCode);
	$jobsRoot = Mage::getConfig()->getNode('crontab/jobs');
	$defaultJobsRoot = Mage::getConfig()->getNode('default/crontab/jobs');

	$jobConfig = $jobsRoot->{$schedule->getJobCode()};
	if (!$jobConfig || !$jobConfig->run) {
		$jobConfig = $defaultJobsRoot->{$schedule->getJobCode()};
		if (!$jobConfig || !$jobConfig->run) {
			$html->para('the jobConfig or jobConfig->run does not exist, exiting');
			return;
		}
	}

	// _processJob($schedule, $jobConfig):
	$runConfig = $jobConfig->run;
	$html->para(sprintf('the run config is %s', print_r($jobConfig, true)));

	$errorStatus = Mage_Cron_Model_Schedule::STATUS_ERROR;
	try {
		if ($runConfig->model) {
			if (!preg_match(Mage_Cron_Model_Observer::REGEX_RUN_MODEL, (string)$runConfig->model, $run)) {
				Mage::throwException(Mage::helper('cron')->__('Invalid model/method definition, expecting "model/class::method".'));
			}
			if (!($model = Mage::getModel($run[1])) || !method_exists($model, $run[2])) {
				Mage::throwException(Mage::helper('cron')->__('Invalid callback: %s::%s does not exist', $run[1], $run[2]));
			}
			$callback = array($model, $run[2]);
			$html->para('callback array is: ');
			$html->pre(print_r($callback, true));
			$arguments = array($schedule);
			$html->para('arguments array is:');
			$html->pre(print_r($arguments, true));
		}
		if (empty($callback)) {
			Mage::throwException(Mage::helper('cron')->__('No callbacks found'));
		}

		$schedule
			->setExecutedAt(strftime('%Y-%m-%d %H:%M:%S', time()))
			->save();
		$html->para('calling func');
		call_user_func_array($callback, $arguments);
		$html->para('called func');
		$schedule
			->setStatus(Mage_Cron_Model_Schedule::STATUS_SUCCESS)
			->setFinishedAt(strftime('%Y-%m-%d %H:%M:%S', time()));

	} catch (Exception $e) {
		$schedule->setStatus($errorStatus)
			->setMessages($e->__toString());
	}

	$schedule->save();
	$html->para('schedule saved');
}

function mailTest() {
	global $html;

	$mail = new Zend_Mail('utf-8');
	$mail->setBodyText('This is a test');
	$mail->setFrom('astayart@gmail.com', 'andy stayart');
	$mail->addTo('astayart@gmail.com', 'Andrew Stayart');
	$mail->setSubject('this is a test subject');
	$mail->send();
}

function updateProductImages() {
	global $html;
	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')->getCollection();

	$collection->addAttributeToSelect(array('style', 'width', 'height'));
	$collection->addAttributeToFilter('type_id', 'simple');
	$collection->addAttributeToFilter('attribute_set_id', '10');
	//$collection->getSelect()->limit(1);

	$html->para('got item count: ' . $collection->count());
	$sid = Mage::app()
		->getWebsite()
		->getDefaultGroup()
		->getDefaultStoreId();
	foreach ($collection as $p) {
		$style = $p->getResource()->getAttribute('style')->getFrontend()->getValue($p);
		$width = $p->getResource()->getAttribute('width')->getFrontend()->getValue($p);
		$height = $p->getResource()->getAttribute('height')->getFrontend()->getValue($p);
		$smap = array(
			'Round' => 'RD',
			'Peak' => 'PK',
			'Barn' => 'BN'
		);
		$pmap = array(
			'RD' => 'R',
			'PK' => 'P',
			'BN' => 'B'
		);
		$style = $smap[$style];
		$importDir = Mage::getBaseDir('media') . DS . 'import';
		$filepath = sprintf("%s/%s/%s_%sx%s.png", $importDir, $style, $pmap[$style], $width, $height);
		$html->para(sprintf("going to update sku: %s, filepath: %s", $p->getSku(), $filepath));

		if (file_exists($filepath)) {
			try {
				$p->addImageToMediaGallery($filepath, 'thumbnail', false);
				$p->addImageToMediaGallery($filepath, 'image', false);
				$p->addImageToMediaGallery($filepath, 'small_image', false);
				$p->setUrlKey(false);
				$p->save();
			} catch (Exception $e) {
				$html->para('fatal exception: ' . $e->getMessage());
			}
		}

	}
	return;

	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->getItems();
	/** @var Mage_Catalog_Model_Product $firstItem */
	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

	foreach ($firstItem->getAttributes() as $att) {
		if ($att->getIsConfigurable() == 1)
			$html->para('found config attribute: ' . $att->getName());
	}

}

function getConfigurableAttributes($product = null) {
	global $html;
	//Mage::log('returning from ' . __METHOD__);
	/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $collection */
	$collection = Mage::getResourceModel('catalog/product_type_configurable_attribute_collection');

	/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
	$conn = $collection->getConnection();

	/** @var Varien_Db_Select $select */
	$select = $conn->select();

	$select->from(array('super_attribute' => $conn->getTableName('catalog_product_super_attribute')), '*')
		->where('super_attribute.product_id = ?', $product->getId())
		->order('position');

	$res = $conn->fetchAll($select);

	foreach ($res as $row) {
		$html->para('got row: ' . print_r($row, true));
		/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
		$att = Mage::getModel('catalog/product_type_configurable_attribute');
		$att->setData($row);
		$collection->addItem($att);
	}


	//$collection->addItem(new ());

	/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
	$att = Mage::getModel('catalog/product_type_configurable_attribute');

	//return;
	Varien_Profiler::start('CONFIGURABLE:' . __METHOD__);
	if (!$this->getProduct($product)->hasData($this->_configurableAttributes)) {
		$configurableAttributes = $this->getConfigurableAttributeCollection($product)
			->orderByPosition()
			->load();
		$this->getProduct($product)->setData($this->_configurableAttributes, $configurableAttributes);
	}
	Varien_Profiler::stop('CONFIGURABLE:' . __METHOD__);
	return $this->getProduct($product)->getData($this->_configurableAttributes);
}

function wfKeyGen() {
	global $html;

	$domain = getDomain($_SERVER['SERVER_NAME']);
	$key = "wf" . substr(sha1('WF1DM' . $domain), 0, 20);
	$html->para("key: " . $key);
}

function getDomain($url) {
	$url = str_replace(array('http://', 'https://', '/'), '', $url);
	$tmp = explode('.', $url);
	$cnt = count($tmp);

	$suffix = $tmp[$cnt - 2] . '.' . $tmp[$cnt - 1];

	$exceptions = array(
		'com.au', 'com.br', 'com.bz', 'com.ve', 'com.gp',
		'com.ge', 'com.eg', 'com.es', 'com.ye', 'com.kz',
		'com.cm', 'net.cm', 'com.cy', 'com.co', 'com.km',
		'com.lv', 'com.my', 'com.mt', 'com.pl', 'com.ro',
		'com.sa', 'com.sg', 'com.tr', 'com.ua', 'com.hr',
		'com.ee', 'ltd.uk', 'me.uk', 'net.uk', 'org.uk',
		'plc.uk', 'co.uk', 'co.nz', 'co.za', 'co.il',
		'co.jp', 'ne.jp', 'net.au', 'com.ar'
	);

	if (in_array($suffix, $exceptions))
		return $tmp[$cnt - 3] . '.' . $tmp[$cnt - 2] . '.' . $tmp[$cnt - 1];

	return $suffix;
}

function tarCheck() {
	global $html;

	$lines = file('/home/magentouser/Web/tar.out');
	$dirs = array();
	foreach ($lines as $line) {
		$parts = explode('/', rtrim($line));
		if (count($parts) > 1 && !isset($dirs[$parts[1]]) && !empty($parts[1]))
			$dirs[$parts[1]] = array();
		if (count($parts) > 2 && !isset($dirs[$parts[1]][$parts[2]]) && !empty($parts[2]))
			$dirs[$parts[1]][$parts[2]] = array();
		if (count($parts) > 3 && !isset($dirs[$parts[1]][$parts[2]][$parts[3]]) && !empty($parts[3]))
			$dirs[$parts[1]][$parts[2]][$parts[3]] = 1;
	}

	$html->para('tar strucutre parsed');
	$html->pre(print_r($dirs, true));
}

function getNextConfig() {
	global $html;
	$html->para('peak selected, getting materials');

	/** @var Mage_Catalog_Model_Product $product */
	$product = Mage::getModel('catalog/product')->load("1");
	$html->para('product is a: ' . get_class($product));
	/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $attributes */
	$attributes = $product->getTypeInstance(true)->getConfigurableAttributes($product);
	$html->para('attributes array: ' . count($attributes));

	/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
//	foreach($attributes as $att) {
//		//$html->para('first attribute is a: ' . get_class($att));
//
//		$html->para('Attribute: ' . $att->getLabel(). ', options: ');
//		$html->startList();
//		foreach($att->getPrices() as $value) {
//			$html->listItem(sprintf("Label: %s, Index: %s", $value['label'], $value['value_index']));
//		}
//		$html->endList();
//	}

	$coll = Mage::getModel('catalog/product')->getCollection();
	$html->para(sprintf("found %d products", count($coll)));

	/* ok, now suppose that we need to know what fabric material options are avaliable
	 * for peak roof barns. */
//	$preconfig = $product->getPreconfiguredValues();
//	$html->para('preconfig: ' . print_r($preconfig, true));
}

function xmlTesting() {
	global $html;
	$html->para("getting xml");
	$config = Mage::app()->getConfig()->getNode();
	$html->para("dumping to file");
	file_put_contents("/tmp/config.xml", $config->asXML());
}

function totaLogistixSampleCall() {
	global $html;
	// start with the sample call:
	$client = new Zend_Http_Client();

	$html->para('starting...');
	$items = tl_getItemList();

	$html->para('sending items:');
	$html->pre(htmlentities($items));

	$client->setUri("https://www.mytlx.com/services/TLXShelterLogicLTLRates.aspx");
	$client->setParameterGet('szip', '06795');
	$client->setParameterGet('czip', '01535');
	$client->setParameterGet('date', '05/03/2015');
	$client->setParameterGet('service', 'LFT,NFY');
	$client->setParameterGet('AccessID', 'BE8DB0A8-90C5-4DAD-8476-008941B7382F');
	$client->setParameterGet('items', $items);

	$response = $client->request();
	$xml = $response->getBody();
	$html->pre(htmlentities($xml));

	$ele = simplexml_load_string($xml);
	$status = $ele->xpath('/Response/Status');
	if ($status === false) {
		Mage::logException("Failed to load response");
	}
	$html->para('Result: ' . $status[0]->__toString());

	$prices = $ele->xpath('/Response/PriceSheet');
	if ($prices === false) {
		Mage::logException("Failed to load shipping price sheets");
	}
	$html->startList();
	foreach ($prices as $price) {
		echo '<li>';
		$html->startList();
		foreach ($price->children() as $child) {
			$html->listItem("{$child->getName()}: {$child->__toString()}");
		}
		$html->endList();
		echo '</li>';
	}
	$html->endList();

}

function tl_getItemList() {
	$items = array(
		array('class' => '70', 'weight' => '640'),
		array('class' => '70', 'weight' => '140')
	);
	$xml = "<Items>";
	foreach ($items as $item) {
		$xml .= "<Item><Class>{$item['class']}</Class><Weight>{$item['weight']}</Weight></Item>";
	}
	return $xml . '</Items>';
}

function cacheTest() {
	global $html;
	global $app;
	/** @var Zend_Cache_Core $cache */
	$cache = $app->getCache();
	$cache->setOption('automatic_serialization', true);
	$cid = 'myTestCacheKey';
	$add = $app->getRequest()->getParam("add");
	if (isset($add)) {
		$cache->save($add, $cid);
	}

	$obj = $app->getRequest()->getParam("object");
	if (isset($obj)) {
		$obj = new TestObject('onomatopoeia');
		$cache->save($obj, 'myTestCacheObject');
	}


	$data = $cache->load($cid);
	if ($data !== false) {
		$html->para('found data: ' . $data);
	} else {
		$html->para('no cache data set');
	}
	unset($data);
	$data = $cache->load('myTestCacheObject');
	if ($data !== false) {
		$html->pre('found object cache: ' . print_r($data, true));
	} else {
		$html->para('object cache not set');
	}

	$uri = $app->getRequest()->getRequestUri();
	$html->para('<a href="' . $uri . '&add=onomatopoeia' . '">add "onomatopoeia" to cache</a>');
	$html->para('<a href="' . $uri . '&object=true' . '">add object to cache</a>');

}

function checkTableExists() {
	global $html;
	/** @var Varien_Db_Adapter_Pdo_Mysql $exists */
	$exists = Mage::getSingleton('core/resource')->getConnection('core_write');

	if ($exists->isTableExists('catalog_product_entity_url_key')) {
		$html->para('getting true');
	} else {
		$html->para('getting false');
	}
}

function productList() {
	global $html;
	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')->getCollection();

//	/** @var Mage_Catalog_Model_Product_Status $pstatus */
//	$pstatus = Mage::getSingleton('catalog/product_status');
//	$pstatus->addVisibleFilterToCollection($collection);

	$collection->addAttributeToSelect('*');
	$collection->addAttributeToFilter('sku', array('eq' => '123'));
	//$collection->getSelect()->limit(2);
	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->getItems();
	/** @var Mage_Catalog_Model_Product $firstItem */
	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

	foreach ($firstItem->getAttributes() as $att) {
		if ($att->getIsConfigurable() == 1)
			$html->para('found config attribute: ' . $att->getName());
	}


	// resetData does not cut the mustard here.
//	$collection->clear();
//	$collection->getSelect()->limit(20,20);
//
//	$html->code($collection->getSelect()->__toString());
//	$html->para('found product count: ' . $collection->count());
//	$items = $collection->load()->getItems();
//
//	$firstItem = current($items);
//	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
//	$attributeSetModel->load($firstItem->getAttributeSetId());
//	$attributeSetName  = $attributeSetModel->getAttributeSetName();
//	$html->para('item sku: ' . $firstItem->getSku());
//	$html->para('item type: ' . $attributeSetName);

}

function compareItems($hi) {
	/* start with the first row, and check each other row for differences. if
	 * found, stop and return true
	 */

	for ($i = 1; $i < count($hi); $i++) {
		for ($j = 0; $j < $hi[0]->itemCount(); $j++) {
			if ($hi[0]->item($j) != $hi[$i]->item($j)) {
				return $j;
			}
		}
	}
	return false;
}

function checkCountryCode() {
	global $app;
	/** @var $collection Mage_Directory_Model_Resource_Country_Collection */

	$collection = Mage::getModel('directory/country')->getResourceCollection();
	$options = $collection->toOptionArray();

	$countryMap = array();
	foreach ($options as $option) {
		if ($option['value'] != '') {
			$countryMap[$option['value']] = $option['label'];
		}
	}

	$code = $app->getRequest()->getParam('code');
	if (!isset($code)) {
		$code = 'US';
	}

	echo 'itemid US: ' . $countryMap[$code];
}

function showAllowedFunctions($html) {
	global $allowedFunctions;
	foreach ($allowedFunctions as $func) {
		$html->para("<a href=\"/shop/mtest.php?f=$func\">" . $func . '</a>');
	}
}

function getProductAttributes() {
	global $html;

	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')
		->getCollection();
	$collection->addAttributeToSelect('*');
	$collection->addFieldToFilter('sku', 'PEBADA0301F03010019');

	/** @var Mage_Catalog_Model_Product $product */
	$product = $collection->getFirstItem();
	//->load('123-Barn-14 oz PE-Brown-12-10-20');


	$html->startList();


	/** @var Mage_Catalog_Model_Resource_Eav_Attribute $att */
	foreach ($product->getData() as $key => $val) {
		if ($key == 'stock_item') {
			$html->listItem('att name: stock_item, value: unknown');
		} else {
			$html->listItem(sprintf('att name: %s, att value: %s',
				$key, $val));
		}

	}

	$html->endList();
}

function reviewSimpleImport() {
	global $html;
	$infile = new CsvReader('/home/magentouser/catalog_product_20141008_183053.csv', ',', true);

	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'simple') {
			$html->para(sprintf("type: '%s', _super_products_sku: '%s', _super_attribute_code: %s, _super_attribute_option: %s, _super_attribute_price_corr: %s",
				$infile->item('_type'),
				$infile->item('_super_products_sku'),
				$infile->item('_super_attribute_code'),
				$infile->item('_super_attribute_option'),
				$infile->item('_super_attribute_price_corr')));
		}
	}
	$infile->close();
}
function filterExport() {
    global $html;
    $fn = $_SERVER['DOCUMENT_ROOT'] . '/var/export/weight.csv';
    $html->para(sprintf('using file: %s', $fn));
    if(!file_exists($fn)){
        $html->para(sprintf("file '%s' does not exist, exiting"));
    }

    $reader = new CsvReader($fn, ',', true);
    $writer = new CsvWriter($fn . 'filtered.csv', ',');

    $writer->appendRow($reader->getHeader());
    while($reader->nextRow()){
        if($reader->item('weight') < "150"){
            $writer->appendRow($reader->getRow());
        }
    }
}

function cleanImportFile() {
	global $html;
	$infile = new CsvReader('/home/magentouser/fullproductlist.csv', ',', true);

	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$header = array_keys($infile->getMap());
//	$header[] = 'category_ids';
	$outfile->appendRow($header);


	$skus = array();
	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'simple' && (count($skus) < 30000 || $infile->item('sku') == 'PEAACA0101F01202008')) {
			$skus[] = $infile->item('sku');
//			$html->para(sprintf("sku: %s, stock: %s, type: %s, category: %s, visibility: %s, status: %s, mstock: %s",
//				$infile->item('sku'),
//				$infile->item('is_in_stock'),
//				$infile->item('_type'),
//				$infile->item('_category'),
//				$infile->item('visibility'),
//				$infile->item('status'),
//				$infile->item('manage_stock')));
//			$infile->item('is_in_stock', 1);
			$infile->item('visibility', '4');
			$infile->item('_category', 'SP Shelter');
			$infile->item('_root_category', 'Default Category');
//			$infile->item('qty', '1');
//			$infile->item('category_ids', '5');
//			$infile->item('_store', 'default');
			$outfile->appendRow($infile->getData());
		}
	}
	$infile->rewind();
	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'configurable') {
			$infile->item('_category', 'SP Shelter');
//			$infile->item('_root_category', 'Default Category');
//			$infile->item('_super_products_sku', '');
//			$infile->item('_super_attribute_code'. '');
//			$infile->item('_super_attribute_option', '');
//			$infile->item('_super_attribute_price_corr', '');
			$infile->item('tax_class_id', '2');
			$infile->item('visibility', '4');

			$outfile->appendRow($infile->getData());
		} elseif (is_empty($infile->item('sku')) && in_array($infile->item('_super_products_sku'), $skus)) {
//			$infile->item('_category', 'SP Shelter');
//			$infile->item('_root_category', 'Default Category');
//			$infile->item('_super_products_sku', '');
//			$infile->item('_super_attribute_code'. '');
//			$infile->item('_super_attribute_option', '');
//			$infile->item('_super_attribute_price_corr', '');
//			$infile->item('tax_class_id', '2');
//			$infile->item('visibility', '4');

			$outfile->appendRow($infile->getData());

		}
	}

	$infile->close();
	$outfile->closeOutput();

	$html->para('ok done.');
}

function trimImportFile() {
	global $html;


	$infile = new CsvReader('/home/magentouser/products_10.7.2014.csv', ',', true);
	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$outfile->appendRow(array_keys($infile->getMap()));

	/* NOTE: calling nextRow advances the pointer, so the first row is skipped! */
	while ($row = $infile->nextRow() && (is_empty($infile->item('sku')) || $infile->item('sku') == '123')) {
		1;
	}
	while ($infile->nextRow()) {
		$outfile->appendRow($infile->getData());
	}

	$html->para('should be done');
}

function is_empty($val) {
	return empty($val);
}

function processImport() {
	global $html;
	$filename = __DIR__ . '/var/import/productprices.csv';
	$html->para(sprintf('found filename: %s', $filename));

	$import = new CsvReader($filename, ',', true);

	while($import->nextRow()){
		$sku = $import->item('sku');
		$price = $import->item('price');
		/** @var Mage_Catalog_Model_Resource_Product_Collection $products */
		$products = Mage::getModel('catalog/product')->getCollection();
		$products->addAttributeToFilter('sku', array('eq',$sku));
		$products->addAttributeToSelect('price');

		/** @var Mage_Catalog_Model_Product $p */
		echo sprintf('getting product with sku %s. ', $sku);
		$p = $products->getFirstItem();
		echo sprintf('price is %f, setting to %f. ', $p->getPrice(), $price);
		$p->setPrice('$price');
		$p->save();
		echo sprintf('product saved.\n');

		$html->para(sprintf('im a %s', get_class($products)));

	}

}

function prepImageImport() {
    global $html;

    $rows = array();

    $ssImages = fopen('/media/sf_Magento/FarmBuildings/ssImages.csv', "r");
    $ssDiagrams = fopen('/media/sf_Magento/FarmBuildings/ssManuals.csv', 'r');

    $header = fgetcsv($ssImages, 0, ',');
    $header = fgetcsv($ssDiagrams, 0, ',');

    while(($row = fgetcsv($ssImages, 0, ',')) !== FALSE){
        $sku = array_shift($row);
        if(isset($rows[$sku])){
            $html->para(sprintf('duplicate sku seen: %s overwritting previous row', $sku));
        }
        $rows[$sku] = array();
        $rows[$sku][] = $sku;
        $rows[$sku][] = array_shift($row);
        $extra = array();
        foreach ($row as $item) {
            $extra[] = $item;
        }
        $rows[$sku][] = implode("\n", array_filter($extra));
    }
    while(($row = fgetcsv($ssDiagrams, 0, ',')) !== FALSE){
        $sku = array_shift($row);
        if(!isset($rows[$sku])){
            $html->para(sprintf('new sku for manuals: %s', $sku));
            $rows[$sku] = array();
            $rows[$sku][] = $sku;
            $rows[$sku][] = '';
            $rows[$sku][] = '';
        }
        $rows[$sku][] = array_shift($row);
    }

    fclose($ssImages);
    fclose($ssDiagrams);

    $writer = new CsvWriter('combined.csv', ',');
    $writer->appendRow(array('sku','scene7_main','scene7_addition','scene7_manual' ));
    foreach ($rows as $row) {
        if(Mage::getModel('catalog/product')->loadByAttribute('sku',$row[0])) {
            $writer->appendRow($row);
        }
    }
    $writer->closeOutput();
}

class CsvReader {
	private $fileName;
	private $handle;
	private $hMap;
	private $delimiter;
	private $data;
    private $header;


    /**
     * CsvReader constructor.
     * @param $fn
     * @param $d
     * @param $head
     */
    public function __construct($fn, $d, $head) {
		$this->fileName = $fn;
		$this->delimiter = $d;
		$this->handle = fopen($this->fileName, "r");
		if ($this->handle !== false) {
			if ($head) {
				$map = array();
				$this->header = fgetcsv($this->handle, 0, $this->delimiter);
				if ($this->header === false) {
					return false;
				}
				for ($i = 0; $i < count($this->header); $i++) {
					$map[$this->header[$i]] = $i;
				}
				$this->hMap = $map;
			}
		} else {
			return false;
		}
	}

    public function getRow(){
        return $this->data;
    }
    public function getHeader(){
        return $this->header;
    }
	public function nextRow() {
		$this->data = fgetcsv($this->handle, 0, $this->delimiter);
		return $this->data;
	}

	public function item($field, $value = null) {
		if (isset($value)) {
			if (isset($this->hMap[$field])) {
				$this->data[$this->hMap[$field]] = $value;
			} else {
				$this->data[] = $value;
				$this->hMap[$field] = count($this->hMap);
			}
			return true;
		}
		if (is_array($this->data)) {
			return $this->data[$this->hMap[$field]];
		}
		return false;
	}

	public function close() {
		if ($this->handle) {
			fclose($this->handle);
		}
	}

	public function getMap() {
		return $this->hMap;
	}

	public function getData() {
		return $this->data;
	}

	public function rewind() {
		rewind($this->handle);
		if (isset($this->hMap)) {
			$this->nextRow();
		}
	}
}

class CsvWriter {
	private $finalDestinationPath;
	private $outputFile;
	private $outputOpen = false;
	private $delimiter;
	private $bufferSize;

	public function __construct($destFile, $delim, $buffSize = null) {
		$this->finalDestinationPath = $destFile;
		if (file_exists($this->finalDestinationPath)) {
			if (false === unlink($this->finalDestinationPath)) {
				throw new Exception("CsvWriteBuffer: unable to remove old file '$this->finalDestinationPath'");
			}
		}
		$this->delimiter = $delim;
		$this->bufferSize = $buffSize;
	}

	public function __destruct() {
		$this->closeOutput();
	}

	public function appendRow(array $fields) {
		if (!$this->outputOpen) {
			$this->openOutput();
		}
		if (false === fputcsv($this->outputFile, $fields, $this->delimiter)) {
			throw new Exception("CsvWriter: failed to write row.");
		}
	}

	public function openOutput() {
		if (false === ($this->outputFile = fopen($this->finalDestinationPath, 'a'))) {
			throw new Exception("CsvWriter: Failed to open destination file '$this->finalDestinationPath'.");
		}
		if (!is_null($this->bufferSize)) {
			stream_set_write_buffer($this->outputFile, $this->bufferSize);
		}
		$this->outputOpen = true;
	}

	public function closeOutput() {
		if (!$this->outputOpen) {
			if (false === fclose($this->outputFile)) {
				throw new Exception("CsvWriter: Failed to close destination file'$this->finalDestinationPath'.");
			}
			$this->outputOpen = false;
		}
	}

}

class HtmlOutputter {
	public function __construct() {

	}

	public function startHtml() {
		echo "<!DOCTYPE html>\n<html>\n";
		return $this;
	}

	public function startHead($title = null) {
		echo "<head>\n";
		if ($title)
			echo "<title>$title</title>\n";
		return $this;
	}

	public function endHead() {
		echo "</head>\n";
		return $this;
	}

	public function startBody() {
		echo "<body>\n";
		return $this;
	}

	public function endBody() {
		echo "</body>\n";
		return $this;
	}

	public function endHtml() {
		echo "</html>\n";
		return $this;
	}

	public function para($content) {
		echo '<p>', $content, "</p>\n";
		return $this;
	}

	public function pre($content) {
		echo '<pre>', print_r($content, true), "</pre>\n";
		return $this;
	}

	public function code($content) {
		echo '<code>', $content, "</code>\n";
		return $this;
	}

	public function startList() {
		echo '<ul>', "\n";
		return $this;
	}

	public function endList() {
		echo "</ul>\n";
		return $this;
	}

	public function listItem($content) {
		echo '<li>' . $content . "</li>\n";
		return $this;
	}

	public function startTable($header) {
		echo '<table border="1">', "\n";
		echo '<tr>', "\n";
		foreach ($header as $h) {
			echo '<th>', $h, '</th>';
		}
		echo '</tr>', "\n";
	}

	public function endTable() {
		echo '</table>', "\n";
	}

	public function tableRow($data) {
		echo '<tr>', "\n";
		foreach ($data as $d) {
			echo '<td>', htmlentities(substr($d, 0, 50)), '</td>', "\n";
		}
		echo '</tr>', "\n";
	}
}
