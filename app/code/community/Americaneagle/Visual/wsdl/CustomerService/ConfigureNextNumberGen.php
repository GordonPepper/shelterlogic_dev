<?php

namespace Visual\CustomerService;

class ConfigureNextNumberGen
{

    /**
     * @var string $alphaPrefix
     */
    protected $alphaPrefix = null;

    /**
     * @var float $nextNumber
     */
    protected $nextNumber = null;

    /**
     * @var float $decimalPlaces
     */
    protected $decimalPlaces = null;

    /**
     * @var string $leadingZeros_Y_or_N
     */
    protected $leadingZeros_Y_or_N = null;

    /**
     * @var string $siteID
     */
    protected $siteID = null;

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
     * @param string $alphaPrefix
     * @param float $nextNumber
     * @param float $decimalPlaces
     * @param string $leadingZeros_Y_or_N
     * @param string $siteID
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($alphaPrefix, $nextNumber, $decimalPlaces, $leadingZeros_Y_or_N, $siteID, $key, $userName, $password)
    {
      $this->alphaPrefix = $alphaPrefix;
      $this->nextNumber = $nextNumber;
      $this->decimalPlaces = $decimalPlaces;
      $this->leadingZeros_Y_or_N = $leadingZeros_Y_or_N;
      $this->siteID = $siteID;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAlphaPrefix()
    {
      return $this->alphaPrefix;
    }

    /**
     * @param string $alphaPrefix
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setAlphaPrefix($alphaPrefix)
    {
      $this->alphaPrefix = $alphaPrefix;
      return $this;
    }

    /**
     * @return float
     */
    public function getNextNumber()
    {
      return $this->nextNumber;
    }

    /**
     * @param float $nextNumber
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setNextNumber($nextNumber)
    {
      $this->nextNumber = $nextNumber;
      return $this;
    }

    /**
     * @return float
     */
    public function getDecimalPlaces()
    {
      return $this->decimalPlaces;
    }

    /**
     * @param float $decimalPlaces
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setDecimalPlaces($decimalPlaces)
    {
      $this->decimalPlaces = $decimalPlaces;
      return $this;
    }

    /**
     * @return string
     */
    public function getLeadingZeros_Y_or_N()
    {
      return $this->leadingZeros_Y_or_N;
    }

    /**
     * @param string $leadingZeros_Y_or_N
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setLeadingZeros_Y_or_N($leadingZeros_Y_or_N)
    {
      $this->leadingZeros_Y_or_N = $leadingZeros_Y_or_N;
      return $this;
    }

    /**
     * @return string
     */
    public function getSiteID()
    {
      return $this->siteID;
    }

    /**
     * @param string $siteID
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setSiteID($siteID)
    {
      $this->siteID = $siteID;
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
     * @return \Visual\CustomerService\ConfigureNextNumberGen
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
     * @return \Visual\CustomerService\ConfigureNextNumberGen
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
     * @return \Visual\CustomerService\ConfigureNextNumberGen
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
