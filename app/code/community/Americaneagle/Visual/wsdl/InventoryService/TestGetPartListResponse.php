<?php

namespace Visual\InventoryService;

class TestGetPartListResponse
{

    /**
     * @var PartDataResponse $TestGetPartListResult
     */
    protected $TestGetPartListResult = null;

    /**
     * @param PartDataResponse $TestGetPartListResult
     */
    public function __construct($TestGetPartListResult)
    {
      $this->TestGetPartListResult = $TestGetPartListResult;
    }

    /**
     * @return PartDataResponse
     */
    public function getTestGetPartListResult()
    {
      return $this->TestGetPartListResult;
    }

    /**
     * @param PartDataResponse $TestGetPartListResult
     * @return \Visual\InventoryService\TestGetPartListResponse
     */
    public function setTestGetPartListResult($TestGetPartListResult)
    {
      $this->TestGetPartListResult = $TestGetPartListResult;
      return $this;
    }

}
