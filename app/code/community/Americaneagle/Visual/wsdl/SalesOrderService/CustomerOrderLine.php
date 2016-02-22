<?php

namespace Visual\SalesOrderService;

class CustomerOrderLine extends ExternalReference
{

    /**
     * @var float $LineNo
     */
    protected $LineNo = null;

    /**
     * @var float $QTY
     */
    protected $QTY = null;

    /**
     * @var string $PartID
     */
    protected $PartID = null;

    /**
     * @var string $SellingUOM
     */
    protected $SellingUOM = null;

    /**
     * @var float $UnitPrice
     */
    protected $UnitPrice = null;

    /**
     * @var float $DiscountPercent
     */
    protected $DiscountPercent = null;

    /**
     * @var float $CommissionPercent
     */
    protected $CommissionPercent = null;

    /**
     * @var string $CustomerPartID
     */
    protected $CustomerPartID = null;

    /**
     * @var string $ServiceChargeID
     */
    protected $ServiceChargeID = null;

    /**
     * @var \DateTime $DesiredShipDate
     */
    protected $DesiredShipDate = null;

    /**
     * @var \DateTime $PromiseShipDate
     */
    protected $PromiseShipDate = null;

    /**
     * @var float $FreightCost
     */
    protected $FreightCost = null;

    /**
     * @var string $ProductCode
     */
    protected $ProductCode = null;

    /**
     * @var string $CommodityCode
     */
    protected $CommodityCode = null;

    /**
     * @var string $LineDescription
     */
    protected $LineDescription = null;

    /**
     * @var boolean $CreateNewWorkOrder
     */
    protected $CreateNewWorkOrder = null;

    /**
     * @var string $WorkorderBaseID
     */
    protected $WorkorderBaseID = null;

    /**
     * @var string $WorkorderLotID
     */
    protected $WorkorderLotID = null;

    /**
     * @var string $WorkorderSplitID
     */
    protected $WorkorderSplitID = null;

    /**
     * @var string $WorkorderStatus
     */
    protected $WorkorderStatus = null;

    /**
     * @var string $LineComments
     */
    protected $LineComments = null;

    /**
     * @var string $ShipToID
     */
    protected $ShipToID = null;

    /**
     * @var string $LineStatus
     */
    protected $LineStatus = null;

    /**
     * @var string $WarehouseID
     */
    protected $WarehouseID = null;

    /**
     * @var string $HTSCode
     */
    protected $HTSCode = null;

    /**
     * @var string $CountryOfOrigin
     */
    protected $CountryOfOrigin = null;

    /**
     * @var string $DrawingID
     */
    protected $DrawingID = null;

    /**
     * @var string $DrawingRev
     */
    protected $DrawingRev = null;

    /**
     * @var string $RevenueAcctID
     */
    protected $RevenueAcctID = null;

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
     * @var boolean $AutoAllocateInventory
     */
    protected $AutoAllocateInventory = null;

    /**
     * @var CFG8Data $CFG8Data
     */
    protected $CFG8Data = null;

