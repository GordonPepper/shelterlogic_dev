<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLabelResponse
{

    /**
     * @var UDFDataResponse $SearchUserDefinedLabelResult
     */
    protected $SearchUserDefinedLabelResult = null;

    /**
     * @param UDFDataResponse $SearchUserDefinedLabelResult
     */
    public function __construct($SearchUserDefinedLabelResult)
    {
      $this->SearchUserDefinedLabelResult = $SearchUserDefinedLabelResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getSearchUserDefinedLabelResult()
    {
      return $this->SearchUserDefinedLabelResult;
    }

    /**
     * @param UDFDataResponse $SearchUserDefinedLabelResult
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLabelResponse
     */
    public function setSearchUserDefinedLabelResult($SearchUserDefinedLabelResult)
    {
      $this->SearchUserDefinedLabelResult = $SearchUserDefinedLabelResult;
      return $this;
    }

}
