<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLabel
{

    /**
     * @var UDFLabels $data
     */
    protected $data = null;

    /**
     * @param UDFLabels $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return UDFLabels
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param UDFLabels $data
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLabel
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
