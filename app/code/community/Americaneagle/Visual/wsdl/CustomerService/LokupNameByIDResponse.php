<?php

namespace Visual\CustomerService;

class LokupNameByIDResponse
{

    /**
     * @var string $LokupNameByIDResult
     */
    protected $LokupNameByIDResult = null;

    /**
     * @param string $LokupNameByIDResult
     */
    public function __construct($LokupNameByIDResult)
    {
      $this->LokupNameByIDResult = $LokupNameByIDResult;
    }

    /**
     * @return string
     */
    public function getLokupNameByIDResult()
    {
      return $this->LokupNameByIDResult;
    }

    /**
     * @param string $LokupNameByIDResult
     * @return \Visual\CustomerService\LokupNameByIDResponse
     */
    public function setLokupNameByIDResult($LokupNameByIDResult)
    {
      $this->LokupNameByIDResult = $LokupNameByIDResult;
      return $this;
    }

}
