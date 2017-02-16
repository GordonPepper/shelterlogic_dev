<?php

namespace Visual\InventoryService;

class GetPartListResponse
{

    /**
     * @var PartDataResponse $GetPartListResult
     */
    protected $GetPartListResult = null;

    /**
     * @param PartDataResponse $GetPartListResult
     */
    public function __construct($GetPartListResult)
    {
      $this->GetPartListResult = $GetPartListResult;
    }

    /**
     * @return PartDataResponse
     */
    public function getGetPartListResult()
    {
      return $this->GetPartListResult;
    }

    /**
     * @param PartDataResponse $GetPartListResult
     * @return \Visual\InventoryService\GetPartListResponse
     */
    public function setGetPartListResult($GetPartListResult)
    {
      $this->GetPartListResult = $GetPartListResult;
      return $this;
    }

}
