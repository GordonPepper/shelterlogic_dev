<?php
/**
 * Created by PhpStorm.
 * User: astayart
 * Date: 4/2/14
 * Time: 2:17 PM
 */

header("Content-Type: text/html");
ini_set('display_errors', true);

require 'app/Mage.php';
Mage::setIsDeveloperMode(true);

/** @var Mage $app */
$app = Mage::app();
$f = $app->getRequest()->getParam('f');

$allowedFunctions = array(
	'totaLogistix',
	'fb_getItemList',
	'farmImportAddVals'
);

$html = new HtmlOutputter();
$html->startHtml()->startBody();
$html->para('<a href="/mtest.php">home</a>');

if (isset($f) && in_array($f, $allowedFunctions)) {
	try {
		$html->para("executing function: " . $f);
		call_user_func($f);

	} catch (Exception $e) {
		$html->para("failed to run function $f");
		$html->para($e->getMessage());
		$html->pre($e->getTraceAsString());
	}
} else {
	$html->para( "mtest php is designed to take an arg 'f' and execute a designated function");
	$html->para("allowed functions:");
	showAllowedFunctions($html);
	exit;
}

function farmImportAddVals() {
	$source = new CsvReader('/home/magentouser/import.csv',',', true);
	$dest = new CsvWriter('/home/magentouser/import_fixed.csv', ',');

}

function xmlTesting() {
	global $html;
	$html->para("getting xml");
	$config = Mage::app()->getConfig()->getNode();
	$html->para("dumping to file");
	file_put_contents("/tmp/config.xml", $config->asXML());
}

function totaLogistix() {
	global $html;
	// start with the sample call:
	$client = new Zend_Http_Client();

	$html->para('starting...');
	$items = fb_getItemList();

	$html->para('sending items:');
	$html->pre(htmlentities($items));

	$client->setUri("https://www.mytlx.com/services/TLXShelterLogicLTLRates.aspx");
	$client->setParameterGet('szip', '60618');
	$client->setParameterGet('czip', '01535');
	$client->setParameterGet('date', '10/10/2014');
	$client->setParameterGet('service', '');
	$client->setParameterGet('AccessID', 'BE8DB0A8-90C5-4DAD-8476-008941B7382F');
	$client->setParameterGet('items', $items);

	$response = $client->request();
	$xml = $response->getBody();
	$html->pre(htmlentities($xml));

	$ele = simplexml_load_string($xml);
	$status = $ele->xpath('/Response/Status');
	if($status === false) {
		Mage::logException("Failed to load response");
	}
	$html->para('Result: ' . $status[0]->__toString());

	$prices = $ele->xpath('/Response/PriceSheet');
	if($prices === false) {
		Mage::logException("Failed to load shipping price sheets");
	}
	$html->startList();
	foreach($prices as $price){
		echo '<li>';
		$html->startList();
		foreach($price->children() as $child){
			$html->listItem("{$child->getName()}: {$child->__toString()}");
		}
		$html->endList();
		echo '</li>';
	}
	$html->endList();

}

function fb_getItemList(){
	$items = array(
		array('class' => '55', 'weight' => '640'),
		array('class' => '50', 'weight' => '140')
	);
	$xml = "<Items>";
	foreach($items as $item) {
		$xml .= "<Item><Class>{$item['class']}</Class><Weight>{$item['weight']}</Weight></Item>";
	}
	return $xml . '</Items>';
}

function cacheTest() {
	global $html;
	global $app;
	/** @var Zend_Cache_Core $cache */
	$cache = $app->getCache();
	$cache->setOption('automatic_serialization',true);
	$cid = 'myTestCacheKey';
	$add = $app->getRequest()->getParam("add");
	if (isset($add)){
		$cache->save($add, $cid);
	}

	$obj = $app->getRequest()->getParam("object");
	if(isset($obj)){
		$obj = new TestObject('onomatopoeia');
		$cache->save($obj, 'myTestCacheObject');
	}


	$data = $cache->load($cid);
	if($data !== false) {
		$html->para('found data: ' . $data);
	} else {
		$html->para('no cache data set');
	}
	unset($data);
	$data = $cache->load('myTestCacheObject');
	if($data !== false) {
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

	if($exists->isTableExists('catalog_product_entity_url_key')) {
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
	$collection->addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED));
	$collection->getSelect()->limit(2);
	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->getItems();
	/** @var Mage_Catalog_Model_Product $firstItem */
	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName  = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

	// resetData does not cut the mustard here.
	$collection->resetData();
	$collection->getSelect()->limit(20,20);

	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->load()->getItems();

	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName  = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

}

function compareItems($hi){
	/* start with the first row, and check each other row for differences. if
	 * found, stop and return true
	 */

	for($i = 1; $i < count($hi); $i++) {
		for($j = 0; $j < $hi[0]->itemCount(); $j++) {
			if($hi[0]->item($j) != $hi[$i]->item($j)) {
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
	foreach($allowedFunctions as $func){
		$html->para("<a href=\"/mtest.php?f=$func\">" . $func . '</a>');
	}
}


class CsvReader {
	private $fileName;
	private $handle;
	private $hMap;
	private $delimiter;
	private $data;

	public function __construct($fn, $d, $head){
		$this->fileName = $fn;
		$this->delimiter = $d;
		$this->handle = fopen($this->fileName, "r");
		if($this->handle !== false) {
			if($head) {
				$map = array();
				$fields = fgetcsv($this->handle, 0, $this->delimiter);
				if($fields === false){
					return false;
				}
				for($i = 0; $i < count($fields); $i++){
					$map[$fields[$i]] = $i;
				}
				$this->hMap = $map;
			}
		} else {
			return false;
		}
	}
	public function nextRow(){
		$this->data = fgetcsv($this->handle, 0, $this->delimiter);
		return $this->data;
	}
	public function item($field){
		if(is_array($this->data)){
			return $this->data[$this->hMap[$field]];
		}
		return false;
	}
	public function close(){
		if($this->handle){
			fclose($this->handle);
		}
	}
	public function getMap(){
		return $this->hMap;
	}

}

class HtmlOutputter {
	public function __construct() {

	}
	public function startHtml() {
		echo "<html>\n";
		return $this;
	}
	public function startHead() {
		echo "<head>\n";
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
		echo '<pre>', print_r($content,true), "</pre>\n";
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

