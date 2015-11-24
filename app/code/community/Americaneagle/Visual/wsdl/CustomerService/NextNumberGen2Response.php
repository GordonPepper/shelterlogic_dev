<?php

namespace Visual\CustomerService;

class NextNumberGen2Response
{

    /**
     * @var string $NextNumberGen2Result
     */
    protected $NextNumberGen2Result = null;

    /**
     * @param string $NextNumberGen2Result
     */
    public function __construct($NextNumberGen2Result)
    {
      $this->NextNumberGen2Result = $NextNumberGen2Result;
    }

    /**
     * @return string
     */
    public function getNextNumberGen2Result()
    {
      return $this->NextNumberGen2Result;
    }

    /**
     * @param string $NextNumberGen2Result
     * @return \Visual\CustomerService\NextNumberGen2Response
     */
    public function setNextNumberGen2Result($NextNumberGen2Result)
    {
      $this->NextNumberGen2Result = $NextNumberGen2Result;
      return $this;
    }

}
