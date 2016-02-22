<?php

namespace Visual\CustomerService;

class CustomerAddress extends ExternalReference
{

    /**
     * @var float $AddressNO
     */
    protected $AddressNO = null;

    /**
     * @var string $ShipToID
     */
    protected $ShipToID = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

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
     * @var string $TaxIDNumber
     */
    protected $TaxIDNumber = null;

    /**
     * @var string $TaxExempt
     */
    protected $TaxExempt = null;

    /**
     * @var string $SalesRepID
     */
    protected $SalesRepID = null;

    /**
     * @var string $Territory
     */
    protected $Territory = null;

    /**
     * @var string $ShipVIA
     */
    protected $ShipVIA = null;

    /**
     * @var string $FOB
     */
    protected $FOB = null;

    /**
     * @var string $DiscountCode
     */
    protected $DiscountCode = null;

    /**
     * @var string $ArrivalCode
     */
    protected $ArrivalCode = null;

    /**
     * @var string $CountryCode
     */
    protected $CountryCode = null;

    /**
     * @var string $PriorityCode
     */
    protected $PriorityCode = null;

    /**
     * @var string $WarehouseID
     */
    protected $WarehouseID = null;

    /**
     * @var string $ComplianceLabel
     */
    protected $ComplianceLabel = null;

    /**
     * @var string $CarrierID
     */
    protected $CarrierID = null;

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

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return float
     */
    public function getAddressNO()
    {
      return $this->AddressNO;
    }

    /**
     * @param float $AddressNO
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setAddressNO($AddressNO)
    {
      $this->AddressNO = $AddressNO;
      return $this;
    }

    /**
     * @return string
     */
    public function getShipToID()
    {
      return $this->ShipToID;
    }

    /**
     * @param string $ShipToID
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setShipToID($ShipToID)
    {
      $this->ShipToID = $ShipToID;
      return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setName($Name)
    {
      $this->Name = $Name;
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setCountry($Country)
    {
      $this->Country = $Country;
      return $this;
    }

    /**
     * @return string
     */
    public function getTaxIDNumber()
    {
      return $this->TaxIDNumber;
    }

    /**
     * @param string $TaxIDNumber
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setTaxIDNumber($TaxIDNumber)
    {
      $this->TaxIDNumber = $TaxIDNumber;
      return $this;
    }

    /**
     * @return string
     */
    public function getTaxExempt()
    {
      return $this->TaxExempt;
    }

    /**
     * @param string $TaxExempt
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setTaxExempt($TaxExempt)
    {
      $this->TaxExempt = $TaxExempt;
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
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setSalesRepID($SalesRepID)
    {
      $this->SalesRepID = $SalesRepID;
      return $this;
    }

    /**
     * @return string
     */
    public function getTerritory()
    {
      return $this->Territory;
    }

    /**
     * @param string $Territory
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setTerritory($Territory)
    {
      $this->Territory = $Territory;
      return $this;
    }

    /**
     * @return string
     */
    public function getShipVIA()
    {
      return $this->ShipVIA;
    }

    /**
     * @param string $ShipVIA
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setShipVIA($ShipVIA)
    {
      $this->ShipVIA = $ShipVIA;
      return $this;
    }

    /**
     * @return string
     */
    public function getFOB()
    {
      return $this->FOB;
    }

    /**
     * @param string $FOB
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setFOB($FOB)
    {
      $this->FOB = $FOB;
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
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setDiscountCode($DiscountCode)
    {
      $this->DiscountCode = $DiscountCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getArrivalCode()
    {
      return $this->ArrivalCode;
    }

    /**
     * @param string $ArrivalCode
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setArrivalCode($ArrivalCode)
    {
      $this->ArrivalCode = $ArrivalCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
      return $this->CountryCode;
    }

    /**
     * @param string $CountryCode
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setCountryCode($CountryCode)
    {
      $this->CountryCode = $CountryCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getPriorityCode()
    {
      return $this->PriorityCode;
    }

    /**
     * @param string $PriorityCode
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setPriorityCode($PriorityCode)
    {
      $this->PriorityCode = $PriorityCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getWarehouseID()
    {
      return $this->WarehouseID;
    }

    /**
     * @param string $WarehouseID
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setWarehouseID($WarehouseID)
    {
      $this->WarehouseID = $WarehouseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getComplianceLabel()
    {
      return $this->ComplianceLabel;
    }

    /**
     * @param string $ComplianceLabel
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setComplianceLabel($ComplianceLabel)
    {
      $this->ComplianceLabel = $ComplianceLabel;
      return $this;
    }

    /**
     * @return string
     */
    public function getCarrierID()
    {
      return $this->CarrierID;
    }

    /**
     * @param string $CarrierID
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setCarrierID($CarrierID)
    {
      $this->CarrierID = $CarrierID;
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
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
     * @return \Visual\CustomerService\CustomerAddress
     */
    public function setActiveFlag($ActiveFlag)
    {
      $this->ActiveFlag = $ActiveFlag;
      return $this;
    }

}
