<?php

namespace Visual\UserDefinedFieldService;

class UDFLabel
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
     * @var int $LineNo
     */
    protected $LineNo = null;

    /**
     * @var DataTypeEnum $DataType
     */
    protected $DataType = null;

    /**
     * @var string $DisplayFormat
     */
    protected $DisplayFormat = null;

    /**
     * @var LabelTabOrTableEnum $TabOrTable
     */
    protected $TabOrTable = null;

    /**
     * @var string $TabID
     */
    protected $TabID = null;

    /**
     * @var string $TableID
     */
    protected $TableID = null;

    /**
     * @var int $SeqNo
     */
    protected $SeqNo = null;

    /**
     * @var boolean $Required
     */
    protected $Required = null;

    /**
     * @var string $StringValue
     */
    protected $StringValue = null;

    
    public function __construct()
    {
    
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
     * @return \Visual\UserDefinedFieldService\UDFLabel
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
     * @return \Visual\UserDefinedFieldService\UDFLabel
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
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return int
     */
    public function getLineNo()
    {
      return $this->LineNo;
    }

    /**
     * @param int $LineNo
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setLineNo($LineNo)
    {
      $this->LineNo = $LineNo;
      return $this;
    }

    /**
     * @return DataTypeEnum
     */
    public function getDataType()
    {
      return $this->DataType;
    }

    /**
     * @param DataTypeEnum $DataType
     * @return \Visual\UserDefinedFieldService\UDFLabel
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
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setDisplayFormat($DisplayFormat)
    {
      $this->DisplayFormat = $DisplayFormat;
      return $this;
    }

    /**
     * @return LabelTabOrTableEnum
     */
    public function getTabOrTable()
    {
      return $this->TabOrTable;
    }

    /**
     * @param LabelTabOrTableEnum $TabOrTable
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setTabOrTable($TabOrTable)
    {
      $this->TabOrTable = $TabOrTable;
      return $this;
    }

    /**
     * @return string
     */
    public function getTabID()
    {
      return $this->TabID;
    }

    /**
     * @param string $TabID
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setTabID($TabID)
    {
      $this->TabID = $TabID;
      return $this;
    }

    /**
     * @return string
     */
    public function getTableID()
    {
      return $this->TableID;
    }

    /**
     * @param string $TableID
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setTableID($TableID)
    {
      $this->TableID = $TableID;
      return $this;
    }

    /**
     * @return int
     */
    public function getSeqNo()
    {
      return $this->SeqNo;
    }

    /**
     * @param int $SeqNo
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setSeqNo($SeqNo)
    {
      $this->SeqNo = $SeqNo;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getRequired()
    {
      return $this->Required;
    }

    /**
     * @param boolean $Required
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setRequired($Required)
    {
      $this->Required = $Required;
      return $this;
    }

    /**
     * @return string
     */
    public function getStringValue()
    {
      return $this->StringValue;
    }

    /**
     * @param string $StringValue
     * @return \Visual\UserDefinedFieldService\UDFLabel
     */
    public function setStringValue($StringValue)
    {
      $this->StringValue = $StringValue;
      return $this;
    }

}
