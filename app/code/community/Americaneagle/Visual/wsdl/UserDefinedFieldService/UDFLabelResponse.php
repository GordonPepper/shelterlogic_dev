<?php

namespace Visual\UserDefinedFieldService;

class UDFLabelResponse extends BaseObjectResponse
{

    /**
     * @var UDFLabel $UDFLabel
     */
    protected $UDFLabel = null;

    /**
     * @param boolean $HasErrors
     */
    public function __construct($HasErrors)
    {
      parent::__construct($HasErrors);
    }

    /**
     * @return UDFLabel
     */
    public function getUDFLabel()
    {
      return $this->UDFLabel;
    }

    /**
     * @param UDFLabel $UDFLabel
     * @return \Visual\UserDefinedFieldService\UDFLabelResponse
     */
    public function setUDFLabel($UDFLabel)
    {
      $this->UDFLabel = $UDFLabel;
      return $this;
    }

}
