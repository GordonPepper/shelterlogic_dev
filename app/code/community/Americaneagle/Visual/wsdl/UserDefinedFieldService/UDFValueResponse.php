<?php

namespace Visual\UserDefinedFieldService;

class UDFValueResponse extends BaseObjectResponse
{

    /**
     * @var UDFValue $UDFValue
     */
    protected $UDFValue = null;

    /**
     * @param boolean $HasErrors
     */
    public function __construct($HasErrors)
    {
      parent::__construct($HasErrors);
    }

    /**
     * @return UDFValue
     */
    public function getUDFValue()
    {
      return $this->UDFValue;
    }

    /**
     * @param UDFValue $UDFValue
     * @return \Visual\UserDefinedFieldService\UDFValueResponse
     */
    public function setUDFValue($UDFValue)
    {
      $this->UDFValue = $UDFValue;
      return $this;
    }

}
