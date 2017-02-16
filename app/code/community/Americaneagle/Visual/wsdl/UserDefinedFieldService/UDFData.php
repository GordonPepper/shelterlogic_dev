<?php

namespace Visual\UserDefinedFieldService;

class UDFData extends BaseDataRequest
{

    /**
     * @var ArrayOfUDFValue $UDFValueList
     */
    protected $UDFValueList = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return ArrayOfUDFValue
     */
    public function getUDFValueList()
    {
      return $this->UDFValueList;
    }

    /**
     * @param ArrayOfUDFValue $UDFValueList
     * @return \Visual\UserDefinedFieldService\UDFData
     */
    public function setUDFValueList($UDFValueList)
    {
      $this->UDFValueList = $UDFValueList;
      return $this;
    }

}
