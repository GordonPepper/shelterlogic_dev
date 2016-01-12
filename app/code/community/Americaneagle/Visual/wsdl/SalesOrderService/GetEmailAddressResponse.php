<?php

namespace Visual\SalesOrderService;

class GetEmailAddressResponse
{

    /**
     * @var string $GetEmailAddressResult
     */
    protected $GetEmailAddressResult = null;

    /**
     * @param string $GetEmailAddressResult
     */
    public function __construct($GetEmailAddressResult)
    {
      $this->GetEmailAddressResult = $GetEmailAddressResult;
    }

    /**
     * @return string
     */
    public function getGetEmailAddressResult()
    {
      return $this->GetEmailAddressResult;
    }

    /**
     * @param string $GetEmailAddressResult
     * @return \Visual\SalesOrderService\GetEmailAddressResponse
     */
    public function setGetEmailAddressResult($GetEmailAddressResult)
    {
      $this->GetEmailAddressResult = $GetEmailAddressResult;
      return $this;
    }

}
