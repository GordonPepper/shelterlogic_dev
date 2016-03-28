<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedResponse
{

    /**
     * @var UDFDataResponse $SearchUserDefinedResult
     */
    protected $SearchUserDefinedResult = null;

    /**
     * @param UDFDataResponse $SearchUserDefinedResult
     */
    public function __construct($SearchUserDefinedResult)
    {
      $this->SearchUserDefinedResult = $SearchUserDefinedResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getSearchUserDefinedResult()
    {
      return $this->SearchUserDefinedResult;
    }

    /**
     * @param UDFDataResponse $SearchUserDefinedResult
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedResponse
     */
    public function setSearchUserDefinedResult($SearchUserDefinedResult)
    {
      $this->SearchUserDefinedResult = $SearchUserDefinedResult;
      return $this;
    }

}
