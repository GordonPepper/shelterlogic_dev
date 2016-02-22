<?php

namespace Visual\InventoryService;

class UserPermission
{

    /**
     * @var string $programID
     */
    protected $programID = null;

    /**
     * @param string $programID
     */
    public function __construct($programID)
    {
      $this->programID = $programID;
    }

    /**
     * @return string
     */
    public function getProgramID()
    {
      return $this->programID;
    }

    /**
     * @param string $programID
     * @return \Visual\InventoryService\UserPermission
     */
    public function setProgramID($programID)
    {
      $this->programID = $programID;
      return $this;
    }

}
