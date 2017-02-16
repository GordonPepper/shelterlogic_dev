<?php

namespace Visual\UserDefinedFieldService;

class SearchUserDefinedLabelLikeResponse
{

    /**
     * @var UDFDataResponse $SearchUserDefinedLabelLikeResult
     */
    protected $SearchUserDefinedLabelLikeResult = null;

    /**
     * @param UDFDataResponse $SearchUserDefinedLabelLikeResult
     */
    public function __construct($SearchUserDefinedLabelLikeResult)
    {
      $this->SearchUserDefinedLabelLikeResult = $SearchUserDefinedLabelLikeResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getSearchUserDefinedLabelLikeResult()
    {
      return $this->SearchUserDefinedLabelLikeResult;
    }

    /**
     * @param UDFDataResponse $SearchUserDefinedLabelLikeResult
     * @return \Visual\UserDefinedFieldService\SearchUserDefinedLabelLikeResponse
     */
    public function setSearchUserDefinedLabelLikeResult($SearchUserDefinedLabelLikeResult)
    {
      $this->SearchUserDefinedLabelLikeResult = $SearchUserDefinedLabelLikeResult;
      return $this;
    }

}
