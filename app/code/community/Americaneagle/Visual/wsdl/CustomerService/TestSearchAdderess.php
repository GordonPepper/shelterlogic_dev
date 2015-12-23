<?php

namespace Visual\CustomerService;

class TestSearchAdderess
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
     * @var string $customerID
     */
    protected $customerID = null;

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
     * @param string $customerID
     * @param string $Use_Wildcards_BOOL
     * @param string $UD1_SearchTerm
     * @param string $UD2_SearchTerm
     */
    public function __construct($key, $userName, $password, $externalRefGroup, $customerID, $Use_Wildcards_BOOL, $UD1_SearchTerm, $UD2_SearchTerm)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
      $this->customerID = $customerID;
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
     * @return \Visual\CustomerService\TestSearchAdderess
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
     * @return \Visual\CustomerService\TestSearchAdderess
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
     * @return \Visual\CustomerService\TestSearchAdderess
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
     * @return \Visual\CustomerService\TestSearchAdderess
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->customerID;
    }

    /**
     * @param string $customerID
     * @return \Visual\CustomerService\TestSearchAdderess
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
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
     * @return \Visual\CustomerService\TestSearchAdderess
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
     * @return \Visual\CustomerService\TestSearchAdderess
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
     * @return \Visual\CustomerService\TestSearchAdderess
     */
    public function setUD2_SearchTerm($UD2_SearchTerm)
    {
      $this->UD2_SearchTerm = $UD2_SearchTerm;
      return $this;
    }

}
