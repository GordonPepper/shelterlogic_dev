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
	'totaLogistix'
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

function checkLog() {
	global $html;
	Mage::log('Foo is logged', null, 'hawksearch_errors.log');
	$html->para('well i tried...');
}


function getVersion() {
	global $html;
	$html->para("version: " . Mage::getVersion());
	$html->para('version info' . print_r(Mage::getVersionInfo(), true));
}

function getAttributes() {
	global $html;

	$handle = fopen("/var/www/magentoce.1-7.local/htdocs/magento/var/hawksearch/feeds/attributes.txt",'r');
	$keys = fgetcsv($handle, 0, "\t");
	$atts = array();
	while( $vals = fgetcsv($handle, 0, "\t")) {
		if( $vals[1] == 'model' || $vals[1] == 'model_name'){
			$atts[] = array('attribute' => $vals[1], 'value' => $vals[2]);
		} elseif ($vals[0] =='NOW' && $vals[1] == 'OUTPUTTING') {
			$atts[] = array('attribute' => 'NOW OUTPUTTING', 'value' => $vals[2]);
		}
	}
	$html->para('done, found ' . count($atts) . ' attributes');
	$html->startList();
	foreach($atts as $a) {
		$html->listItem($a['attribute'] . ': ' . $a['value']);
	}
	$html->endList();

	fclose($handle);



	/** @var Mage_Catalog_Model_Product $product */
//	$product = Mage::helper('catalog/product')->getProduct('10780', Mage::app()->getStore()->getId(), 'sku');
//	//$html->para('the guitar: ' . print_r($product, true));
//	$atts = $product->getAttributes();
//
//	ksort($atts);
//	foreach(array_keys($atts) as $a) {
//		$html->para($a);
//	}


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

function checkItemSku() {
	global $html;
	$filename = "/home/magentouser/items.txt";
	$delim = "\t";
	$headerRow = true;
	$csv = new CsvReader($filename, $delim, $headerRow);
	if($csv !== false) {
		$a = array();
		while($csv->nextRow()){
			if(isset($a[$csv->item('sku')]) && is_array($a[$csv->item('sku')])){
				$a[$csv->item('sku')][] = new HawkItem($csv);
			} else {
				$a[$csv->item('sku')] = array(new HawkItem($csv));
			}
		}
		$csv->close();
		foreach (array_keys($a) as $key){
			if(count($a[$key]) > 1) {
				if(($col = compareItems($a[$key])) !== false){
					$map = $csv->getMap();
					$idx = array_keys($map, $col);
					$name = $idx[0];
					$html->para("found sku: $key, " . count($a[$key]) . " times with different values for col $name");
				}
			}
		}
		$html->para("Done checking Item sku");
	}
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

function streamTest() {
	$path = Mage::helper('hawksearch_datafeed/feed')->getFeedFilePath();
	/* ok, so the goal here is to test the behavior of the "php://temp/maxmemory:$byteSize" stream
	 * for the purpose of buffering the fputcsv() function call.
	 * so what we want to do is to fill up the buffer, and periodically flush to file.
	 * My typical plan for such a task would be to create a private class that handles
	 * opening, buffering, flushing, and closing of the file, so lets try it. */
	$buffer = new CsvWriteBuffer($path . '/testbuff.csv', "\t", 1024 * 2048, 1023 * 2048);
	$counter = 0;
	while ($counter++ < 1000) {
		$buffer->appendRow(array($counter, 'test, one', 'emedeede "quotes"', "embedded tab->   <-", "another embedded tab->\t<-"));
		$buffer->appendRow(array($counter, 'here', 'are', 'some', 'plain', 'fields'));
		$buffer->appendRow(array($counter, 'with spaces', 'withoutspaces'));
		$buffer->appendRow(array($counter, 'and don\'t forget', "about embedded\nline endings!"));
	}
}

function createTabFields() {
	global $app;

	$out = fopen('php://output', 'a');
	fputcsv($out, array('test, one', 'emedeede "quotes"', "embedded tab->	<-", "another embedded tab->\t<-"), "\t");
	fputcsv($out, array('here', 'are', 'some', 'plain', 'fields'), "\t");
	fputcsv($out, array('plain', 'embedded, comma', 'embedded faux \t tab'), "\t");
	fputcsv($out, array('with spaces', 'withoutspaces'), "\t");
	fputcsv($out, array('and don\'t forget', "about embedded\nline endings!"), "\t");
	fputcsv($out, array('comma sep', 'values', 'with embedded, comma'));
	fclose($out);
}

function mdg_giftregistry() {
	//$registry = Mage::getModel('mdg_giftregistry/entity');
//echo get_class($registry);

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

function getTempDirList() {
	$dir = array();
	if ($handle = opendir(sys_get_temp_dir())) {
		while (false !== ($entry = readdir($handle))) {
			$dir[] = $entry;
		}
	}
	closedir($handle);
	asort($dir);
	return $dir;
}

function showAllowedFunctions($html) {
	global $allowedFunctions;
	foreach($allowedFunctions as $func){
		$html->para("<a href=\"/mtest.php?f=$func\">" . $func . '</a>');
	}
}

class HawkItem {
	private $values;
	/** @var $row CsvReader */
	public function __construct($row){
		foreach($row->getMap() as $key => $idx) {
			$this->values[$idx] = $row->item($key);
		}
	}
	public function item($idx) {
		return $this->values[$idx];
	}
	public function itemCount() {
		return count($this->values);
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


class CsvWriteBuffer {
	private $tempBuffer;
	private $bufferSize;
	private $finalDestinationPath;
	private $outputFile;
	private $currentSize;
	private $bufferOpen = false;
	private $outputOpen = false;
	private $delimiter;
	private $flushSize;

	public function __construct($destFile, $delim = ",", $buffSize, $flushSize) {
		$this->finalDestinationPath = $destFile;
		if (file_exists($this->finalDestinationPath)) {
			if (false === unlink($this->finalDestinationPath)) {
				throw new Exception("CsvWriteBuffer: unable to remove old file '$this->finalDestinationPath'");
			}
		}
		$this->delimiter = $delim;
		$this->bufferSize = $buffSize;
		$this->flushSize = $flushSize;
	}

	public function __destruct() {
		$this->flushBuffer();
		fclose($this->tempBuffer);
		fclose($this->outputFile);
	}

	public function appendRow(array $fields) {
		if (!$this->bufferOpen) {
			$this->openBuffer();
		}
		$this->currentSize += fputcsv($this->tempBuffer, $fields, $this->delimiter);
		if ($this->currentSize >= $this->flushSize) {
			$this->flushBuffer();
		}
	}

	private function openBuffer() {
		if (false === ($this->tempBuffer = fopen("php://temp/maxmemory:$this->bufferSize", 'r+'))) {
			throw new Exception("CsvWriteBuffer: Failed to open temp buffer");
		}
		$this->bufferOpen = true;
		$this->currentSize = 0;
	}

	private function openOutput() {
		if (false === ($this->outputFile = fopen($this->finalDestinationPath, 'a'))) {
			throw new Exception("CsvWriteBuffer: Failed to open destination file '$this->finalDestinationPath''");
		}
		$this->outputOpen = true;
	}

	private function flushBuffer() {
		if (!$this->outputOpen) {
			$this->openOutput();
		}
		rewind($this->tempBuffer);
		while (!feof($this->tempBuffer)) {
			if (false === fwrite($this->outputFile, fread($this->tempBuffer, 8192))) {
				throw new Exception("CsvWriteBuffer: Error writing to destination file '$this->finalDestinationPath'");
			}
		}
		ftruncate($this->tempBuffer, 0);
		rewind($this->tempBuffer);
		$this->currentSize = 0;
	}
}
class TestObject {
	private $value;
	private $array;
	public function __construct($value){
		$this->value = $value;
		$this->array['value'] =  $value;
		$this->array['ammendedvalue'] = $value . ' ammended';
	}
}