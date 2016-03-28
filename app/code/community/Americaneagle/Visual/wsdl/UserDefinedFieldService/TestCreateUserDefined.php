<?php

namespace Visual\UserDefinedFieldService;

class TestCreateUserDefined
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
     * @var string $Program
     */
    protected $Program = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $Document
     */
    protected $Document = null;

    /**
     * @var string $lineNo
     */
    protected $lineNo = null;

    /**
     * @var string $boolVal
     */
    protected $boolVal = null;

    /**
     * @var string $dateVal
     */
    protected $dateVal = null;

    /**
     * @var string $numVal
     */
    protected $numVal = null;

    /**
     * @var string $stringVal
     */
    protected $stringVal = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $Program
     * @param string $ID
     * @param string $Document
     * @param string $lineNo
     * @param string $boolVal
     * @param string $dateVal
     * @param string $numVal
     * @param string $stringVal
     */
    public function __construct($key, $userName, $password, $Program, $ID, $Document, $lineNo, $boolVal, $dateVal, $numVal, $stringVal)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->Program = $Program;
      $this->ID = $ID;
      $this->Document = $Document;
      $this->lineNo = $lineNo;
      $this->boolVal = $boolVal;
      $this->dateVal = $dateVal;
      $this->numVal = $numVal;
      $this->stringVal = $stringVal;
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
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
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
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
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
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

    /**
     * @return string
     */
    public function getProgram()
    {
      return $this->Program;
    }

    /**
     * @param string $Program
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setProgram($Program)
    {
      $this->Program = $Program;
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
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDocument()
    {
      return $this->Document;
    }

    /**
     * @param string $Document
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setDocument($Document)
    {
      $this->Document = $Document;
      return $this;
    }

    /**
     * @return string
     */
    public function getLineNo()
    {
      return $this->lineNo;
    }

    /**
     * @param string $lineNo
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setLineNo($lineNo)
    {
      $this->lineNo = $lineNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getBoolVal()
    {
      return $this->boolVal;
    }

    /**
     * @param string $boolVal
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setBoolVal($boolVal)
    {
      $this->boolVal = $boolVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateVal()
    {
      return $this->dateVal;
    }

    /**
     * @param string $dateVal
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setDateVal($dateVal)
    {
      $this->dateVal = $dateVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getNumVal()
    {
      return $this->numVal;
    }

    /**
     * @param string $numVal
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setNumVal($numVal)
    {
      $this->numVal = $numVal;
      return $this;
    }

    /**
     * @return string
     */
    public function getStringVal()
    {
      return $this->stringVal;
    }

    /**
     * @param string $stringVal
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefined
     */
    public function setStringVal($stringVal)
    {
      $this->stringVal = $stringVal;
      return $this;
    }

}
