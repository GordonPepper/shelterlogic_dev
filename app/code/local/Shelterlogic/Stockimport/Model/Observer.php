<?php
class Shelterlogic_Stockimport_Model_Observer
{
    const LOG_FILE = "stock_import.log";
    const XML_PATH_DATA_FILE_PATH       = 'shelterlogic/stockimport/filepath';
    const XML_PATH_WAREHOUSEID_MAPPING  = 'shelterlogic/stockimport/warehouseid_mapping';
    const XML_PATH_ENABLE_ARCHIVE       = 'shelterlogic/stockimport/enable_archive';
    const XML_PATH_ARCHIVE_FOLDER       = 'shelterlogic/stockimport/archive_folder';
    const XML_PATH_CORE_MANAGE_STOCK = '';

    /**
     * @var Magento_Db_Adapter_Pdo_Mysql
     */
    protected $adapter = null;
    protected $tableName = null;
    protected $productIdsCache = array();

    public function __construct()
    {
        $this->adapter = Mage::getSingleton('core/resource')->getConnection(Mage_Core_Model_Resource::DEFAULT_WRITE_RESOURCE);
        $this->tableName = Mage::getSingleton('core/resource')->getTableName('gaboli_warehouse/stock');
    }

    public function import()
    {
        Mage::log('============== START ==============', Zend_Log::DEBUG, self::LOG_FILE);

        $fileHandle = null;
        $totalUpdated = 0;
        $notExistedSku = array();
        $dataFile = null;
        try {
            $dataFile = $this->getStockDataFile();
            if(null === $dataFile) {
                Mage::log('No import file available', Zend_Log::DEBUG, self::LOG_FILE);
                Mage::log('============== END ==============', Zend_Log::DEBUG, self::LOG_FILE);
                return;
            }

            $fileHandle = fopen($dataFile, 'r');
            $header = fgetcsv($fileHandle);
            $warehouseIdMapping = $this->getWarehouseIdMapping($header);
            $numberOfWarehouses = count($warehouseIdMapping);
            while ($row = fgetcsv($fileHandle)) {
                $sku = $row[0];
                $productId = $this->getProductId($sku);
                if ($productId) {
                    for ($i = 1; $i <= $numberOfWarehouses; $i++) {
                        if (!isset($row[$i]) || trim($row[$i]) === '') {
                            continue;
                        }

                        $qty = intval($row[$i]);
                        $isInStock = ($qty > 0 ? 1 : 0);
                        $this->adapter->update($this->tableName,
                            array('qty' => $qty, 'is_in_stock' => $isInStock),
                            array(
                                'location_id = ?' => $warehouseIdMapping[$i],
                                'product_id = ?' => $productId,
                            ));
                    }
                    $totalUpdated++;
                    /*
                     * ok, so if the product is in the stock file, we need to
                     * set the system to manage stock on the product regardless
                     * if the stock is 0 or more
                     */
                    $product = Mage::getModel('catalog/product')->load($productId);
                    if($product->getId() == $productId) {
                        if($product->getStockItem()->getManageStock() != 1) {
                            $product->getStockItem()->setManageStock(1)->setUseConfigManageStock(0)->save();
                        }
                    }

                } else {
                    $notExistedSku[] = $sku;
                }
            }
        } catch (Exception $e) {

            $email = "oussama.saddane@americaneagle.com, dbates@shelterlogic.com";
            $f_name = "Shelterlogic";
            $f_email = "shelterlogic@shelterlogic.com";
            if($email) {
                mail(
                    $email,
                    'Stock Import failure notice',
                    "NOTICE: THE STOCK IMPORT HAS FAILED:\r\n\r\nPlease review the VISUAL Soap log for more information.",
                    "From: $f_name <$f_email>"
                );
            }

            Mage::logException($e);
            Mage::log('Error: ' . $e->getMessage(), Zend_Log::ERR, self::LOG_FILE);
        }

        $fileHandle ? fclose($fileHandle) : null;
        Mage::getModel('gaboli_warehouse/stock_status_index')->reindex();
        Mage::log('Total updated SKUs: ' . $totalUpdated, Zend_Log::DEBUG, self::LOG_FILE);
        if (count($notExistedSku) > 0) {
            Mage::log('Not existed SKUs: ' . implode(', ', $notExistedSku), Zend_Log::DEBUG, self::LOG_FILE);
        }

        $this->archiveStockDataFile($dataFile);

        Mage::log('=============== END ===============', Zend_Log::DEBUG, self::LOG_FILE);
    }

