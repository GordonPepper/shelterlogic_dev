<?php
/**
 * Created by PhpStorm.
 * User: Levente Albert
 * Date: 11/25/15
 * Time: 11:25 AM
 */
require('Americaneagle/Visual/wsdl/InventoryService/autoload.php');

use Visual\InventoryService as InventoryService;

class Americaneagle_Visual_Helper_Inventory extends Americaneagle_Visual_Helper_Visual
{
    /** @var Visual\InventoryService\InventoryService $inventoryService*/
    private $inventoryService;

    public function __construct()
    {
        parent::__construct();
        $this->inventoryService = new InventoryService\InventoryService($this->getOptions());
        $this->inventoryService->__setSoapHeaders($this->getHeader());
    }

    /**
     * @param $start
     * @param $count
     * @return null|InventoryService\PartDataResponse
     * @throws Exception
     */
    public function getProducts($start, $count)
    {
        try {
            $params = new InventoryService\GetPartList($this->getConfig()->getSiteId(), "N", $start, $count, null, null);

            $res = $this->inventoryService->GetPartList($params)->getGetPartListResult();
            $this->soapLog($this->inventoryService, 'InventoryService:GetPartList', sprintf('Parts List, SiteID: %s, Start: %d, Count: %d', $this->getConfig()->getSiteId(), $start, $count));

            return $res;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->inventoryService) ? $this->inventoryService : null, 'InventoryService:GetPartList', sprintf('Exception: %s', $e->getMessage()));
            throw $e;
        }

        return null;
    }
    public function resetHeader()
    {
        $this->inventoryService->__setSoapHeaders($this->getHeader());
    }
}