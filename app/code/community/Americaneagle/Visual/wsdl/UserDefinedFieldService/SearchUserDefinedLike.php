<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLike
{

    /**
     * @var UDFData $data
     */
    protected $data = null;

    /**
     * @param UDFData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return UDFData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param UDFData $data
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLike
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
