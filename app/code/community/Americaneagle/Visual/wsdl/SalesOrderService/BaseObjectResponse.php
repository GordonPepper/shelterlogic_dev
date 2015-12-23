<?php

namespace Visual\SalesOrderService;

class BaseObjectResponse
{

    /**
     * @var boolean $HasErrors
     */
    protected $HasErrors = null;

    /**
     * @var string $ErrorMessage
     */
    protected $ErrorMessage = null;

    /**
     * @var string $ExceptionDetails
     */
    protected $ExceptionDetails = null;

    /**
     * @param boolean $HasErrors
     */
    public function __construct($HasErrors)
    {
      $this->HasErrors = $HasErrors;
    }

    /**
     * @return boolean
     */
    public function getHasErrors()
    {
      return $this->HasErrors;
    }

    /**
     * @param boolean $HasErrors
     * @return \Visual\SalesOrderService\BaseObjectResponse
     */
    public function setHasErrors($HasErrors)
    {
      $this->HasErrors = $HasErrors;
      return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
      return $this->ErrorMessage;
    }

    /**
     * @param string $ErrorMessage
     * @return \Visual\SalesOrderService\BaseObjectResponse
     */
    public function setErrorMessage($ErrorMessage)
    {
      $this->ErrorMessage = $ErrorMessage;
      return $this;
    }

    /**
     * @return string
     */
    public function getExceptionDetails()
    {
      return $this->ExceptionDetails;
    }

    /**
     * @param string $ExceptionDetails
     * @return \Visual\SalesOrderService\BaseObjectResponse
     */
    public function setExceptionDetails($ExceptionDetails)
    {
      $this->ExceptionDetails = $ExceptionDetails;
      return $this;
    }

}
