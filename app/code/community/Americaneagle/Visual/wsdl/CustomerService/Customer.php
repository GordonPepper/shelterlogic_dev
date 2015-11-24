<?php

namespace Visual\CustomerService;

class Customer extends ExternalReference
{

    /**
     * @var string $CustomerID
     */
    protected $CustomerID = null;

    /**
     * @var string $CustomerName
     */
    protected $CustomerName = null;

    /**
     * @var string $Address1
     */
    protected $Address1 = null;

    /**
     * @var string $Address2
     */
    protected $Address2 = null;

    /**
     * @var string $Address3
     */
    protected $Address3 = null;

    /**
     * @var string $City
     */
    protected $City = null;

    /**
     * @var string $State
     */
    protected $State = null;

    /**
     * @var string $ZipCode
     */
    protected $ZipCode = null;

    /**
     * @var string $Country
     */
    protected $Country = null;

    /**
     * @var string $BillingName
     */
    protected $BillingName = null;

    /**
     * @var string $BillingAddress1
     */
    protected $BillingAddress1 = null;

    /**
     * @var string $BillingAddress2
     */
    protected $BillingAddress2 = null;

    /**
     * @var string $BillingAddress3
     */
    protected $BillingAddress3 = null;

    /**
     * @var string $BillingCity
     */
    protected $BillingCity = null;

    /**
     * @var string $BillingState
     */
    protected $BillingState = null;

    /**
     * @var string $BillingZipCode
     */
    protected $BillingZipCode = null;

    /**
     * @var string $BillingCountry
     */
    protected $BillingCountry = null;

    /**
     * @var string $TermsID
     */
    protected $TermsID = null;

    /**
     * @var string $SiteID
     */
    protected $SiteID = null;

    /**
     * @var string $SICCode
     */
    protected $SICCode = null;

    /**
     * @var string $CurrencyID
     */
    protected $CurrencyID = null;

    /**
     * @var string $IndustrialCode
     */
    protected $IndustrialCode = null;

    /**
     * @var string $ACKCodes
     */
    protected $ACKCodes = null;

    /**
     * @var string $DiscountCode
     */
    protected $DiscountCode = null;

    /**
     * @var string $LabelID
     */
    protected $LabelID = null;

    /**
     * @var string $SalesRepID
     */
    protected $SalesRepID = null;

    /**
     * @var string $TerritoryID
     */
    protected $TerritoryID = null;

    /**
     * @var string $Market
     */
    protected $Market = null;

    /**
     * @var float $Priority
     */
    protected $Priority = null;

    /**
     * @var \DateTime $AccountOpen
     */
    protected $AccountOpen = null;

    /**
     * @var string $ContactHonorific
     */
    protected $ContactHonorific = null;

    /**
     * @var string $ContactSalutation
     */
    protected $ContactSalutation = null;

    /**
     * @var string $ContactFirstName
     */
    protected $ContactFirstName = null;

    /**
     * @var string $ContactMiddleInitial
     */
    protected $ContactMiddleInitial = null;

    /**
     * @var string $ContactLastName
     */
    protected $ContactLastName = null;

    /**
     * @var string $ContactPhoneNumber
     */
    protected $ContactPhoneNumber = null;

    /**
     * @var string $ContactFaxNumber
     */
    protected $ContactFaxNumber = null;

    /**
     * @var string $ContactMobileNumber
     */
    protected $ContactMobileNumber = null;

    /**
     * @var string $ContactEmail
     */
    protected $ContactEmail = null;

    /**
     * @var string $WebUserID
     */
    protected $WebUserID = null;

    /**
     * @var string $WebPassword
     */
    protected $WebPassword = null;

    /**
     * @var float $CreditLimit
     */
    protected $CreditLimit = null;

    /**
     * @var float $RecvAgeLimit
     */
    protected $RecvAgeLimit = null;

    /**
     * @var string $CreditStatus
     */
    protected $CreditStatus = null;

    /**
     * @var string $CreditLimitControl
     */
    protected $CreditLimitControl = null;

    /**
     * @var string $CustomerComments
     */
    protected $CustomerComments = null;

    /**
     * @var string $CustomerNotation
     */
    protected $CustomerNotation = null;

    /**
     * @var string $UserDefined1
     */
    protected $UserDefined1 = null;

