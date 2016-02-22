<?php

namespace Visual\SalesOrderService;

class ArrayOfUDFValue
{

    /**
     * @var UDFValue[] $UDFValue
     */
    protected $UDFValue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UDFValue[]
     */
    public function getUDFValue()
    {
      return $this->UDFValue;
    }

    /**
     * @param UDFValue[] $UDFValue
     * @return \Visual\SalesOrderService\ArrayOfUDFValue
     */
    public function setUDFValue(array $UDFValue = null)
    {
      $this->UDFValue = $UDFValue;
      return $this;
    }

}
