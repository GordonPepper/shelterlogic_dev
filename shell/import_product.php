<?php
require_once 'abstract.php';

class ShelterLogic_Product_Import extends Mage_Shell_Abstract
{
    const WEBSITE_CODE = 'shelterlogic';

    protected $startTime;
    protected $attributeCodes = array();
    protected $attributeOptions = array();
    protected $categoryPaths = array();

    protected $eavSetup;
    protected $import;

    protected $rootCagetoryName;

    public function __construct()
    {
        parent::__construct();
        $this->attributeCodes = array(
            "sku" => "sku",
            "name" => "name",
            "size" => "size",
            "short description" => "short_description",
            "marketing bullet 1" => "marketing_bullet_1",
            "marketing bullet 2" => "marketing_bullet_2",
            "marketing bullet 3" => "marketing_bullet_3",
            "marketing bullet 4" => "marketing_bullet_4",
            "marketing bullet 5" => "marketing_bullet_5",
            "marketing bullet 6" => "marketing_bullet_6",
            "marketing bullet 7" => "marketing_bullet_7",
            "marketing bullet 8" => "marketing_bullet_8",
            "marketing bullet 9" => "marketing_bullet_9",
            "category" => "_category",
            "scene 7 main image" => "scene7_main",
            "scene 7 additional images" => "scene7_addition",
            "video url" => "video_url",
            "assembly manual url" => "scene7_manual",
            "style" => "style",
            "width" => "width",
            "length" => "length",
            "height" => "height",
            "fabric material" => "fabric_material",
            "fabric color" => "fabric_color",
            "shipping length" => "tlx_ship_length",
            "shipping width" => "tlx_ship_width",
            "shipping height" => "tlx_ship_height",
            "ship method" => "tlx_ship_ltl",
            "pallet weight (lbs.)" => "tlx_pallet_weight",
            "peak height (ft.)" => "peak_height",
            "wall height (ft.)" => "wall_height",
            "zipper width at bottom" => "zipper_width_at_bottom",
            "zipper width at top" => "zipper_width_at_top",
            "side zipper height" => "side_zipper_height",
            "middle zipper height" => "middle_zipper_height",
            "wind speed rating" => "wind_speed_rating",
            "snow load rating" => "snow_load_rating",
            "valence" => "valence",
            "waterproof" => "waterproof",
            "water-resistant" => "water_resistant",
            "fire rated" => "fire_rated",
            "warranty" => "warranty",
            "storage bag" => "storage_bag",
            "hardware kit" => "hardware_kit",
            "cords of wood" => "cords_of_wood",
            "manage_stock" => "manage_stock",
            "use_config_manage_stock" => "use_config_manage_stock",
            "status" => "status",
            "size (imperial)" => "size"
// TODO: uncomment these after get exact columns name
//            "???" => "marketing_block_title",
//            "???" => "marketing_block_description",
        );
        $this->eavSetup = Mage::getSingleton('eav/entity_setup', 'core_setup');
        $this->import = Mage::getModel('fastsimpleimport/import');

        $this->populateCurrentAttributeOption();
        $this->populateCurrentCategories();
    }

