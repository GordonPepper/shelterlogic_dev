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
	'getConfigurableAttributes'
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

function getConfigurableAttributes($product = null)
{
	global $html;
	//Mage::log('returning from ' . __METHOD__);
	/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $collection */
	$collection = Mage::getResourceModel('catalog/product_type_configurable_attribute_collection');

	/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
	$conn = $collection->getConnection();

	/** @var Varien_Db_Select $select */
	$select = $conn->select();

	$select->from(array('super_attribute' => $conn->getTableName('catalog_product_super_attribute')),'*')
		->where('super_attribute.product_id = ?', '22926')
		->order('position');

	$res = $conn->fetchAll($select);

	foreach($res as $row) {
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
	Varien_Profiler::start('CONFIGURABLE:'.__METHOD__);
	if (!$this->getProduct($product)->hasData($this->_configurableAttributes)) {
		$configurableAttributes = $this->getConfigurableAttributeCollection($product)
			->orderByPosition()
			->load();
		$this->getProduct($product)->setData($this->_configurableAttributes, $configurableAttributes);
	}
	Varien_Profiler::stop('CONFIGURABLE:'.__METHOD__);
	return $this->getProduct($product)->getData($this->_configurableAttributes);
}



function wfKeyGen() {
	global $html;

	$domain = getDomain($_SERVER['SERVER_NAME']);
	$key = "wf" . substr(sha1('WF1DM' . $domain), 0, 20);
	$html->para("key: " . $key);
}

function getDomain($url)
{
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
		$parts = explode( '/', rtrim($line));
		if(count($parts) > 1 && !isset($dirs[$parts[1]]) && !empty($parts[1]))
			$dirs[$parts[1]] = array();
		if(count($parts) > 2 && !isset($dirs[$parts[1]][$parts[2]]) && !empty($parts[2]))
			$dirs[$parts[1]][$parts[2]] = array();
		if(count($parts) > 3 && !isset($dirs[$parts[1]][$parts[2]][$parts[3]]) && !empty($parts[3]))
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

function tl_getItemList(){
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
	$collection->addAttributeToFilter('sku', array('eq' => '123'));
	//$collection->getSelect()->limit(2);
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

	foreach($firstItem->getAttributes() as $att) {
		if($att->getIsConfigurable() == 1)
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

function getProductAttributes(){
	global $html;

	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')
		->getCollection();
	$collection->addAttributeToSelect('*');
	$collection->addFieldToFilter('sku', '123-Barn-14 oz PE-Brown-12-10-24');

	/** @var Mage_Catalog_Model_Product $product */
	$product = $collection->getFirstItem();
		//->load('123-Barn-14 oz PE-Brown-12-10-20');


	$html->startList();


	/** @var Mage_Catalog_Model_Resource_Eav_Attribute $att */
	foreach($product->getData() as $key => $val) {
		if($key == 'stock_item') {
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
	$infile = new CsvReader('/home/magentouser/catalog_product_20141008_183053.csv', ',',true);

	while ($infile->nextRow()) {
		if($infile->item('_type') =='simple') {
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

function cleanImportFile() {
	global $html;
	$infile = new CsvReader('/home/magentouser/fullproductlist.csv', ',',true);

	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$header = array_keys($infile->getMap());
//	$header[] = 'category_ids';
	$outfile->appendRow($header);


	$skus = array();
	while ($infile->nextRow()) {
		if($infile->item('_type') =='simple' && (count($skus) < 10000 || $infile->item('sku') == 'PEAACA0101F01202008')) {
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
	while($infile->nextRow()){
		if($infile->item('_type') == 'configurable') {
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


	$infile = new CsvReader('/home/magentouser/products_10.7.2014.csv', ',',true);
	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$outfile->appendRow(array_keys($infile->getMap()));

	/* NOTE: calling nextRow advances the pointer, so the first row is skipped! */
	while ($row = $infile->nextRow() && (is_empty($infile->item('sku')) || $infile->item('sku') == '123')) {
		1;
	}
	while($infile->nextRow()){
		$outfile->appendRow($infile->getData());
	}

	$html->para('should be done');
}
function is_empty($val) {
	return empty($val);
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
	public function item($field, $value = null){
		if(isset($value)) {
			if(isset($this->hMap[$field])) {
				$this->data[$this->hMap[$field]] = $value;
			} else {
				$this->data[] = $value;
				$this->hMap[$field] = count($this->hMap);
			}
			return true;
		}
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
	public function getData(){
		return $this->data;
	}

	public function rewind(){
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
