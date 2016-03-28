<?php

namespace Visual\UserDefinedFieldService;

class SaveUserDefined
{

    /**
     * @var UserDefinedData $data
     */
    protected $data = null;

    /**
     * @param UserDefinedData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
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
     * @return \Visual\UserDefinedFieldService\SaveUserDefined
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