    /**
     * @var string $UserDefined2
     */
    protected $UserDefined2 = null;

    /**
     * @var string $UserDefined3
     */
    protected $UserDefined3 = null;

    /**
     * @var string $UserDefined4
     */
    protected $UserDefined4 = null;

    /**
     * @var string $UserDefined5
     */
    protected $UserDefined5 = null;

    /**
     * @var string $UserDefined6
     */
    protected $UserDefined6 = null;

    /**
     * @var string $UserDefined7
     */
    protected $UserDefined7 = null;

    /**
     * @var string $UserDefined8
     */
    protected $UserDefined8 = null;

    /**
     * @var string $UserDefined9
     */
    protected $UserDefined9 = null;

    /**
     * @var string $UserDefined10
     */
    protected $UserDefined10 = null;

    /**
     * @var boolean $ActiveFlag
     */
    protected $ActiveFlag = null;

    /**
     * @var ArrayOfCustomerAddress $Addresses
     */
    protected $Addresses = null;

    /**
     * @var ArrayOfCustomerEntity $Entities
     */
    protected $Entities = null;

    /**
     * @var ArrayOfCustomerSite $Sites
     */
    protected $Sites = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->CustomerID;
    }

    /**
     * @param string $CustomerID
     * @return \Visual\CustomerService\Customer
     */
    public function setCustomerID($CustomerID)
    {
      $this->CustomerID = $CustomerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
      return $this->CustomerName;
    }

    /**
     * @param string $CustomerName
     * @return \Visual\CustomerService\Customer
     */
    public function setCustomerName($CustomerName)
    {
      $this->CustomerName = $CustomerName;
      return $this;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
      return $this->Address1;
    }

    /**
     * @param string $Address1
     * @return \Visual\CustomerService\Customer
     */
    public function setAddress1($Address1)
    {
      $this->Address1 = $Address1;
      return $this;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
      return $this->Address2;
    }

    /**
     * @param string $Address2
     * @return \Visual\CustomerService\Customer
     */
    public function setAddress2($Address2)
    {
      $this->Address2 = $Address2;
      return $this;
    }

    /**
     * @return string
     */
    public function getAddress3()
    {
      return $this->Address3;
    }

    /**
     * @param string $Address3
     * @return \Visual\CustomerService\Customer
     */
    public function setAddress3($Address3)
    {
      $this->Address3 = $Address3;
      return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
      return $this->City;
    }

    /**
     * @param string $City
     * @return \Visual\CustomerService\Customer
     */
    public function setCity($City)
    {
      $this->City = $City;
      return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
      return $this->State;
    }

    /**
     * @param string $State
     * @return \Visual\CustomerService\Customer
     */
    public function setState($State)
    {
      $this->State = $State;
      return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
      return $this->ZipCode;
    }

    /**
     * @param string $ZipCode
     * @return \Visual\CustomerService\Customer
     */
    public function setZipCode($ZipCode)
    {
      $this->ZipCode = $ZipCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
      return $this->Country;
    }

    /**
     * @param string $Country
     * @return \Visual\CustomerService\Customer
     */
    public function setCountry($Country)
    {
      $this->Country = $Country;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingName()
    {
      return $this->BillingName;
    }

    /**
     * @param string $BillingName
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingName($BillingName)
    {
      $this->BillingName = $BillingName;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress1()
    {
      return $this->BillingAddress1;
    }

    /**
     * @param string $BillingAddress1
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingAddress1($BillingAddress1)
    {
      $this->BillingAddress1 = $BillingAddress1;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress2()
    {
      return $this->BillingAddress2;
    }

    /**
     * @param string $BillingAddress2
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingAddress2($BillingAddress2)
    {
      $this->BillingAddress2 = $BillingAddress2;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress3()
    {
      return $this->BillingAddress3;
    }

    /**
     * @param string $BillingAddress3
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingAddress3($BillingAddress3)
    {
      $this->BillingAddress3 = $BillingAddress3;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingCity()
    {
      return $this->BillingCity;
    }

    /**
     * @param string $BillingCity
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingCity($BillingCity)
    {
      $this->BillingCity = $BillingCity;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingState()
    {
      return $this->BillingState;
    }

    /**
     * @param string $BillingState
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingState($BillingState)
    {
      $this->BillingState = $BillingState;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingZipCode()
    {
      return $this->BillingZipCode;
    }

    /**
     * @param string $BillingZipCode
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingZipCode($BillingZipCode)
    {
      $this->BillingZipCode = $BillingZipCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingCountry()
    {
      return $this->BillingCountry;
    }

    /**
     * @param string $BillingCountry
     * @return \Visual\CustomerService\Customer
     */
    public function setBillingCountry($BillingCountry)
    {
      $this->BillingCountry = $BillingCountry;
      return $this;
    }

    /**
     * @return string
     */
    public function getTermsID()
    {
      return $this->TermsID;
    }

    /**
     * @param string $TermsID
     * @return \Visual\CustomerService\Customer
     */
    public function setTermsID($TermsID)
    {
      $this->TermsID = $TermsID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSiteID()
    {
      return $this->SiteID;
    }

    /**
     * @param string $SiteID
     * @return \Visual\CustomerService\Customer
     */
    public function setSiteID($SiteID)
    {
      $this->SiteID = $SiteID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSICCode()
    {
      return $this->SICCode;
    }

    /**
     * @param string $SICCode
     * @return \Visual\CustomerService\Customer
     */
    public function setSICCode($SICCode)
    {
      $this->SICCode = $SICCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyID()
    {
      return $this->CurrencyID;
    }

    /**
     * @param string $CurrencyID
     * @return \Visual\CustomerService\Customer
     */
    public function setCurrencyID($CurrencyID)
    {
      $this->CurrencyID = $CurrencyID;
      return $this;
    }

    /**
     * @return string
     */
    public function getIndustrialCode()
    {
      return $this->IndustrialCode;
    }

    /**
     * @param string $IndustrialCode
     * @return \Visual\CustomerService\Customer
     */
    public function setIndustrialCode($IndustrialCode)
    {
      $this->IndustrialCode = $IndustrialCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getACKCodes()
    {
      return $this->ACKCodes;
    }

    /**
     * @param string $ACKCodes
     * @return \Visual\CustomerService\Customer
     */
    public function setACKCodes($ACKCodes)
    {
      $this->ACKCodes = $ACKCodes;
      return $this;
    }

    /**
     * @return string
     */
    public function getDiscountCode()
    {
      return $this->DiscountCode;
    }

    /**
     * @param string $DiscountCode
     * @return \Visual\CustomerService\Customer
     */
    public function setDiscountCode($DiscountCode)
    {
      $this->DiscountCode = $DiscountCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabelID()
    {
      return $this->LabelID;
    }

    /**
     * @param string $LabelID
     * @return \Visual\CustomerService\Customer
     */
    public function setLabelID($LabelID)
    {
      $this->LabelID = $LabelID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSalesRepID()
    {
      return $this->SalesRepID;
    }

    /**
     * @param string $SalesRepID
     * @return \Visual\CustomerService\Customer
     */
    public function setSalesRepID($SalesRepID)
    {
      $this->SalesRepID = $SalesRepID;
      return $this;
    }

    /**
     * @return string
     */
    public function getTerritoryID()
    {
      return $this->TerritoryID;
    }

    /**
     * @param string $TerritoryID
     * @return \Visual\CustomerService\Customer
     */
    public function setTerritoryID($TerritoryID)
    {
      $this->TerritoryID = $TerritoryID;
      return $this;
    }

    /**
     * @return string
     */
    public function getMarket()
    {
      return $this->Market;
    }

    /**
     * @param string $Market
     * @return \Visual\CustomerService\Customer
     */
    public function setMarket($Market)
    {
      $this->Market = $Market;
      return $this;
    }

    /**
     * @return float
     */
    public function getPriority()
    {
      return $this->Priority;
    }

    /**
     * @param float $Priority
     * @return \Visual\CustomerService\Customer
     */
    public function setPriority($Priority)
    {
      $this->Priority = $Priority;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAccountOpen()
    {
      if ($this->AccountOpen == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->AccountOpen);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $AccountOpen
     * @return \Visual\CustomerService\Customer
     */
    public function setAccountOpen(\DateTime $AccountOpen = null)
    {
      if ($AccountOpen == null) {
       $this->AccountOpen = null;
      } else {
        $this->AccountOpen = $AccountOpen->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getContactHonorific()
    {
      return $this->ContactHonorific;
    }

    /**
     * @param string $ContactHonorific
     * @return \Visual\CustomerService\Customer
     */
    public function setContactHonorific($ContactHonorific)
    {
      $this->ContactHonorific = $ContactHonorific;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactSalutation()
    {
      return $this->ContactSalutation;
    }

    /**
     * @param string $ContactSalutation
     * @return \Visual\CustomerService\Customer
     */
    public function setContactSalutation($ContactSalutation)
    {
      $this->ContactSalutation = $ContactSalutation;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactFirstName()
    {
      return $this->ContactFirstName;
    }

    /**
     * @param string $ContactFirstName
     * @return \Visual\CustomerService\Customer
     */
    public function setContactFirstName($ContactFirstName)
    {
      $this->ContactFirstName = $ContactFirstName;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactMiddleInitial()
    {
      return $this->ContactMiddleInitial;
    }

    /**
     * @param string $ContactMiddleInitial
     * @return \Visual\CustomerService\Customer
     */
    public function setContactMiddleInitial($ContactMiddleInitial)
    {
      $this->ContactMiddleInitial = $ContactMiddleInitial;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactLastName()
    {
      return $this->ContactLastName;
    }

    /**
     * @param string $ContactLastName
     * @return \Visual\CustomerService\Customer
     */
    public function setContactLastName($ContactLastName)
    {
      $this->ContactLastName = $ContactLastName;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactPhoneNumber()
    {
      return $this->ContactPhoneNumber;
    }

    /**
     * @param string $ContactPhoneNumber
     * @return \Visual\CustomerService\Customer
     */
    public function setContactPhoneNumber($ContactPhoneNumber)
    {
      $this->ContactPhoneNumber = $ContactPhoneNumber;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactFaxNumber()
    {
      return $this->ContactFaxNumber;
    }

    /**
     * @param string $ContactFaxNumber
     * @return \Visual\CustomerService\Customer
     */
    public function setContactFaxNumber($ContactFaxNumber)
    {
      $this->ContactFaxNumber = $ContactFaxNumber;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactMobileNumber()
    {
      return $this->ContactMobileNumber;
    }

    /**
     * @param string $ContactMobileNumber
     * @return \Visual\CustomerService\Customer
     */
    public function setContactMobileNumber($ContactMobileNumber)
    {
      $this->ContactMobileNumber = $ContactMobileNumber;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactEmail()
    {
      return $this->ContactEmail;
    }

    /**
     * @param string $ContactEmail
     * @return \Visual\CustomerService\Customer
     */
    public function setContactEmail($ContactEmail)
    {
      $this->ContactEmail = $ContactEmail;
      return $this;
    }

    /**
     * @return string
     */
    public function getWebUserID()
    {
      return $this->WebUserID;
    }

    /**
     * @param string $WebUserID
     * @return \Visual\CustomerService\Customer
     */
    public function setWebUserID($WebUserID)
    {
      $this->WebUserID = $WebUserID;
      return $this;
    }

    /**
     * @return string
     */
    public function getWebPassword()
    {
      return $this->WebPassword;
    }

    /**
     * @param string $WebPassword
     * @return \Visual\CustomerService\Customer
     */
    public function setWebPassword($WebPassword)
    {
      $this->WebPassword = $WebPassword;
      return $this;
    }

    /**
     * @return float
     */
    public function getCreditLimit()
    {
      return $this->CreditLimit;
    }

    /**
     * @param float $CreditLimit
     * @return \Visual\CustomerService\Customer
     */
    public function setCreditLimit($CreditLimit)
    {
      $this->CreditLimit = $CreditLimit;
      return $this;
    }

    /**
     * @return float
     */
    public function getRecvAgeLimit()
    {
      return $this->RecvAgeLimit;
    }

    /**
     * @param float $RecvAgeLimit
     * @return \Visual\CustomerService\Customer
     */
    public function setRecvAgeLimit($RecvAgeLimit)
    {
      $this->RecvAgeLimit = $RecvAgeLimit;
      return $this;
    }

    /**
     * @return string
     */
    public function getCreditStatus()
    {
      return $this->CreditStatus;
    }

    /**
     * @param string $CreditStatus
     * @return \Visual\CustomerService\Customer
     */
    public function setCreditStatus($CreditStatus)
    {
      $this->CreditStatus = $CreditStatus;
      return $this;
    }

    /**
     * @return string
     */
    public function getCreditLimitControl()
    {
      return $this->CreditLimitControl;
    }

    /**
     * @param string $CreditLimitControl
     * @return \Visual\CustomerService\Customer
     */
    public function setCreditLimitControl($CreditLimitControl)
    {
      $this->CreditLimitControl = $CreditLimitControl;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerComments()
    {
      return $this->CustomerComments;
    }

    /**
     * @param string $CustomerComments
     * @return \Visual\CustomerService\Customer
     */
    public function setCustomerComments($CustomerComments)
    {
      $this->CustomerComments = $CustomerComments;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerNotation()
    {
      return $this->CustomerNotation;
    }

    /**
     * @param string $CustomerNotation
     * @return \Visual\CustomerService\Customer
     */
    public function setCustomerNotation($CustomerNotation)
    {
      $this->CustomerNotation = $CustomerNotation;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined1()
    {
      return $this->UserDefined1;
    }

    /**
     * @param string $UserDefined1
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined1($UserDefined1)
    {
      $this->UserDefined1 = $UserDefined1;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined2()
    {
      return $this->UserDefined2;
    }

    /**
     * @param string $UserDefined2
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined2($UserDefined2)
    {
      $this->UserDefined2 = $UserDefined2;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined3()
    {
      return $this->UserDefined3;
    }

    /**
     * @param string $UserDefined3
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined3($UserDefined3)
    {
      $this->UserDefined3 = $UserDefined3;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined4()
    {
      return $this->UserDefined4;
    }

    /**
     * @param string $UserDefined4
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined4($UserDefined4)
    {
      $this->UserDefined4 = $UserDefined4;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined5()
    {
      return $this->UserDefined5;
    }

    /**
     * @param string $UserDefined5
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined5($UserDefined5)
    {
      $this->UserDefined5 = $UserDefined5;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined6()
    {
      return $this->UserDefined6;
    }

    /**
     * @param string $UserDefined6
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined6($UserDefined6)
    {
      $this->UserDefined6 = $UserDefined6;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined7()
    {
      return $this->UserDefined7;
    }

    /**
     * @param string $UserDefined7
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined7($UserDefined7)
    {
      $this->UserDefined7 = $UserDefined7;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined8()
    {
      return $this->UserDefined8;
    }

    /**
     * @param string $UserDefined8
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined8($UserDefined8)
    {
      $this->UserDefined8 = $UserDefined8;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined9()
    {
      return $this->UserDefined9;
    }

    /**
     * @param string $UserDefined9
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined9($UserDefined9)
    {
      $this->UserDefined9 = $UserDefined9;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined10()
    {
      return $this->UserDefined10;
    }

    /**
     * @param string $UserDefined10
     * @return \Visual\CustomerService\Customer
     */
    public function setUserDefined10($UserDefined10)
    {
      $this->UserDefined10 = $UserDefined10;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getActiveFlag()
    {
      return $this->ActiveFlag;
    }

    /**
     * @param boolean $ActiveFlag
     * @return \Visual\CustomerService\Customer
     */
    public function setActiveFlag($ActiveFlag)
    {
      $this->ActiveFlag = $ActiveFlag;
      return $this;
    }

    /**
     * @return ArrayOfCustomerAddress
     */
    public function getAddresses()
    {
      return $this->Addresses;
    }

    /**
     * @param ArrayOfCustomerAddress $Addresses
     * @return \Visual\CustomerService\Customer
     */
    public function setAddresses($Addresses)
    {
      $this->Addresses = $Addresses;
      return $this;
    }

    /**
     * @return ArrayOfCustomerEntity
     */
    public function getEntities()
    {
      return $this->Entities;
    }

    /**
     * @param ArrayOfCustomerEntity $Entities
     * @return \Visual\CustomerService\Customer
     */
    public function setEntities($Entities)
    {
      $this->Entities = $Entities;
      return $this;
    }

    /**
     * @return ArrayOfCustomerSite
     */
    public function getSites()
    {
      return $this->Sites;
    }

    /**
     * @param ArrayOfCustomerSite $Sites
     * @return \Visual\CustomerService\Customer
     */
    public function setSites($Sites)
    {
      $this->Sites = $Sites;
      return $this;
    }

}
