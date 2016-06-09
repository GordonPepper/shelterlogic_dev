<?php

namespace Visual\NotationService;

class SampleNotationResponse
{

    /**
     * @var NotationData $SampleNotationResult
     */
    protected $SampleNotationResult = null;

    /**
     * @param NotationData $SampleNotationResult
     */
    public function __construct($SampleNotationResult)
    {
      $this->SampleNotationResult = $SampleNotationResult;
    }

    /**
     * @return NotationData
     */
    public function getSampleNotationResult()
    {
      return $this->SampleNotationResult;
    }

    /**
     * @param NotationData $SampleNotationResult
     * @return \Visual\NotationService\SampleNotationResponse
     */
    public function setSampleNotationResult($SampleNotationResult)
    {
      $this->SampleNotationResult = $SampleNotationResult;
      return $this;
    }

}
