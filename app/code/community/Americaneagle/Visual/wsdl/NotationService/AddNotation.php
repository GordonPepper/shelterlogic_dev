<?php

namespace Visual\NotationService;

class AddNotation
{

    /**
     * @var NotationData $data
     */
    protected $data = null;

    /**
     * @param NotationData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return NotationData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param NotationData $data
     * @return \Visual\NotationService\AddNotation
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
