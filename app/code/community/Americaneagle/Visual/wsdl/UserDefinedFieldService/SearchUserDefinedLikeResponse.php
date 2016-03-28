<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLikeResponse
{

    /**
     * @var UDFDataResponse $SearchUserDefinedLikeResult
     */
    protected $SearchUserDefinedLikeResult = null;

    /**
     * @param UDFDataResponse $SearchUserDefinedLikeResult
     */
    public function __construct($SearchUserDefinedLikeResult)
    {
      $this->SearchUserDefinedLikeResult = $SearchUserDefinedLikeResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getSearchUserDefinedLikeResult()
    {
      return $this->SearchUserDefinedLikeResult;
    }

    /**
     * @param UDFDataResponse $SearchUserDefinedLikeResult
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLikeResponse
     */
    public function setSearchUserDefinedLikeResult($SearchUserDefinedLikeResult)
    {
      $this->SearchUserDefinedLikeResult = $SearchUserDefinedLikeResult;
      return $this;
    }

}