    protected function getStockDataFile()
    {
        /*
         * ok, changing this to accept arbitrary "*.csv" files,
         * reusing the "DATA_FILE_PATH" as a directory
         */
        $dirPath = dirname(Mage::getStoreConfig(self::XML_PATH_DATA_FILE_PATH));
        if(is_dir($dirPath)){
            if($dh = opendir($dirPath)){
                while(($file = readdir($dh)) !== false ){
                    $inf = pathinfo($file);
                    if(strtolower($inf['extension']) == "csv"){
                        return implode('/', array($dirPath, $file));
                    }
                }
            }
        }
//        if (file_exists($filePath) && !is_readable($filePath)) {
//            Mage::throwException(sprintf('Data file [%s] exists but is not readable', $filePath));
//        } elseif( !file_exists($filePath) ) {
//            return null;
//        }
//
//        return $filePath;
    }

    protected function archiveStockDataFile($file)
    {
        if (Mage::getStoreConfigFlag(self::XML_PATH_ENABLE_ARCHIVE) && $file) {
            $archiveFolder = Mage::getStoreConfig(self::XML_PATH_ARCHIVE_FOLDER);
            if (!is_dir($archiveFolder)) {
                $result = mkdir($archiveFolder, 0777, true);
                if (!$result) {
                    Mage::log(sprintf('Archive functionality is enable, but the archive folder [%s] cannot be created', $archiveFolder), Zend_Log::ERR, self::LOG_FILE);
                    return;
                }
            }

            if (!is_dir_writeable($archiveFolder)) {
                Mage::log(sprintf('Archive functionality is enable, but the archive folder [%s] is not writable', $archiveFolder), Zend_Log::ERR, self::LOG_FILE);
            } else {
                $archiveFile = $archiveFolder . DS . pathinfo($file, PATHINFO_BASENAME) . date('.Ymd.U');
                $result = rename($file, $archiveFile);
                if ($result) {
                    Mage::log(sprintf('Data file is successfully archived to [%s]', $archiveFile), Zend_Log::DEBUG, self::LOG_FILE);
                } else {
                    Mage::log(sprintf('Archive functionality is enable, but the data file [%s] is not movable', $file), Zend_Log::ERR, self::LOG_FILE);
                }
            }
        }
    }

    protected function getWarehouseIdMapping($header)
    {
        /**
         * Stock id mapping in format:
         * <Warehouse 1 name>|<Warehouse 1 id>
         * <Warehouse 2 name>|<Warehouse 2 id>
         */
        $mappingConfig = Mage::getStoreConfig(self::XML_PATH_WAREHOUSEID_MAPPING);
        $mappingConfig = explode("\n", trim($mappingConfig));
        $warehouseIdMapping = array();
        foreach ($mappingConfig as $item) {
            $item = explode('|', $item);
            $warehouseIdMapping[trim($item[0])] = trim($item[1]);
        }

        $warehouseNames = array_keys($warehouseIdMapping);
        $unknownWarehouses = array();
        for ($i = 1; $i < count($header); $i++) {
            if (!in_array($header[$i], $warehouseNames)) {
                $unknownWarehouses[] = $header[$i];
            } else {
                $warehouseIdMapping[$i] = $warehouseIdMapping[$header[$i]];
                unset($warehouseIdMapping[$header[$i]]);
            }
        }

        if (!empty($unknownWarehouses)) {
            Mage::throwException(sprintf('Unknown warehouse(s) in data file: [%s]. Available warehouse(s) is: [%s]',
                implode(', ', $unknownWarehouses), implode(', ', $warehouseNames)));
        }

        return $warehouseIdMapping;
    }

    protected function getProductId($sku)
    {
        if (!isset($this->productIdsCache[$sku])) {
            $this->productIdsCache[$sku] = Mage::getSingleton('catalog/product')->getIdBySku($sku);
        }

        return $this->productIdsCache[$sku];
    }
}