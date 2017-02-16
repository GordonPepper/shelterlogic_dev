<?php

namespace Visual\SalesOrderService;

class GetEmailAddress2Response
{

    /**
     * @var string $GetEmailAddress2Result
     */
    protected $GetEmailAddress2Result = null;

    /**
     * @param string $GetEmailAddress2Result
     */
    public function __construct($GetEmailAddress2Result)
    {
      $this->GetEmailAddress2Result = $GetEmailAddress2Result;
    }

    /**
     * @return string
     */
    public function getGetEmailAddress2Result()
    {
      return $this->GetEmailAddress2Result;
    }

    /**
     * @param string $GetEmailAddress2Result
     * @return \Visual\SalesOrderService\GetEmailAddress2Response
     */
    public function setGetEmailAddress2Result($GetEmailAddress2Result)
    {
      $this->GetEmailAddress2Result = $GetEmailAddress2Result;
      return $this;
    }

}
