<?php

namespace Visual\CustomerService;

class LookupNameByIDResponse
{

    /**
     * @var string $LookupNameByIDResult
     */
    protected $LookupNameByIDResult = null;

    /**
     * @param string $LookupNameByIDResult
     */
    public function __construct($LookupNameByIDResult)
    {
      $this->LookupNameByIDResult = $LookupNameByIDResult;
    }

    /**
     * @return string
     */
    public function getLookupNameByIDResult()
    {
      return $this->LookupNameByIDResult;
    }

    /**
     * @param string $LookupNameByIDResult
     * @return \Visual\CustomerService\LookupNameByIDResponse
     */
    public function setLookupNameByIDResult($LookupNameByIDResult)
    {
      $this->LookupNameByIDResult = $LookupNameByIDResult;
      return $this;
    }

}
