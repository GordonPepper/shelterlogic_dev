<?php

namespace Visual\InventoryService;

class InventoryService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'TracePartLocations2' => 'Visual\\InventoryService\\TracePartLocations2',
      'TracePartLocations2Response' => 'Visual\\InventoryService\\TracePartLocations2Response',
      'ArrayOfInventoryRequisitionTrace' => 'Visual\\InventoryService\\ArrayOfInventoryRequisitionTrace',
      'InventoryRequisitionTrace' => 'Visual\\InventoryService\\InventoryRequisitionTrace',
      'TraceLocation' => 'Visual\\InventoryService\\TraceLocation',
      'TracePartLocations' => 'Visual\\InventoryService\\TracePartLocations',
      'TracePartLocationsResponse' => 'Visual\\InventoryService\\TracePartLocationsResponse',
      'Header' => 'Visual\\InventoryService\\Header',
      'TraceIDExists' => 'Visual\\InventoryService\\TraceIDExists',
      'TraceIDExistsResponse' => 'Visual\\InventoryService\\TraceIDExistsResponse',
      'ServiceChargeExists' => 'Visual\\InventoryService\\ServiceChargeExists',
      'ServiceChargeExistsResponse' => 'Visual\\InventoryService\\ServiceChargeExistsResponse',
      'TraceProfileExists' => 'Visual\\InventoryService\\TraceProfileExists',
      'TraceProfileExistsResponse' => 'Visual\\InventoryService\\TraceProfileExistsResponse',
      'PartIDExists' => 'Visual\\InventoryService\\PartIDExists',
      'PartIDExistsResponse' => 'Visual\\InventoryService\\PartIDExistsResponse',
      'PartLocationExists' => 'Visual\\InventoryService\\PartLocationExists',
      'PartLocationExistsResponse' => 'Visual\\InventoryService\\PartLocationExistsResponse',
      'PartWarehouseExists' => 'Visual\\InventoryService\\PartWarehouseExists',
      'PartWarehouseExistsResponse' => 'Visual\\InventoryService\\PartWarehouseExistsResponse',
      'WarehouseExists' => 'Visual\\InventoryService\\WarehouseExists',
      'WarehouseExistsResponse' => 'Visual\\InventoryService\\WarehouseExistsResponse',
      'LocationExists' => 'Visual\\InventoryService\\LocationExists',
      'LocationExistsResponse' => 'Visual\\InventoryService\\LocationExistsResponse',
      'GetPartBySKU' => 'Visual\\InventoryService\\GetPartBySKU',
      'GetPartBySKUResponse' => 'Visual\\InventoryService\\GetPartBySKUResponse',
      'GetMaterialCost' => 'Visual\\InventoryService\\GetMaterialCost',
      'GetMaterialCostResponse' => 'Visual\\InventoryService\\GetMaterialCostResponse',
      'GetInventoryPosition' => 'Visual\\InventoryService\\GetInventoryPosition',
      'GetInventoryPositionResponse' => 'Visual\\InventoryService\\GetInventoryPositionResponse',
      'LookupUnitPrice2' => 'Visual\\InventoryService\\LookupUnitPrice2',
      'LookupUnitPrice2Response' => 'Visual\\InventoryService\\LookupUnitPrice2Response',
      'PartPriceResponse' => 'Visual\\InventoryService\\PartPriceResponse',
      'PartPriceRequest' => 'Visual\\InventoryService\\PartPriceRequest',
      'LookupUnitPrice' => 'Visual\\InventoryService\\LookupUnitPrice',
      'LookupUnitPriceResponse' => 'Visual\\InventoryService\\LookupUnitPriceResponse',
      'LookupUnitPriceByVisualRules' => 'Visual\\InventoryService\\LookupUnitPriceByVisualRules',
      'LookupUnitPriceByVisualRulesResponse' => 'Visual\\InventoryService\\LookupUnitPriceByVisualRulesResponse',
      'TestLookupUnitPrice' => 'Visual\\InventoryService\\TestLookupUnitPrice',
      'TestLookupUnitPriceResponse' => 'Visual\\InventoryService\\TestLookupUnitPriceResponse',
      'TestInventoryTransfer' => 'Visual\\InventoryService\\TestInventoryTransfer',
      'TestInventoryTransferResponse' => 'Visual\\InventoryService\\TestInventoryTransferResponse',
      'ProcessInventoryTransaction2' => 'Visual\\InventoryService\\ProcessInventoryTransaction2',
      'InventoryTransactionData' => 'Visual\\InventoryService\\InventoryTransactionData',
      'ArrayOfInventoryTransfer' => 'Visual\\InventoryService\\ArrayOfInventoryTransfer',
      'InventoryTransfer' => 'Visual\\InventoryService\\InventoryTransfer',
      'ArrayOfInventoryAdjustIN' => 'Visual\\InventoryService\\ArrayOfInventoryAdjustIN',
      'InventoryAdjustIN' => 'Visual\\InventoryService\\InventoryAdjustIN',
      'ArrayOfInventoryAdjustOUT' => 'Visual\\InventoryService\\ArrayOfInventoryAdjustOUT',
      'InventoryAdjustOUT' => 'Visual\\InventoryService\\InventoryAdjustOUT',
      'ArrayOfInventoryMaterialIssue' => 'Visual\\InventoryService\\ArrayOfInventoryMaterialIssue',
      'InventoryMaterialIssue' => 'Visual\\InventoryService\\InventoryMaterialIssue',
      'ArrayOfInventoryWOReceipt' => 'Visual\\InventoryService\\ArrayOfInventoryWOReceipt',
      'InventoryWOReceipt' => 'Visual\\InventoryService\\InventoryWOReceipt',
      'ProcessInventoryTransaction2Response' => 'Visual\\InventoryService\\ProcessInventoryTransaction2Response',
      'ProcessInventoryTransaction' => 'Visual\\InventoryService\\ProcessInventoryTransaction',
      'ProcessInventoryTransactionResponse' => 'Visual\\InventoryService\\ProcessInventoryTransactionResponse',
      'ProcessPhisicalInventoryTransaction2' => 'Visual\\InventoryService\\ProcessPhisicalInventoryTransaction2',
      'InventoryCycleCountData' => 'Visual\\InventoryService\\InventoryCycleCountData',
      'ArrayOfInventoryCycleCount' => 'Visual\\InventoryService\\ArrayOfInventoryCycleCount',
      'InventoryCycleCount' => 'Visual\\InventoryService\\InventoryCycleCount',
      'ProcessPhisicalInventoryTransaction2Response' => 'Visual\\InventoryService\\ProcessPhisicalInventoryTransaction2Response',
      'ProcessPhisicalInventoryTransaction' => 'Visual\\InventoryService\\ProcessPhisicalInventoryTransaction',
      'ProcessPhisicalInventoryTransactionResponse' => 'Visual\\InventoryService\\ProcessPhisicalInventoryTransactionResponse',
      'TestGetPartList' => 'Visual\\InventoryService\\TestGetPartList',
      'TestGetPartListResponse' => 'Visual\\InventoryService\\TestGetPartListResponse',
      'PartDataResponse' => 'Visual\\InventoryService\\PartDataResponse',
      'BaseDataResponse' => 'Visual\\InventoryService\\BaseDataResponse',
      'ArrayOfPartListItem' => 'Visual\\InventoryService\\ArrayOfPartListItem',
      'PartListItem' => 'Visual\\InventoryService\\PartListItem',
      'Part' => 'Visual\\InventoryService\\Part',
      'GetPartList' => 'Visual\\InventoryService\\GetPartList',
      'GetPartListResponse' => 'Visual\\InventoryService\\GetPartListResponse',
      'CurrentVersion' => 'Visual\\InventoryService\\CurrentVersion',
      'CurrentVersionResponse' => 'Visual\\InventoryService\\CurrentVersionResponse',
      'LoginCreds' => 'Visual\\InventoryService\\LoginCreds',
      'LoginCredsResponse' => 'Visual\\InventoryService\\LoginCredsResponse',
      'NextNumberGenAppenditure' => 'Visual\\InventoryService\\NextNumberGenAppenditure',
      'NextNumberGenAppenditureResponse' => 'Visual\\InventoryService\\NextNumberGenAppenditureResponse',
      'UserPermission' => 'Visual\\InventoryService\\UserPermission',
      'UserPermissionResponse' => 'Visual\\InventoryService\\UserPermissionResponse',
      'NextNumberGen2' => 'Visual\\InventoryService\\NextNumberGen2',
      'NextNumberGen2Response' => 'Visual\\InventoryService\\NextNumberGen2Response',
      'InstallSchemaDatabaseLogMessage' => 'Visual\\InventoryService\\InstallSchemaDatabaseLogMessage',
      'InstallSchemaDatabaseLogMessageResponse' => 'Visual\\InventoryService\\InstallSchemaDatabaseLogMessageResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = 'https://slvisual.shelterlogicdirect.com/derp/InventoryService.asmx?wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param TracePartLocations2 $parameters
     * @return TracePartLocations2Response
     */
    public function TracePartLocations2(TracePartLocations2 $parameters)
    {
      return $this->__soapCall('TracePartLocations2', array($parameters));
    }

    /**
     * @param TracePartLocations $parameters
     * @return TracePartLocationsResponse
     */
    public function TracePartLocations(TracePartLocations $parameters)
    {
      return $this->__soapCall('TracePartLocations', array($parameters));
    }

    /**
     * @param TraceIDExists $parameters
     * @return TraceIDExistsResponse
     */
    public function TraceIDExists(TraceIDExists $parameters)
    {
      return $this->__soapCall('TraceIDExists', array($parameters));
    }

    /**
     * @param ServiceChargeExists $parameters
     * @return ServiceChargeExistsResponse
     */
    public function ServiceChargeExists(ServiceChargeExists $parameters)
    {
      return $this->__soapCall('ServiceChargeExists', array($parameters));
    }

    /**
     * @param TraceProfileExists $parameters
     * @return TraceProfileExistsResponse
     */
    public function TraceProfileExists(TraceProfileExists $parameters)
    {
      return $this->__soapCall('TraceProfileExists', array($parameters));
    }

    /**
     * @param PartIDExists $parameters
     * @return PartIDExistsResponse
     */
    public function PartIDExists(PartIDExists $parameters)
    {
      return $this->__soapCall('PartIDExists', array($parameters));
    }

    /**
     * @param PartLocationExists $parameters
     * @return PartLocationExistsResponse
     */
    public function PartLocationExists(PartLocationExists $parameters)
    {
      return $this->__soapCall('PartLocationExists', array($parameters));
    }

    /**
     * @param PartWarehouseExists $parameters
     * @return PartWarehouseExistsResponse
     */
    public function PartWarehouseExists(PartWarehouseExists $parameters)
    {
      return $this->__soapCall('PartWarehouseExists', array($parameters));
    }

    /**
     * @param WarehouseExists $parameters
     * @return WarehouseExistsResponse
     */
    public function WarehouseExists(WarehouseExists $parameters)
    {
      return $this->__soapCall('WarehouseExists', array($parameters));
    }

    /**
     * @param LocationExists $parameters
     * @return LocationExistsResponse
     */
    public function LocationExists(LocationExists $parameters)
    {
      return $this->__soapCall('LocationExists', array($parameters));
    }

    /**
     * @param GetPartBySKU $parameters
     * @return GetPartBySKUResponse
     */
    public function GetPartBySKU(GetPartBySKU $parameters)
    {
      return $this->__soapCall('GetPartBySKU', array($parameters));
    }

    /**
     * @param GetMaterialCost $parameters
     * @return GetMaterialCostResponse
     */
    public function GetMaterialCost(GetMaterialCost $parameters)
    {
      return $this->__soapCall('GetMaterialCost', array($parameters));
    }

    /**
     * @param GetInventoryPosition $parameters
     * @return GetInventoryPositionResponse
     */
    public function GetInventoryPosition(GetInventoryPosition $parameters)
    {
      return $this->__soapCall('GetInventoryPosition', array($parameters));
    }

    /**
     * @param LookupUnitPrice2 $parameters
     * @return LookupUnitPrice2Response
     */
    public function LookupUnitPrice2(LookupUnitPrice2 $parameters)
    {
      return $this->__soapCall('LookupUnitPrice2', array($parameters));
    }

    /**
     * @param LookupUnitPrice $parameters
     * @return LookupUnitPriceResponse
     */
    public function LookupUnitPrice(LookupUnitPrice $parameters)
    {
      return $this->__soapCall('LookupUnitPrice', array($parameters));
    }

    /**
     * @param LookupUnitPriceByVisualRules $parameters
     * @return LookupUnitPriceByVisualRulesResponse
     */
    public function LookupUnitPriceByVisualRules(LookupUnitPriceByVisualRules $parameters)
    {
      return $this->__soapCall('LookupUnitPriceByVisualRules', array($parameters));
    }

    /**
     * @param TestLookupUnitPrice $parameters
     * @return TestLookupUnitPriceResponse
     */
    public function TestLookupUnitPrice(TestLookupUnitPrice $parameters)
    {
      return $this->__soapCall('TestLookupUnitPrice', array($parameters));
    }

    /**
     * @param TestInventoryTransfer $parameters
     * @return TestInventoryTransferResponse
     */
    public function TestInventoryTransfer(TestInventoryTransfer $parameters)
    {
      return $this->__soapCall('TestInventoryTransfer', array($parameters));
    }

    /**
     * @param ProcessInventoryTransaction2 $parameters
     * @return ProcessInventoryTransaction2Response
     */
    public function ProcessInventoryTransaction2(ProcessInventoryTransaction2 $parameters)
    {
      return $this->__soapCall('ProcessInventoryTransaction2', array($parameters));
    }

    /**
     * @param ProcessInventoryTransaction $parameters
     * @return ProcessInventoryTransactionResponse
     */
    public function ProcessInventoryTransaction(ProcessInventoryTransaction $parameters)
    {
      return $this->__soapCall('ProcessInventoryTransaction', array($parameters));
    }

    /**
     * @param ProcessPhisicalInventoryTransaction2 $parameters
     * @return ProcessPhisicalInventoryTransaction2Response
     */
    public function ProcessPhisicalInventoryTransaction2(ProcessPhisicalInventoryTransaction2 $parameters)
    {
      return $this->__soapCall('ProcessPhisicalInventoryTransaction2', array($parameters));
    }

    /**
     * @param ProcessPhisicalInventoryTransaction $parameters
     * @return ProcessPhisicalInventoryTransactionResponse
     */
    public function ProcessPhisicalInventoryTransaction(ProcessPhisicalInventoryTransaction $parameters)
    {
      return $this->__soapCall('ProcessPhisicalInventoryTransaction', array($parameters));
    }

    /**
     * @param TestGetPartList $parameters
     * @return TestGetPartListResponse
     */
    public function TestGetPartList(TestGetPartList $parameters)
    {
      return $this->__soapCall('TestGetPartList', array($parameters));
    }

    /**
     * @param GetPartList $parameters
     * @return GetPartListResponse
     */
    public function GetPartList(GetPartList $parameters)
    {
      return $this->__soapCall('GetPartList', array($parameters));
    }

    /**
     * @param CurrentVersion $parameters
     * @return CurrentVersionResponse
     */
    public function CurrentVersion(CurrentVersion $parameters)
    {
      return $this->__soapCall('CurrentVersion', array($parameters));
    }

    /**
     * @param LoginCreds $parameters
     * @return LoginCredsResponse
     */
    public function LoginCreds(LoginCreds $parameters)
    {
      return $this->__soapCall('LoginCreds', array($parameters));
    }

    /**
     * @param NextNumberGenAppenditure $parameters
     * @return NextNumberGenAppenditureResponse
     */
    public function NextNumberGenAppenditure(NextNumberGenAppenditure $parameters)
    {
      return $this->__soapCall('NextNumberGenAppenditure', array($parameters));
    }

    /**
     * @param UserPermission $parameters
     * @return UserPermissionResponse
     */
    public function UserPermission(UserPermission $parameters)
    {
      return $this->__soapCall('UserPermission', array($parameters));
    }

    /**
     * @param NextNumberGen2 $parameters
     * @return NextNumberGen2Response
     */
    public function NextNumberGen2(NextNumberGen2 $parameters)
    {
      return $this->__soapCall('NextNumberGen2', array($parameters));
    }

    /**
     * @param InstallSchemaDatabaseLogMessage $parameters
     * @return InstallSchemaDatabaseLogMessageResponse
     */
    public function InstallSchemaDatabaseLogMessage(InstallSchemaDatabaseLogMessage $parameters)
    {
      return $this->__soapCall('InstallSchemaDatabaseLogMessage', array($parameters));
    }

}
