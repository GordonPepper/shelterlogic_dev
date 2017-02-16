<?php

namespace Visual\NotationService;

class NextNumberGen2
{

    /**
     * @var string $tableName
     */
    protected $tableName = null;

    /**
     * @var string $fieldName
     */
    protected $fieldName = null;

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
     * @var string $siteID
     */
    protected $siteID = null;

    /**
     * @param string $tableName
     * @param string $fieldName
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $siteID
     */
    public function __construct($tableName, $fieldName, $key, $userName, $password, $siteID)
    {
      $this->tableName = $tableName;
      $this->fieldName = $fieldName;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->siteID = $siteID;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
      return $this->tableName;
    }

    /**
     * @param string $tableName
     * @return \Visual\NotationService\NextNumberGen2
     */
    public function setTableName($tableName)
    {
      $this->tableName = $tableName;
      return $this;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
      return $this->fieldName;
    }

    /**
     * @param string $fieldName
     * @return \Visual\NotationService\NextNumberGen2
     */
    public function setFieldName($fieldName)
    {
      $this->fieldName = $fieldName;
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
     * @return \Visual\NotationService\NextNumberGen2
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
     * @return \Visual\NotationService\NextNumberGen2
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
     * @return \Visual\NotationService\NextNumberGen2
     */
    public function setPassword($password)
    {
      $this->password = $password;
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
     * @return \Visual\NotationService\NextNumberGen2
     */
    public function setSiteID($siteID)
    {
      $this->siteID = $siteID;
      return $this;
    }

}