    /**
     * @param float $QTY
     * @param boolean $AutoAllocateInventory
     */
    public function __construct($QTY, $AutoAllocateInventory)
    {
      parent::__construct();
      $this->QTY = $QTY;
      $this->AutoAllocateInventory = $AutoAllocateInventory;
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setLineNo($LineNo)
    {
      $this->LineNo = $LineNo;
      return $this;
    }

    /**
     * @return float
     */
    public function getQTY()
    {
      return $this->QTY;
    }

    /**
     * @param float $QTY
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setQTY($QTY)
    {
      $this->QTY = $QTY;
      return $this;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->PartID;
    }

    /**
     * @param string $PartID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setPartID($PartID)
    {
      $this->PartID = $PartID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSellingUOM()
    {
      return $this->SellingUOM;
    }

    /**
     * @param string $SellingUOM
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setSellingUOM($SellingUOM)
    {
      $this->SellingUOM = $SellingUOM;
      return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
      return $this->UnitPrice;
    }

    /**
     * @param float $UnitPrice
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setUnitPrice($UnitPrice)
    {
      $this->UnitPrice = $UnitPrice;
      return $this;
    }

    /**
     * @return float
     */
    public function getDiscountPercent()
    {
      return $this->DiscountPercent;
    }

    /**
     * @param float $DiscountPercent
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setDiscountPercent($DiscountPercent)
    {
      $this->DiscountPercent = $DiscountPercent;
      return $this;
    }

    /**
     * @return float
     */
    public function getCommissionPercent()
    {
      return $this->CommissionPercent;
    }

    /**
     * @param float $CommissionPercent
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCommissionPercent($CommissionPercent)
    {
      $this->CommissionPercent = $CommissionPercent;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPartID()
    {
      return $this->CustomerPartID;
    }

    /**
     * @param string $CustomerPartID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCustomerPartID($CustomerPartID)
    {
      $this->CustomerPartID = $CustomerPartID;
      return $this;
    }

    /**
     * @return string
     */
    public function getServiceChargeID()
    {
      return $this->ServiceChargeID;
    }

    /**
     * @param string $ServiceChargeID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setServiceChargeID($ServiceChargeID)
    {
      $this->ServiceChargeID = $ServiceChargeID;
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return float
     */
    public function getFreightCost()
    {
      return $this->FreightCost;
    }

    /**
     * @param float $FreightCost
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setFreightCost($FreightCost)
    {
      $this->FreightCost = $FreightCost;
      return $this;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
      return $this->ProductCode;
    }

    /**
     * @param string $ProductCode
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setProductCode($ProductCode)
    {
      $this->ProductCode = $ProductCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getCommodityCode()
    {
      return $this->CommodityCode;
    }

    /**
     * @param string $CommodityCode
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCommodityCode($CommodityCode)
    {
      $this->CommodityCode = $CommodityCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getLineDescription()
    {
      return $this->LineDescription;
    }

    /**
     * @param string $LineDescription
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setLineDescription($LineDescription)
    {
      $this->LineDescription = $LineDescription;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getCreateNewWorkOrder()
    {
      return $this->CreateNewWorkOrder;
    }

    /**
     * @param boolean $CreateNewWorkOrder
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCreateNewWorkOrder($CreateNewWorkOrder)
    {
      $this->CreateNewWorkOrder = $CreateNewWorkOrder;
      return $this;
    }

    /**
     * @return string
     */
    public function getWorkorderBaseID()
    {
      return $this->WorkorderBaseID;
    }

    /**
     * @param string $WorkorderBaseID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setWorkorderBaseID($WorkorderBaseID)
    {
      $this->WorkorderBaseID = $WorkorderBaseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getWorkorderLotID()
    {
      return $this->WorkorderLotID;
    }

    /**
     * @param string $WorkorderLotID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setWorkorderLotID($WorkorderLotID)
    {
      $this->WorkorderLotID = $WorkorderLotID;
      return $this;
    }

    /**
     * @return string
     */
    public function getWorkorderSplitID()
    {
      return $this->WorkorderSplitID;
    }

    /**
     * @param string $WorkorderSplitID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setWorkorderSplitID($WorkorderSplitID)
    {
      $this->WorkorderSplitID = $WorkorderSplitID;
      return $this;
    }

    /**
     * @return string
     */
    public function getWorkorderStatus()
    {
      return $this->WorkorderStatus;
    }

    /**
     * @param string $WorkorderStatus
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setWorkorderStatus($WorkorderStatus)
    {
      $this->WorkorderStatus = $WorkorderStatus;
      return $this;
    }

    /**
     * @return string
     */
    public function getLineComments()
    {
      return $this->LineComments;
    }

    /**
     * @param string $LineComments
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setLineComments($LineComments)
    {
      $this->LineComments = $LineComments;
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setShipToID($ShipToID)
    {
      $this->ShipToID = $ShipToID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLineStatus()
    {
      return $this->LineStatus;
    }

    /**
     * @param string $LineStatus
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setLineStatus($LineStatus)
    {
      $this->LineStatus = $LineStatus;
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setWarehouseID($WarehouseID)
    {
      $this->WarehouseID = $WarehouseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getHTSCode()
    {
      return $this->HTSCode;
    }

    /**
     * @param string $HTSCode
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setHTSCode($HTSCode)
    {
      $this->HTSCode = $HTSCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin()
    {
      return $this->CountryOfOrigin;
    }

    /**
     * @param string $CountryOfOrigin
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCountryOfOrigin($CountryOfOrigin)
    {
      $this->CountryOfOrigin = $CountryOfOrigin;
      return $this;
    }

    /**
     * @return string
     */
    public function getDrawingID()
    {
      return $this->DrawingID;
    }

    /**
     * @param string $DrawingID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setDrawingID($DrawingID)
    {
      $this->DrawingID = $DrawingID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDrawingRev()
    {
      return $this->DrawingRev;
    }

    /**
     * @param string $DrawingRev
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setDrawingRev($DrawingRev)
    {
      $this->DrawingRev = $DrawingRev;
      return $this;
    }

    /**
     * @return string
     */
    public function getRevenueAcctID()
    {
      return $this->RevenueAcctID;
    }

    /**
     * @param string $RevenueAcctID
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setRevenueAcctID($RevenueAcctID)
    {
      $this->RevenueAcctID = $RevenueAcctID;
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
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
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setUDFValues($UDFValues)
    {
      $this->UDFValues = $UDFValues;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getAutoAllocateInventory()
    {
      return $this->AutoAllocateInventory;
    }

    /**
     * @param boolean $AutoAllocateInventory
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setAutoAllocateInventory($AutoAllocateInventory)
    {
      $this->AutoAllocateInventory = $AutoAllocateInventory;
      return $this;
    }

    /**
     * @return CFG8Data
     */
    public function getCFG8Data()
    {
      return $this->CFG8Data;
    }

    /**
     * @param CFG8Data $CFG8Data
     * @return \Visual\SalesOrderService\CustomerOrderLine
     */
    public function setCFG8Data($CFG8Data)
    {
      $this->CFG8Data = $CFG8Data;
      return $this;
    }

}
