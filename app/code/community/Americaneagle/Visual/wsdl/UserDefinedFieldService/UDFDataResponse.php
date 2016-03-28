<?php

namespace Visual\UserDefinedFieldService;

class UDFDataResponse extends BaseDataResponse
{

    /**
     * @var ArrayOfUDFValueResponse $UDFValues
     */
    protected $UDFValues = null;

    /**
     * @var ArrayOfUDFLabelResponse $UDFLabels
     */
    protected $UDFLabels = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime)
    {
      parent::__construct($HasErrors, $SubmitDateTime, $ResponseDateTime);
    }

    /**
     * @return ArrayOfUDFValueResponse
     */
    public function getUDFValues()
    {
      return $this->UDFValues;
    }

    /**
     * @param ArrayOfUDFValueResponse $UDFValues
     * @return \Visual\UserDefinedFieldService\UDFDataResponse
     */
    public function setUDFValues($UDFValues)
    {
      $this->UDFValues = $UDFValues;
      return $this;
    }

    /**
     * @return ArrayOfUDFLabelResponse
     */
    public function getUDFLabels()
    {
      return $this->UDFLabels;
    }

    /**
     * @param ArrayOfUDFLabelResponse $UDFLabels
     * @return \Visual\UserDefinedFieldService\UDFDataResponse
     */
    public function setUDFLabels($UDFLabels)
    {
      $this->UDFLabels = $UDFLabels;
      return $this;
    }

}
