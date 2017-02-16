<?php

namespace Visual\UserDefinedFieldService;

class TestSearchUserDefinedLabel
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
     * @var string $Use_Wildcards_BOOL
     */
    protected $Use_Wildcards_BOOL = null;

    /**
     * @var string $Program
     */
    protected $Program = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $Use_Wildcards_BOOL
     * @param string $Program
     * @param string $ID
     * @param string $Label
     */
    public function __construct($key, $userName, $password, $Use_Wildcards_BOOL, $Program, $ID, $Label)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->Use_Wildcards_BOOL = $Use_Wildcards_BOOL;
      $this->Program = $Program;
      $this->ID = $ID;
      $this->Label = $Label;
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
     */
    public function setPassword($password)
    {
      $this->password = $password;
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
     */
    public function setUse_Wildcards_BOOL($Use_Wildcards_BOOL)
    {
      $this->Use_Wildcards_BOOL = $Use_Wildcards_BOOL;
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
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
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabel
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
