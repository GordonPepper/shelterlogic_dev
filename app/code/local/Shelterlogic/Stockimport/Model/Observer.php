<?php
class Shelterlogic_Stockimport_Model_Observer
{
    const LOG_FILE = "stock_import.log";
    const XML_PATH_DATA_FILE_PATH       = 'shelterlogic/stockimport/filepath';
    const XML_PATH_DATA_WAREHOUSEID_MAPPING = 'shelterlogic/stockimport/warehouseid_mapping';

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
        try {
            $dataFile = $this->getStockDataFile();

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
                } else {
                    $notExistedSku[] = $sku;
                }
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::log('Error: ' . $e->getMessage(), Zend_Log::ERR, self::LOG_FILE);
        }

        $fileHandle ? fclose($fileHandle) : null;
        Mage::getModel('gaboli_warehouse/stock_status_index')->reindex();
        Mage::log('Total updated SKUs: ' . $totalUpdated, Zend_Log::DEBUG, self::LOG_FILE);
        if (count($notExistedSku) > 0) {
            Mage::log('Not existed SKUs: ' . implode(', ', $notExistedSku), Zend_Log::DEBUG, self::LOG_FILE);
        }
        Mage::log('=============== END ===============', Zend_Log::DEBUG, self::LOG_FILE);
    }

    protected function getStockDataFile()
    {
        $filePath = Mage::getStoreConfig(self::XML_PATH_DATA_FILE_PATH);
        if (!is_readable($filePath)) {
            Mage::throwException(sprintf('Data file [%s] does not exist or not readable', $filePath));
        }

        return $filePath;
    }

    protected function getWarehouseIdMapping($header)
    {
        /**
         * Stock id mapping in format:
         * <Warehouse 1 name>|<Warehouse 1 id>
         * <Warehouse 2 name>|<Warehouse 2 id>
         */
        $mappingConfig = Mage::getStoreConfig(self::XML_PATH_DATA_WAREHOUSEID_MAPPING);
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