<?php

namespace Visual\SalesOrderService;

class NewOrderPayment
{

    /**
     * @var string $CustomerOrderID
     */
    protected $CustomerOrderID = null;

    /**
     * @var float $SequenceId
     */
    protected $SequenceId = null;

    /**
     * @var string $PaymentType
     */
    protected $PaymentType = null;

    /**
     * @var string $CardType
     */
    protected $CardType = null;

    /**
     * @var string $CardReference
     */
    protected $CardReference = null;

    /**
     * @var string $AuthorizationCode
     */
    protected $AuthorizationCode = null;

    /**
     * @var string $PaymentCode
     */
    protected $PaymentCode = null;

    /**
     * @var \DateTime $AuthorizationDate
     */
    protected $AuthorizationDate = null;

    /**
     * @var \DateTime $PaymentDate
     */
    protected $PaymentDate = null;

    /**
     * @var float $AuthorizationAmount
     */
    protected $AuthorizationAmount = null;

    /**
     * @var float $PaymentAmount
     */
    protected $PaymentAmount = null;

    /**
     * @var string $BankId
     */
    protected $BankId = null;

    /**
     * @var string $CustProfileId
     */
    protected $CustProfileId = null;

    /**
     * @var string $PaymentProfileId
     */
    protected $PaymentProfileId = null;

    /**
     * @param \DateTime $AuthorizationDate
     * @param float $AuthorizationAmount
     */
    public function __construct(\DateTime $AuthorizationDate, $AuthorizationAmount)
    {
      $this->AuthorizationDate = $AuthorizationDate->format(\DateTime::ATOM);
      $this->AuthorizationAmount = $AuthorizationAmount;
    }

    /**
     * @return string
     */
    public function getCustomerOrderID()
    {
      return $this->CustomerOrderID;
    }

    /**
     * @param string $CustomerOrderID
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setCustomerOrderID($CustomerOrderID)
    {
      $this->CustomerOrderID = $CustomerOrderID;
      return $this;
    }

    /**
     * @return float
     */
    public function getSequenceId()
    {
      return $this->SequenceId;
    }

    /**
     * @param float $SequenceId
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setSequenceId($SequenceId)
    {
      $this->SequenceId = $SequenceId;
      return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
      return $this->PaymentType;
    }

    /**
     * @param string $PaymentType
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setPaymentType($PaymentType)
    {
      $this->PaymentType = $PaymentType;
      return $this;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
      return $this->CardType;
    }

    /**
     * @param string $CardType
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setCardType($CardType)
    {
      $this->CardType = $CardType;
      return $this;
    }

    /**
     * @return string
     */
    public function getCardReference()
    {
      return $this->CardReference;
    }

    /**
     * @param string $CardReference
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setCardReference($CardReference)
    {
      $this->CardReference = $CardReference;
      return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationCode()
    {
      return $this->AuthorizationCode;
    }

    /**
     * @param string $AuthorizationCode
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setAuthorizationCode($AuthorizationCode)
    {
      $this->AuthorizationCode = $AuthorizationCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getPaymentCode()
    {
      return $this->PaymentCode;
    }

    /**
     * @param string $PaymentCode
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setPaymentCode($PaymentCode)
    {
      $this->PaymentCode = $PaymentCode;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAuthorizationDate()
    {
      if ($this->AuthorizationDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->AuthorizationDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $AuthorizationDate
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setAuthorizationDate(\DateTime $AuthorizationDate)
    {
      $this->AuthorizationDate = $AuthorizationDate->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentDate()
    {
      if ($this->PaymentDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->PaymentDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $PaymentDate
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setPaymentDate(\DateTime $PaymentDate = null)
    {
      if ($PaymentDate == null) {
       $this->PaymentDate = null;
      } else {
        $this->PaymentDate = $PaymentDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return float
     */
    public function getAuthorizationAmount()
    {
      return $this->AuthorizationAmount;
    }

    /**
     * @param float $AuthorizationAmount
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setAuthorizationAmount($AuthorizationAmount)
    {
      $this->AuthorizationAmount = $AuthorizationAmount;
      return $this;
    }

    /**
     * @return float
     */
    public function getPaymentAmount()
    {
      return $this->PaymentAmount;
    }

    /**
     * @param float $PaymentAmount
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setPaymentAmount($PaymentAmount)
    {
      $this->PaymentAmount = $PaymentAmount;
      return $this;
    }

    /**
     * @return string
     */
    public function getBankId()
    {
      return $this->BankId;
    }

    /**
     * @param string $BankId
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setBankId($BankId)
    {
      $this->BankId = $BankId;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustProfileId()
    {
      return $this->CustProfileId;
    }

    /**
     * @param string $CustProfileId
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setCustProfileId($CustProfileId)
    {
      $this->CustProfileId = $CustProfileId;
      return $this;
    }

    /**
     * @return string
     */
    public function getPaymentProfileId()
    {
      return $this->PaymentProfileId;
    }

    /**
     * @param string $PaymentProfileId
     * @return \Visual\SalesOrderService\NewOrderPayment
     */
    public function setPaymentProfileId($PaymentProfileId)
    {
      $this->PaymentProfileId = $PaymentProfileId;
      return $this;
    }

}
