<?php

namespace Visual\NotationService;

class LoadNotation2
{

    /**
     * @var NotationData $data
     */
    protected $data = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @param NotationData $data
     * @param string $key
     */
    public function __construct($data, $key)
    {
      $this->data = $data;
      $this->key = $key;
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
     * @return \Visual\NotationService\LoadNotation2
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\NotationService\LoadNotation2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
