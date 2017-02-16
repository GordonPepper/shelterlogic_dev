<?php

namespace Visual\InventoryService;

class GetPartBySKUResponse
{

    /**
     * @var string $GetPartBySKUResult
     */
    protected $GetPartBySKUResult = null;

    /**
     * @param string $GetPartBySKUResult
     */
    public function __construct($GetPartBySKUResult)
    {
      $this->GetPartBySKUResult = $GetPartBySKUResult;
    }

    /**
     * @return string
     */
    public function getGetPartBySKUResult()
    {
      return $this->GetPartBySKUResult;
    }

    /**
     * @param string $GetPartBySKUResult
     * @return \Visual\InventoryService\GetPartBySKUResponse
     */
    public function setGetPartBySKUResult($GetPartBySKUResult)
    {
      $this->GetPartBySKUResult = $GetPartBySKUResult;
      return $this;
    }

}
