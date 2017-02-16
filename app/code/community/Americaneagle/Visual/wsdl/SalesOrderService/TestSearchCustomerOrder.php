<?php

namespace Visual\SalesOrderService;

class TestSearchCustomerOrder
{

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @var string $userName
     */
    protected $userName = null;

    /**
     * @var string $password
     */
    protected $password = null;

    /**
     * @var string $externalRefGroup
     */
    protected $externalRefGroup = null;

    /**
     * @var string $Site_ID
     */
    protected $Site_ID = null;

    /**
     * @var string $Use_Wildcards_BOOL
     */
    protected $Use_Wildcards_BOOL = null;

    /**
     * @var string $UD1_SearchTerm
     */
    protected $UD1_SearchTerm = null;

    /**
     * @var string $UD2_SearchTerm
     */
    protected $UD2_SearchTerm = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalRefGroup
     * @param string $Site_ID
     * @param string $Use_Wildcards_BOOL
     * @param string $UD1_SearchTerm
     * @param string $UD2_SearchTerm
     */
    public function __construct($key, $userName, $password, $externalRefGroup, $Site_ID, $Use_Wildcards_BOOL, $UD1_SearchTerm, $UD2_SearchTerm)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
      $this->Site_ID = $Site_ID;
      $this->Use_Wildcards_BOOL = $Use_Wildcards_BOOL;
      $this->UD1_SearchTerm = $UD1_SearchTerm;
      $this->UD2_SearchTerm = $UD2_SearchTerm;
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
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
      return $this->userName;
    }

    /**
     * @param string $userName
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setUserName($userName)
    {
      $this->userName = $userName;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->password;
    }

    /**
     * @param string $password
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalRefGroup()
    {
      return $this->externalRefGroup;
    }

    /**
     * @param string $externalRefGroup
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
    }

    /**
     * @return string
     */
    public function getSite_ID()
    {
      return $this->Site_ID;
    }

    /**
     * @param string $Site_ID
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setSite_ID($Site_ID)
    {
      $this->Site_ID = $Site_ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getUse_Wildcards_BOOL()
    {
      return $this->Use_Wildcards_BOOL;
    }

    /**
     * @param string $Use_Wildcards_BOOL
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setUse_Wildcards_BOOL($Use_Wildcards_BOOL)
    {
      $this->Use_Wildcards_BOOL = $Use_Wildcards_BOOL;
      return $this;
    }

    /**
     * @return string
     */
    public function getUD1_SearchTerm()
    {
      return $this->UD1_SearchTerm;
    }

    /**
     * @param string $UD1_SearchTerm
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setUD1_SearchTerm($UD1_SearchTerm)
    {
      $this->UD1_SearchTerm = $UD1_SearchTerm;
      return $this;
    }

    /**
     * @return string
     */
    public function getUD2_SearchTerm()
    {
      return $this->UD2_SearchTerm;
    }

    /**
     * @param string $UD2_SearchTerm
     * @return \Visual\SalesOrderService\TestSearchCustomerOrder
     */
    public function setUD2_SearchTerm($UD2_SearchTerm)
    {
      $this->UD2_SearchTerm = $UD2_SearchTerm;
      return $this;
    }

}