    protected function populateCurrentAttributeOption()
    {
        $attrWithOptions = array(
            "style", "width", "length", "height", "fabric_material", "fabric_color"
        );

        foreach ($attrWithOptions as $attrCode) {
            /** @var Mage_Eav_Model_Entity_Attribute $attrModel */
            $attrModel = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attrCode);
            $options = $attrModel->getSource()->getAllOptions(false);
            foreach ($options as $option) {
                $this->attributeOptions[$attrCode][] = $option['label'];
            }
        }
    }

    protected function validateAttributeOption($attrCode, $label)
    {
        if (isset($this->attributeOptions[$attrCode]) && !in_array($label, $this->attributeOptions[$attrCode])) {
            $attributeId = $this->eavSetup->getAttributeId('catalog_product', $attrCode);
            $this->eavSetup->addAttributeOption(array(
                'values' => array($label),
                'attribute_id' => $attributeId
            ));
            $this->attributeOptions[$attrCode][] = $label;
        }
    }

    protected function populateCurrentCategories()
    {
        $rootCagetoryId = Mage::getModel('core/website')->load(self::WEBSITE_CODE)->getDefaultGroup()->getRootCategoryId();
        $rootCategory = Mage::getModel('catalog/category')->load($rootCagetoryId);
        $this->rootCagetoryName = $rootCategory->getName();
        $childIds = $rootCategory->getAllChildren(true);
        unset($childIds[0]); // Root category also returned in array as first element

        foreach ($childIds as $id)
        {
            $category = Mage::getModel('catalog/category')->load($id);
            $categories[$id]['name'] = $category->getName();
            $categories[$id]['path'] = $category->getPath();
        }
        foreach ($childIds as $id)
        {
            $path = explode('/', $categories[$id]['path']);
            $string = '';
            foreach ($path as $pathId)
            {
                if (!isset($categories[$pathId])) continue;
                $string .= $categories[$pathId]['name'] . '/';
            }
            $string = substr($string, 0, strlen($string) - 1);
            $this->categoryPaths[] = $string;
        }
    }

    public function validateCategory($path)
    {
        $path = trim($path, '/');
        if (!$path) return;

        if (!in_array($path, $this->categoryPaths)) {
            // Recursively validating parents of this category
            $this->validateCategory(substr($path, 0, strrpos($path, '/')));
            echo sprintf("\tCreating new category [%s] ... ", $path);
            $this->import->processCategoryImport(array(array(
                '_root' => $this->rootCagetoryName,
                '_category' => $path,
                'description' => '',
                'is_active' => 'yes',
                'include_in_menu' => 'yes',
                'available_sort_by' => null,
                'default_sort_by' => null,
                'is_anchor' => 'yes',
            )));
            echo "DONE\n";
            $this->categoryPaths[] = $path;
        }
    }

    public function run()
    {
        try {
            $filename = $this->getFilename();
            $this->startTime = microtime(true);

            echo "Parsing Excel file [$filename] ... ";
            $objReader = PHPExcel_IOFactory::createReader( 'Excel2007' );
            $objReader->setReadDataOnly( true );
            $objPHPExcel = $objReader->load($filename);
            $this->done();

            $sheets = $objPHPExcel->getAllSheets();
            foreach ($sheets as $sheet) {
                try {
                    echo "Reading sheet [{$sheet->getTitle()}] ... \n";
                    /**  PHPExcel_Worksheet $sheet */
                    $data = $this->getProductData($sheet->toArray());
                    echo "\t";$this->done();

                    echo sprintf("\tTotal rows count: %s\n", count($data));
                    $this->import->setUseNestedArrays(true);
                    $this->import->processProductImport($data);
                    echo "\t" . $this->import->getEntityAdapter()->getProcessedRowsCount() . ' rows with ' . $this->import->getEntityAdapter()->getProcessedEntitiesCount() . ' entities have been imported successfully.';
                    $this->done();
                } catch (Exception $e) {
                    echo $e->getMessage();
                    echo "\n";
                }
            }

            echo "Reindexing multi-warehouse ... ";
            if ($indexer = Mage::getModel('index/indexer')->getProcessByCode('gaboli_warehouse')) {
                $indexer->reindexAll();
            }
            $this->done();
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "\n";
        }
    }

    protected function getProductData($rows)
    {
        $firstRow = $rows[0];
        if ($this->isConfigurable($firstRow)) {
            array_shift($rows); // Remove configurable indicator row
            array_shift($firstRow); // Remove first cell that contain 'configurable' text
            return $this->getConfigurableProducts($rows, $firstRow);
        } else {
            return $this->getSimpleProducts($rows);
        }
    }

    protected function getSimpleProducts($rows)
    {
        $data = array();
        $headers = $rows[0];
        $this->convertToAttributeCodes($headers);
        array_shift($rows);
        foreach ($rows as $row) {
            $product = $this->initDefaultValue('simple');

            foreach ($row as $i => $value)
            {
                if ($attrCode = $headers[$i]) {
                    $value = trim($value);
                    if ($attrCode == '_category') {
                        $value = trim($value, '/');
                        $this->validateCategory($value);
                    } else {
                        if ($attrCode == 'status') {
                            if (strtolower($value) == 'disabled') {
                                $value = Mage_Catalog_Model_Product_Status::STATUS_DISABLED;
                            } elseif (strtolower($value) == 'enabled') {
                                $value = Mage_Catalog_Model_Product_Status::STATUS_ENABLED;
                            }
                        }
                        $this->validateAttributeOption($attrCode, $value);
                    }
                    $product[$attrCode] = trim($value) ?: null;
                }
            }

            $product['description'] = $product['short_description'];
            $data[] = $product;
        }

        return $data;
    }

    protected function initDefaultValue($type)
    {
        return array(
            '_type' => $type,
            '_attribute_set' => 'ShelterLogic',
            '_product_websites' => self::WEBSITE_CODE,
            'price' => 1,
            'weight' => 1,
            'status' => 1,
            'visibility' => 4,
            'tax_class_id' => 2, // Taxable Goods
            'qty' => 1,
            'is_in_stock' => 1,
        );
    }

    protected function convertToAttributeCodes(&$headers)
    {
        foreach ($headers as $i => $name)
        {
            $name = trim(strtolower($name));
            if (isset($this->attributeCodes[$name])) {
                $headers[$i] = $this->attributeCodes[$name];
            } else {
                $headers[$i] = null;
            }
        }
    }

    protected function isConfigurable($firstRow)
    {
        if (strtolower($firstRow[0]) == 'configurable') {
            if (empty($firstRow[1])) {
                Mage::throwException("ERROR.\nConfigurable product must have a least one configurable attribute");
            }
            return true;
        }

        return false;
    }

    protected function getConfigurableProducts($rows, $firstRow)
    {
        $configurableAttrs = $this->validateConfigurableAttributes($firstRow);
        $simpleProducts = array();
        $confProducts = array();
        $attrOptions = array();
        $headers = $rows[0];
        $this->convertToAttributeCodes($headers);
        array_shift($rows);
        foreach ($rows as $row) {
            $parentSku = trim($row[0]);
            $product = array();
            if (empty($parentSku)) {
                $product = $this->initDefaultValue('configurable');
                if (isset($confProducts[$parentSku])) {
                    $product = array_merge_recursive($product, $confProducts[$parentSku]);
                }
            } else {
                $product = $this->initDefaultValue('simple');
                $product['visibility'] = 1; // Not visible individually
            }

            foreach ($row as $i => $value)
            {
                if ($attrCode = $headers[$i]) {
                    $value = trim($value);
                    if ($attrCode == '_category') {
                        $this->validateCategory($value);
                    } else {
                        $this->validateAttributeOption($attrCode, $value);
                    }

                    $product[$attrCode] = trim($value) ?: null;
                }
            }
            $product['description'] = $product['short_description'];

            if (!empty($parentSku)) {
                if (isset($confProducts[$parentSku])) {
                    $confProducts[$parentSku]['_super_products_sku'][] = $product['sku'];
                } else {
                    $confProducts[$parentSku]['_super_products_sku'] = array($product['sku']);
                }

                if (!isset($confProducts[$parentSku]['_super_attribute_code'])) {
                    $confProducts[$parentSku]['_super_attribute_code'] = array();
                }

                if (!isset($confProducts[$parentSku]['_super_attribute_option'])) {
                    $confProducts[$parentSku]['_super_attribute_option'] = array();
                }

                foreach ($configurableAttrs as $attr) {
                    if (!isset($attrOptions[$parentSku])) {
                        $attrOptions[$parentSku] = array();
                    }
                    if (!isset($attrOptions[$parentSku][$attr])) {
                        $attrOptions[$parentSku][$attr] = array();
                    }
                    if (!in_array($product[$attr], $attrOptions[$parentSku][$attr])) {
                        $confProducts[$parentSku]['_super_attribute_code'][] = $attr;
                        $confProducts[$parentSku]['_super_attribute_option'][] = $product[$attr];
                        $attrOptions[$parentSku][$attr][] = $product[$attr];
                    }
                }
                $simpleProducts[] = $product;
            } else {
                $confProducts[$product['sku']] = $product;
            }
        }

        return array_merge($simpleProducts, array_values($confProducts));
    }

    protected function validateConfigurableAttributes($firstRow)
    {
        $configurableAttrs = array();
        $unknownAttrs = array();
        foreach ($firstRow as $attr)
        {
            $attr = strtolower(trim($attr));
            if (empty($attr)) continue;
            if (isset($this->attributeCodes[$attr])) {
                $configurableAttrs[] = $this->attributeCodes[$attr];
            } else {
                $unknownAttrs[] = $attr;
            }
        }

        if (!empty($unknownAttrs)) {
            Mage::throwException(sprintf("Configurable attribute [%s] does not exist in import data", implode(',', $unknownAttrs)));
        } else {
            return $configurableAttrs;
        }
    }

    protected function done()
    {
        $time = microtime(true) - $this->startTime;
        echo sprintf('DONE. Elapsed time: %.2fs', $time);
        echo "\n";
        $this->startTime = microtime(true);
    }

    protected function getFilename()
    {
        if (!($filename = $this->getArg('file'))) {
            Mage::throwException($this->usageHelp());
        }

        if (!is_file($filename)) {
            Mage::throwException('File "' . $filename . '" does not exist.');
        }

        if (!is_readable($filename)) {
            Mage::throwException('File "' . $filename . '" is not readable.');
        }

        if (!filesize($filename)) {
            Mage::throwException('File "' . $filename . '" seems to be empty.');
        }

        return $filename;
    }

    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f import_product.php -- [options]
        php -f import_product.php -- --file ../var/import/product.xlsx

  --file <filename>             The relative or absolute filename
  help                          This help

USAGE;
    }

}

$shell = new ShelterLogic_Product_Import();
$shell->run();
