<?php

namespace Visual\SalesOrderService;

class UDFValue
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
     * @var string $DocumentID
     */
    protected $DocumentID = null;

    /**
     * @var int $LineNo
     */
    protected $LineNo = null;

    /**
     * @var int $DelLineNo
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
     * @return string
     */
    public function getProgramID()
    {
      return $this->ProgramID;
    }

    /**
     * @param string $ProgramID
     * @return \Visual\SalesOrderService\UDFValue
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
     * @return \Visual\SalesOrderService\UDFValue
     */
    public function setID($ID)
    {
      $this->ID = $ID;
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
     * @return \Visual\SalesOrderService\UDFValue
     */
    public function setDocumentID($DocumentID)
    {
      $this->DocumentID = $DocumentID;
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
     * @return \Visual\SalesOrderService\UDFValue
     */
    public function setLineNo($LineNo)
    {
      $this->LineNo = $LineNo;
      return $this;
    }

    /**
     * @return int
     */
    public function getDelLineNo()
    {
      return $this->DelLineNo;
    }

    /**
     * @param int $DelLineNo
     * @return \Visual\SalesOrderService\UDFValue
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
     * @return \Visual\SalesOrderService\UDFValue
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
     * @return \Visual\SalesOrderService\UDFValue
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
     * @return \Visual\SalesOrderService\UDFValue
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
     * @return \Visual\SalesOrderService\UDFValue
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
