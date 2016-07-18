<?php

namespace Visual\NotationService;

class NextNumberGenAppenditure
{

    /**
     * @var string $prefix
     */
    protected $prefix = null;

    /**
     * @var string $tableName
     */
    protected $tableName = null;

    /**
     * @var string $fieldName
     */
    protected $fieldName = null;

    /**
     * @var string $suffix
     */
    protected $suffix = null;

    /**
     * @var string $siteID
     */
    protected $siteID = null;

    /**
     * @param string $prefix
     * @param string $tableName
     * @param string $fieldName
     * @param string $suffix
     * @param string $siteID
     */
    public function __construct($prefix, $tableName, $fieldName, $suffix, $siteID)
    {
      $this->prefix = $prefix;
      $this->tableName = $tableName;
      $this->fieldName = $fieldName;
      $this->suffix = $suffix;
      $this->siteID = $siteID;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
      return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return \Visual\NotationService\NextNumberGenAppenditure
     */
    public function setPrefix($prefix)
    {
      $this->prefix = $prefix;
      return $this;
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
     * @return \Visual\NotationService\NextNumberGenAppenditure
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
     * @return \Visual\NotationService\NextNumberGenAppenditure
     */
    public function setFieldName($fieldName)
    {
      $this->fieldName = $fieldName;
      return $this;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
      return $this->suffix;
    }

    /**
     * @param string $suffix
     * @return \Visual\NotationService\NextNumberGenAppenditure
     */
    public function setSuffix($suffix)
    {
      $this->suffix = $suffix;
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
     * @return \Visual\NotationService\NextNumberGenAppenditure
     */
    public function setSiteID($siteID)
    {
      $this->siteID = $siteID;
      return $this;
    }

}
