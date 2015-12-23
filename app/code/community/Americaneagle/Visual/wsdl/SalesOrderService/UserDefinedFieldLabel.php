<?php

namespace Visual\SalesOrderService;

class UserDefinedFieldLabel
{

    /**
     * @var string $ProgramID
     */
    protected $ProgramID = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var float $DataType
     */
    protected $DataType = null;

    /**
     * @var string $DisplayFormat
     */
    protected $DisplayFormat = null;

    /**
     * @var TabOrTableEnum $TabOrTable
     */
    protected $TabOrTable = null;

    /**
     * @var string $TabOrTableID
     */
    protected $TabOrTableID = null;

    /**
     * @param TabOrTableEnum $TabOrTable
     */
    public function __construct($TabOrTable)
    {
      $this->TabOrTable = $TabOrTable;
    }

    /**
     * @return string
     */
    public function getProgramID()
    {
      return $this->ProgramID;
    }

    /**
     * @param string $ProgramID
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setProgramID($ProgramID)
    {
      $this->ProgramID = $ProgramID;
      return $this;
    }

    /**
     * @return string
     */
    public function getID()
    {
      return $this->ID;
    }

    /**
     * @param string $ID
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
      return $this->Label;
    }

    /**
     * @param string $Label
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return float
     */
    public function getDataType()
    {
      return $this->DataType;
    }

    /**
     * @param float $DataType
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setDataType($DataType)
    {
      $this->DataType = $DataType;
      return $this;
    }

    /**
     * @return string
     */
    public function getDisplayFormat()
    {
      return $this->DisplayFormat;
    }

    /**
     * @param string $DisplayFormat
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setDisplayFormat($DisplayFormat)
    {
      $this->DisplayFormat = $DisplayFormat;
      return $this;
    }

    /**
     * @return TabOrTableEnum
     */
    public function getTabOrTable()
    {
      return $this->TabOrTable;
    }

    /**
     * @param TabOrTableEnum $TabOrTable
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setTabOrTable($TabOrTable)
    {
      $this->TabOrTable = $TabOrTable;
      return $this;
    }

    /**
     * @return string
     */
    public function getTabOrTableID()
    {
      return $this->TabOrTableID;
    }

    /**
     * @param string $TabOrTableID
     * @return \Visual\SalesOrderService\UserDefinedFieldLabel
     */
    public function setTabOrTableID($TabOrTableID)
    {
      $this->TabOrTableID = $TabOrTableID;
      return $this;
    }

}
