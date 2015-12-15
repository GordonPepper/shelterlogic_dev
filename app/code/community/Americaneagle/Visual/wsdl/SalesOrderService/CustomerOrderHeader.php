<?php

namespace Visual\SalesOrderService;

class CustomerOrderHeader extends ExternalReference
{

    /**
     * @var string $CustomerOrderID
     */
    protected $CustomerOrderID = null;

    /**
     * @var \DateTime $OrderDate
     */
    protected $OrderDate = null;

    /**
     * @var string $CustomerID
     */
    protected $CustomerID = null;

    /**
     * @var string $CustomerPurchaseOrderID
     */
    protected $CustomerPurchaseOrderID = null;

    /**
     * @var \DateTime $DesiredShipDate
     */
    protected $DesiredShipDate = null;

    /**
     * @var \DateTime $PromiseShipDate
     */
    protected $PromiseShipDate = null;

    /**
     * @var \DateTime $PromiseDeliveryDate
     */
    protected $PromiseDeliveryDate = null;

    /**
     * @var string $ShipToID
     */
    protected $ShipToID = null;

    /**
     * @var string $Status
     */
    protected $Status = null;

    /**
     * @var string $ShipVIA
     */
    protected $ShipVIA = null;

    /**
     * @var string $FOB
     */
    protected $FOB = null;

    /**
     * @var string $CarrierID
     */
    protected $CarrierID = null;

    /**
     * @var string $ContactID
     */
    protected $ContactID = null;

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
     * @var string $OrderComments
     */
    protected $OrderComments = null;

    /**
     * @var string $CurrencyID
     */
    protected $CurrencyID = null;

    /**
     * @var string $SiteID
     */
    protected $SiteID = null;

    /**
     * @var boolean $IsEDIBlanketOrder
     */
    protected $IsEDIBlanketOrder = null;

    /**
     * @var boolean $IsEDIRelease
     */
    protected $IsEDIRelease = null;

    /**
     * @var string $EDIBlanketNumber
     */
    protected $EDIBlanketNumber = null;

    /**
     * @var string $EDIReleaseNumber
     */
    protected $EDIReleaseNumber = null;

    /**
     * @var string $SalesRepID
     */
    protected $SalesRepID = null;

    /**
     * @var string $TerritoryID
     */
    protected $TerritoryID = null;

    /**
     * @var string $SalesTaxID
     */
    protected $SalesTaxID = null;

    /**
     * @var string $DiscountCodeID
     */
    protected $DiscountCodeID = null;

    /**
     * @var string $TermsID
     */
    protected $TermsID = null;

    /**
     * @var \DateTime $PrintedDate
     */
    protected $PrintedDate = null;

    /**
     * @var float $TotalAmountOrdered
     */
    protected $TotalAmountOrdered = null;

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
     * @var ArrayOfUserDefinedFieldValue $UserDefinedValues
     */
    protected $UserDefinedValues = null;

    /**
     * @var ArrayOfUDFValue $UDFValues
     */
    protected $UDFValues = null;

