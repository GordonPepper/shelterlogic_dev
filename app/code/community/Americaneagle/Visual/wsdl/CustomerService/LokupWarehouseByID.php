<?php

namespace Visual\CustomerService;

class LokupWarehouseByID
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
     * @return \Visual\CustomerService\LokupWarehouseByID
     */
    public function setId($id)
    {
      $this->id = $id;
      return $this;
    }

}
