<?php

namespace Visual\SalesOrderService;

class UserDefinedFieldValue
{

    /**
     * @var UserDefinedFieldLabel $UserDefinedFieldLabel
     */
    protected $UserDefinedFieldLabel = null;

    /**
     * @var string $DocumentID
     */
    protected $DocumentID = null;

    /**
     * @var float $LineNo
     */
    protected $LineNo = null;

    /**
     * @var float $DelLineNo
     */
    protected $DelLineNo = null;

    /**
     * @var string $StringValue
     */
    protected $StringValue = null;

    /**
     * @var float $NumberValue
     */
    protected $NumberValue = null;

    /**
     * @var boolean $BooleanValue
     */
    protected $BooleanValue = null;

    /**
     * @var \DateTime $DateValue
     */
    protected $DateValue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UserDefinedFieldLabel
     */
    public function getUserDefinedFieldLabel()
    {
      return $this->UserDefinedFieldLabel;
    }

    /**
     * @param UserDefinedFieldLabel $UserDefinedFieldLabel
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setUserDefinedFieldLabel($UserDefinedFieldLabel)
    {
      $this->UserDefinedFieldLabel = $UserDefinedFieldLabel;
      return $this;
    }

    /**
     * @return string
     */
    public function getDocumentID()
    {
      return $this->DocumentID;
    }

    /**
     * @param string $DocumentID
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setDocumentID($DocumentID)
    {
      $this->DocumentID = $DocumentID;
      return $this;
    }

    /**
     * @return float
     */
    public function getLineNo()
    {
      return $this->LineNo;
    }

    /**
     * @param float $LineNo
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setLineNo($LineNo)
    {
      $this->LineNo = $LineNo;
      return $this;
    }

    /**
     * @return float
     */
    public function getDelLineNo()
    {
      return $this->DelLineNo;
    }

    /**
     * @param float $DelLineNo
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setDelLineNo($DelLineNo)
    {
      $this->DelLineNo = $DelLineNo;
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
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setStringValue($StringValue)
    {
      $this->StringValue = $StringValue;
      return $this;
    }

    /**
     * @return float
     */
    public function getNumberValue()
    {
      return $this->NumberValue;
    }

    /**
     * @param float $NumberValue
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setNumberValue($NumberValue)
    {
      $this->NumberValue = $NumberValue;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getBooleanValue()
    {
      return $this->BooleanValue;
    }

    /**
     * @param boolean $BooleanValue
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setBooleanValue($BooleanValue)
    {
      $this->BooleanValue = $BooleanValue;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateValue()
    {
      if ($this->DateValue == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->DateValue);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $DateValue
     * @return \Visual\SalesOrderService\UserDefinedFieldValue
     */
    public function setDateValue(\DateTime $DateValue = null)
    {
      if ($DateValue == null) {
       $this->DateValue = null;
      } else {
        $this->DateValue = $DateValue->format(\DateTime::ATOM);
      }
      return $this;
    }

}