    /**
     * @var ArrayOfCustomerOrderLine $Lines
     */
    protected $Lines = null;

    
    public function __construct()
    {
      parent::__construct();
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setCustomerOrderID($CustomerOrderID)
    {
      $this->CustomerOrderID = $CustomerOrderID;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate()
    {
      if ($this->OrderDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->OrderDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $OrderDate
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setOrderDate(\DateTime $OrderDate = null)
    {
      if ($OrderDate == null) {
       $this->OrderDate = null;
      } else {
        $this->OrderDate = $OrderDate->format(\DateTime::ATOM);
      }
      return $this;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setCustomerID($CustomerID)
    {
      $this->CustomerID = $CustomerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPurchaseOrderID()
    {
      return $this->CustomerPurchaseOrderID;
    }

    /**
     * @param string $CustomerPurchaseOrderID
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setCustomerPurchaseOrderID($CustomerPurchaseOrderID)
    {
      $this->CustomerPurchaseOrderID = $CustomerPurchaseOrderID;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDesiredShipDate()
    {
      if ($this->DesiredShipDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->DesiredShipDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $DesiredShipDate
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setDesiredShipDate(\DateTime $DesiredShipDate = null)
    {
      if ($DesiredShipDate == null) {
       $this->DesiredShipDate = null;
      } else {
        $this->DesiredShipDate = $DesiredShipDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPromiseShipDate()
    {
      if ($this->PromiseShipDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->PromiseShipDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $PromiseShipDate
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setPromiseShipDate(\DateTime $PromiseShipDate = null)
    {
      if ($PromiseShipDate == null) {
       $this->PromiseShipDate = null;
      } else {
        $this->PromiseShipDate = $PromiseShipDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPromiseDeliveryDate()
    {
      if ($this->PromiseDeliveryDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->PromiseDeliveryDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $PromiseDeliveryDate
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setPromiseDeliveryDate(\DateTime $PromiseDeliveryDate = null)
    {
      if ($PromiseDeliveryDate == null) {
       $this->PromiseDeliveryDate = null;
      } else {
        $this->PromiseDeliveryDate = $PromiseDeliveryDate->format(\DateTime::ATOM);
      }
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setShipToID($ShipToID)
    {
      $this->ShipToID = $ShipToID;
      return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
      return $this->Status;
    }

    /**
     * @param string $Status
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setStatus($Status)
    {
      $this->Status = $Status;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setFOB($FOB)
    {
      $this->FOB = $FOB;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setCarrierID($CarrierID)
    {
      $this->CarrierID = $CarrierID;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactID()
    {
      return $this->ContactID;
    }

    /**
     * @param string $ContactID
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setContactID($ContactID)
    {
      $this->ContactID = $ContactID;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setContactEmail($ContactEmail)
    {
      $this->ContactEmail = $ContactEmail;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderComments()
    {
      return $this->OrderComments;
    }

    /**
     * @param string $OrderComments
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setOrderComments($OrderComments)
    {
      $this->OrderComments = $OrderComments;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setCurrencyID($CurrencyID)
    {
      $this->CurrencyID = $CurrencyID;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setSiteID($SiteID)
    {
      $this->SiteID = $SiteID;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getIsEDIBlanketOrder()
    {
      return $this->IsEDIBlanketOrder;
    }

    /**
     * @param boolean $IsEDIBlanketOrder
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setIsEDIBlanketOrder($IsEDIBlanketOrder)
    {
      $this->IsEDIBlanketOrder = $IsEDIBlanketOrder;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getIsEDIRelease()
    {
      return $this->IsEDIRelease;
    }

    /**
     * @param boolean $IsEDIRelease
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setIsEDIRelease($IsEDIRelease)
    {
      $this->IsEDIRelease = $IsEDIRelease;
      return $this;
    }

    /**
     * @return string
     */
    public function getEDIBlanketNumber()
    {
      return $this->EDIBlanketNumber;
    }

    /**
     * @param string $EDIBlanketNumber
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setEDIBlanketNumber($EDIBlanketNumber)
    {
      $this->EDIBlanketNumber = $EDIBlanketNumber;
      return $this;
    }

    /**
     * @return string
     */
    public function getEDIReleaseNumber()
    {
      return $this->EDIReleaseNumber;
    }

    /**
     * @param string $EDIReleaseNumber
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setEDIReleaseNumber($EDIReleaseNumber)
    {
      $this->EDIReleaseNumber = $EDIReleaseNumber;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setTerritoryID($TerritoryID)
    {
      $this->TerritoryID = $TerritoryID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSalesTaxID()
    {
      return $this->SalesTaxID;
    }

    /**
     * @param string $SalesTaxID
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setSalesTaxID($SalesTaxID)
    {
      $this->SalesTaxID = $SalesTaxID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDiscountCodeID()
    {
      return $this->DiscountCodeID;
    }

    /**
     * @param string $DiscountCodeID
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setDiscountCodeID($DiscountCodeID)
    {
      $this->DiscountCodeID = $DiscountCodeID;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setTermsID($TermsID)
    {
      $this->TermsID = $TermsID;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPrintedDate()
    {
      if ($this->PrintedDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->PrintedDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $PrintedDate
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setPrintedDate(\DateTime $PrintedDate = null)
    {
      if ($PrintedDate == null) {
       $this->PrintedDate = null;
      } else {
        $this->PrintedDate = $PrintedDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return float
     */
    public function getTotalAmountOrdered()
    {
      return $this->TotalAmountOrdered;
    }

    /**
     * @param float $TotalAmountOrdered
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setTotalAmountOrdered($TotalAmountOrdered)
    {
      $this->TotalAmountOrdered = $TotalAmountOrdered;
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
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
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setUserDefined10($UserDefined10)
    {
      $this->UserDefined10 = $UserDefined10;
      return $this;
    }

    /**
     * @return ArrayOfUserDefinedFieldValue
     */
    public function getUserDefinedValues()
    {
      return $this->UserDefinedValues;
    }

    /**
     * @param ArrayOfUserDefinedFieldValue $UserDefinedValues
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setUserDefinedValues($UserDefinedValues)
    {
      $this->UserDefinedValues = $UserDefinedValues;
      return $this;
    }

    /**
     * @return ArrayOfUDFValue
     */
    public function getUDFValues()
    {
      return $this->UDFValues;
    }

    /**
     * @param ArrayOfUDFValue $UDFValues
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setUDFValues($UDFValues)
    {
      $this->UDFValues = $UDFValues;
      return $this;
    }

    /**
     * @return ArrayOfCustomerOrderLine
     */
    public function getLines()
    {
      return $this->Lines;
    }

    /**
     * @param ArrayOfCustomerOrderLine $Lines
     * @return \Visual\SalesOrderService\CustomerOrderHeader
     */
    public function setLines($Lines)
    {
      $this->Lines = $Lines;
      return $this;
    }

}
