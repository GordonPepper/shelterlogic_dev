<?php

namespace Visual\SalesOrderService;

class UserPermissionResponse
{

    /**
     * @var UserPermissionEnum $UserPermissionResult
     */
    protected $UserPermissionResult = null;

    /**
     * @param UserPermissionEnum $UserPermissionResult
     */
    public function __construct($UserPermissionResult)
    {
      $this->UserPermissionResult = $UserPermissionResult;
    }

    /**
     * @return UserPermissionEnum
     */
    public function getUserPermissionResult()
    {
      return $this->UserPermissionResult;
    }

    /**
     * @param UserPermissionEnum $UserPermissionResult
     * @return \Visual\SalesOrderService\UserPermissionResponse
     */
    public function setUserPermissionResult($UserPermissionResult)
    {
      $this->UserPermissionResult = $UserPermissionResult;
      return $this;
    }

}
