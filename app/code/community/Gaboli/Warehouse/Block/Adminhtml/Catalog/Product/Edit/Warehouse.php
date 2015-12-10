<?php

/**
 * Class Gaboli_Warehouse_Block_Adminhtml_Catalog_Product_Edit_Warehouse
 */
class Gaboli_Warehouse_Block_Adminhtml_Catalog_Product_Edit_Warehouse
    extends Mage_Adminhtml_Block_Widget
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * @var array Inventory for each location.
     */
    private $locations = array();

    /**
     * @var float Total quantity within the current scope.
     */
    private $scopeInventory = 0.0;

    /**
     * @var float Total quantity available for this product globally.
     */
    private $globalInventory = 0.0;

    /**
     * Init the tab and set it's template
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('gaboli/catalog_warehouse.phtml');
        $this->loadLocationsInventoriesData();
        $this->loadGlobalInventory($this->getProductId());
    }

    /**
     * Returns the product id.
     *
     * @return int
     */
    protected function getProductId()
    {
        return Mage::app()->getRequest()->getParam('id');
    }

    /**
     * Returns the current store view id or NULL.
     *
     * @return int
     */
    protected function getStoreViewId()
    {
        return Mage::app()->getRequest()->getParam('store');
    }

    /**
     * Returns the tab's label.
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Warehouse Inventory');
    }

    /**
     * Returns the tab's title.
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Warehouse Inventory');
    }

    /**
     * Returns true/false if the tab can or can't be displayed.
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns true/false if that tab should be hidden.
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }


    /**
     * Get stock details for each location.
     *
     * @return array
     */
    public function getLocationsInventories()
    {
        return $this->locations;
    }

    /**
     * Get inventory within the current store view scope.
     *
     * @return array
     */
    public function getScopeInventory()
    {
        return $this->scopeInventory;
    }

    /**
     * Get global inventory.
     *
     * @return array
     */
    public function getGlobalInventory()
    {
        return $this->globalInventory;
    }

    /**
     * Load stock details for each location.
     */
    private function loadLocationsInventoriesData()
    {
        $productId   = $this->getProductId();
        $storeViewId = $this->getStoreViewId();

        $locationStockCollection = Mage::getModel('gaboli_warehouse/location')
            ->getCollection()
            ->joinStockDataOnProductAndStoreView($productId, $storeViewId);

        $locations = array();
        foreach ($locationStockCollection as $locationStock) {
            $locationStock->setQty(floatval($locationStock->getQty()));
            $this->scopeInventory += $locationStock->getQty();
            array_push($locations, $locationStock->toArray());
        }

        $this->locations = $locations;
    }

    /**
     * Load global inventory.
     */
    private function loadGlobalInventory($productId)
    {
        $this->globalInventory = Mage::getModel('gaboli_warehouse/stock')->getGlobalInventory($productId);
    }

    /**
     * @return mixed
     */
    public function isReadonly()
    {
        return Mage::registry('product')->getInventoryReadonly();
    }
    public function isNew()
    {
        if (Mage::registry('product')->getId()) {
            return false;
        }
        return true;
    }
    public function getConfigFieldValue($field)
    {
        if (Mage::registry('product')->getStockItem()) {
            if (Mage::registry('product')->getStockItem()->getData('use_config_' . $field) == 0) {
                return Mage::registry('product')->getStockItem()->getData($field);
            }
        }

        return Mage::getStoreConfig(Mage_CatalogInventory_Model_Stock_Item::XML_PATH_ITEM . $field);
    }
    public function getFieldValue($field)
    {
        if (Mage::registry('product')->getStockItem()) {
            return Mage::registry('product')->getStockItem()->getDataUsingMethod($field);
        }

        return Mage::getStoreConfig(Mage_CatalogInventory_Model_Stock_Item::XML_PATH_ITEM . $field);
    }


}
