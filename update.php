<?php
/**
 * Created by PhpStorm.
 * User: astayart
 * Date: 4/2/14
 * Time: 2:17 PM
 */

ini_set('display_errors', true);

require 'app/Mage.php';
Mage::setIsDeveloperMode(true);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
/** @var Mage $app */
$app = Mage::app();



function processImport() {
    global $html;
    $filename = __DIR__ . '/var/import/productprices.csv';

    if(!file_exists($filename)) {
        echo sprintf("file %s does not exist, exiting\n", $filename);
        exit;
    }
    echo "going to create import file\n";

    $import = new CsvReader($filename, ',', true);

    echo "import file ready, starting processing\n";

    while($import->nextRow()){
        $sku = $import->item('sku');
        $price = $import->item('price');
        /** @var Mage_Catalog_Model_Resource_Product_Collection $products */
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToFilter('sku', array('eq',$sku));
        $products->addAttributeToSelect('price');

        /** @var Mage_Catalog_Model_Product $p */
        echo sprintf('getting product with sku %s. ', $sku);
        if($products->count() == 0){
            echo sprintf("WARNING: PRODUCT WITH SKU %s NOT FOUND, MOVING ON...", $sku);
        } else {
            $p = $products->getFirstItem();
            echo sprintf('price is %f, setting to %f. ', $p->getPrice(), $price);
            $p->setPrice($price);
            $p->save();
            echo sprintf("product saved.\n");

        }

        break;
    }

}
processImport();


class CsvReader {
    private $fileName;
    private $handle;
    private $hMap;
    private $delimiter;
    private $data;

    public function __construct($fn, $d, $head) {
        $this->fileName = $fn;
        $this->delimiter = $d;
        $this->handle = fopen($this->fileName, "r");
        if ($this->handle !== false) {
            if ($head) {
                $map = array();
                $fields = fgetcsv($this->handle, 0, $this->delimiter);
                if ($fields === false) {
                    return false;
                }
                for ($i = 0; $i < count($fields); $i++) {
                    $map[$fields[$i]] = $i;
                }
                $this->hMap = $map;
            }
        } else {
            return false;
        }
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


