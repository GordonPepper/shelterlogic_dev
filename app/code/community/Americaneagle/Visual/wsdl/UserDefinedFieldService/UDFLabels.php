<?php

namespace Visual\UserDefinedFieldService;

class UDFLabels extends BaseDataRequest
{

    /**
     * @var ArrayOfUDFLabel $UDFLabelList
     */
    protected $UDFLabelList = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return ArrayOfUDFLabel
     */
    public function getUDFLabelList()
    {
      return $this->UDFLabelList;
    }

    /**
     * @param ArrayOfUDFLabel $UDFLabelList
     * @return \Visual\UserDefinedFieldService\UDFLabels
     */
    public function setUDFLabelList($UDFLabelList)
    {
      $this->UDFLabelList = $UDFLabelList;
      return $this;
    }

}
