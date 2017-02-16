<?php

namespace Visual\UserDefinedFieldService;

class SaveUserDefined2
{

    /**
     * @var UserDefinedData $data
     */
    protected $data = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @param UserDefinedData $data
     * @param string $key
     */
    public function __construct($data, $key)
    {
      $this->data = $data;
      $this->key = $key;
    }

    /**
     * @return UserDefinedData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param UserDefinedData $data
     * @return \Visual\UserDefinedFieldService\SaveUserDefined2
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
     * @return \Visual\UserDefinedFieldService\SaveUserDefined2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
