<?php

namespace Visual\NotationService;

class LoadNotation
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
     * @return \Visual\NotationService\LoadNotation
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
