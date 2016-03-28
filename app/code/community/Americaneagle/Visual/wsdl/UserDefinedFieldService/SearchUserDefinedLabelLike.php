<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLabelLike
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
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLabelLike
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
