<?php

namespace Visual\CustomerService;

class LookupNameByID
{

    /**
     * @var string $id
     */
    protected $id = null;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
      $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * @param string $id
     * @return \Visual\CustomerService\LookupNameByID
     */
    public function setId($id)
    {
      $this->id = $id;
      return $this;
    }

}
