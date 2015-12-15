<?php

namespace Visual\CustomerService;

class CustomerService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'SampleXML' => 'Visual\\CustomerService\\SampleXML',
      'SampleXMLResponse' => 'Visual\\CustomerService\\SampleXMLResponse',
      'CustomerData' => 'Visual\\CustomerService\\CustomerData',
      'ArrayOfCustomer' => 'Visual\\CustomerService\\ArrayOfCustomer',
      'Customer' => 'Visual\\CustomerService\\Customer',
      'ExternalReference' => 'Visual\\CustomerService\\ExternalReference',
      'ArrayOfReference' => 'Visual\\CustomerService\\ArrayOfReference',
      'Reference' => 'Visual\\CustomerService\\Reference',
      'CustomerSite' => 'Visual\\CustomerService\\CustomerSite',
      'CustomerEntity' => 'Visual\\CustomerService\\CustomerEntity',
      'CustomerAddress' => 'Visual\\CustomerService\\CustomerAddress',
      'ArrayOfCustomerAddress' => 'Visual\\CustomerService\\ArrayOfCustomerAddress',
      'ArrayOfCustomerEntity' => 'Visual\\CustomerService\\ArrayOfCustomerEntity',
      'ArrayOfCustomerSite' => 'Visual\\CustomerService\\ArrayOfCustomerSite',
      'ConfigureNextNumberGen' => 'Visual\\CustomerService\\ConfigureNextNumberGen',
      'ConfigureNextNumberGenResponse' => 'Visual\\CustomerService\\ConfigureNextNumberGenResponse',
      'GetShipViaCodes2' => 'Visual\\CustomerService\\GetShipViaCodes2',
      'GetShipViaCodes2Response' => 'Visual\\CustomerService\\GetShipViaCodes2Response',
      'ArrayOfString' => 'Visual\\CustomerService\\ArrayOfString',
      'GetDefaultCustomerShipViaCode2' => 'Visual\\CustomerService\\GetDefaultCustomerShipViaCode2',
      'GetDefaultCustomerShipViaCode2Response' => 'Visual\\CustomerService\\GetDefaultCustomerShipViaCode2Response',
      'GetDefaultCustomerShipViaCode' => 'Visual\\CustomerService\\GetDefaultCustomerShipViaCode',
      'GetDefaultCustomerShipViaCodeResponse' => 'Visual\\CustomerService\\GetDefaultCustomerShipViaCodeResponse',
      'Header' => 'Visual\\CustomerService\\Header',
      'GetShipViaCodes' => 'Visual\\CustomerService\\GetShipViaCodes',
      'GetShipViaCodesResponse' => 'Visual\\CustomerService\\GetShipViaCodesResponse',
      'PurchaseOrderIDExists' => 'Visual\\CustomerService\\PurchaseOrderIDExists',
      'PurchaseOrderIDExistsResponse' => 'Visual\\CustomerService\\PurchaseOrderIDExistsResponse',
      'PurchaseOrderIDExists2' => 'Visual\\CustomerService\\PurchaseOrderIDExists2',
      'PurchaseOrderIDExists2Response' => 'Visual\\CustomerService\\PurchaseOrderIDExists2Response',
      'CreatePhoneCustomer2' => 'Visual\\CustomerService\\CreatePhoneCustomer2',
      'CreatePhoneCustomer2Response' => 'Visual\\CustomerService\\CreatePhoneCustomer2Response',
      'CreateCustomer2' => 'Visual\\CustomerService\\CreateCustomer2',
      'CreateCustomer2Response' => 'Visual\\CustomerService\\CreateCustomer2Response',
      'TestLoadCustomerDataByShipTO' => 'Visual\\CustomerService\\TestLoadCustomerDataByShipTO',
      'TestLoadCustomerDataByShipTOResponse' => 'Visual\\CustomerService\\TestLoadCustomerDataByShipTOResponse',
      'LoadCustomerDataByShipTO2' => 'Visual\\CustomerService\\LoadCustomerDataByShipTO2',
      'LoadCustomerDataByShipTO2Response' => 'Visual\\CustomerService\\LoadCustomerDataByShipTO2Response',
      'LoadCustomerDataByShipTOUserDefined12' => 'Visual\\CustomerService\\LoadCustomerDataByShipTOUserDefined12',
      'LoadCustomerDataByShipTOUserDefined12Response' => 'Visual\\CustomerService\\LoadCustomerDataByShipTOUserDefined12Response',
      'LoadCustomerDataByOrderID2' => 'Visual\\CustomerService\\LoadCustomerDataByOrderID2',
      'LoadCustomerDataByOrderID2Response' => 'Visual\\CustomerService\\LoadCustomerDataByOrderID2Response',
      'LoadCustomerDataByWebID' => 'Visual\\CustomerService\\LoadCustomerDataByWebID',
      'LoadCustomerDataByWebIDResponse' => 'Visual\\CustomerService\\LoadCustomerDataByWebIDResponse',
      'LoadShipTOByAddress' => 'Visual\\CustomerService\\LoadShipTOByAddress',
      'LoadShipTOByAddressResponse' => 'Visual\\CustomerService\\LoadShipTOByAddressResponse',
      'TestLoadCustomerDataByOrderID' => 'Visual\\CustomerService\\TestLoadCustomerDataByOrderID',
      'TestLoadCustomerDataByOrderIDResponse' => 'Visual\\CustomerService\\TestLoadCustomerDataByOrderIDResponse',
      'LokupWarehouseByID' => 'Visual\\CustomerService\\LokupWarehouseByID',
      'LokupWarehouseByIDResponse' => 'Visual\\CustomerService\\LokupWarehouseByIDResponse',
      'LookupNameByID' => 'Visual\\CustomerService\\LookupNameByID',
      'LookupNameByIDResponse' => 'Visual\\CustomerService\\LookupNameByIDResponse',
      'LokupNameByID' => 'Visual\\CustomerService\\LokupNameByID',
      'LokupNameByIDResponse' => 'Visual\\CustomerService\\LokupNameByIDResponse',
      'LoadCustomerDataByOrderID' => 'Visual\\CustomerService\\LoadCustomerDataByOrderID',
      'LoadCustomerDataByOrderIDResponse' => 'Visual\\CustomerService\\LoadCustomerDataByOrderIDResponse',
      'LoadCustomerDataByShipTO' => 'Visual\\CustomerService\\LoadCustomerDataByShipTO',
      'LoadCustomerDataByShipTOResponse' => 'Visual\\CustomerService\\LoadCustomerDataByShipTOResponse',
      'LoadCustomerDataByShipTOUserDefined1' => 'Visual\\CustomerService\\LoadCustomerDataByShipTOUserDefined1',
      'LoadCustomerDataByShipTOUserDefined1Response' => 'Visual\\CustomerService\\LoadCustomerDataByShipTOUserDefined1Response',
      'CreateCustomer' => 'Visual\\CustomerService\\CreateCustomer',
      'CreateCustomerResponse' => 'Visual\\CustomerService\\CreateCustomerResponse',
      'SampleCustomer' => 'Visual\\CustomerService\\SampleCustomer',
      'SampleCustomerResponse' => 'Visual\\CustomerService\\SampleCustomerResponse',
      'SampleCustomerCD65' => 'Visual\\CustomerService\\SampleCustomerCD65',
      'SampleCustomerCD65Response' => 'Visual\\CustomerService\\SampleCustomerCD65Response',
      'TestSample' => 'Visual\\CustomerService\\TestSample',
      'TestSampleResponse' => 'Visual\\CustomerService\\TestSampleResponse',
      'TestUpdateCustomerAddress' => 'Visual\\CustomerService\\TestUpdateCustomerAddress',
      'TestUpdateCustomerAddressResponse' => 'Visual\\CustomerService\\TestUpdateCustomerAddressResponse',
      'AddNewAddress' => 'Visual\\CustomerService\\AddNewAddress',
      'AddNewAddressResponse' => 'Visual\\CustomerService\\AddNewAddressResponse',
      'AddressUseCount' => 'Visual\\CustomerService\\AddressUseCount',
      'AddressUseCountResponse' => 'Visual\\CustomerService\\AddressUseCountResponse',
      'TestAddressUseCount' => 'Visual\\CustomerService\\TestAddressUseCount',
      'TestAddressUseCountResponse' => 'Visual\\CustomerService\\TestAddressUseCountResponse',
      'SearchCustomer' => 'Visual\\CustomerService\\SearchCustomer',
      'SearchCustomerResponse' => 'Visual\\CustomerService\\SearchCustomerResponse',
      'SearchCustomerLike' => 'Visual\\CustomerService\\SearchCustomerLike',
      'SearchCustomerLikeResponse' => 'Visual\\CustomerService\\SearchCustomerLikeResponse',
      'TestSearchCustomer' => 'Visual\\CustomerService\\TestSearchCustomer',
      'TestSearchCustomerResponse' => 'Visual\\CustomerService\\TestSearchCustomerResponse',
      'SearchAddress' => 'Visual\\CustomerService\\SearchAddress',
      'AddressData' => 'Visual\\CustomerService\\AddressData',
      'SearchAddressResponse' => 'Visual\\CustomerService\\SearchAddressResponse',
      'SearchAddressLike' => 'Visual\\CustomerService\\SearchAddressLike',
      'SearchAddressLikeResponse' => 'Visual\\CustomerService\\SearchAddressLikeResponse',
      'TestSearchAdderess' => 'Visual\\CustomerService\\TestSearchAdderess',
      'TestSearchAdderessResponse' => 'Visual\\CustomerService\\TestSearchAdderessResponse',
      'AvailableCredit' => 'Visual\\CustomerService\\AvailableCredit',
      'AvailableCreditResponse' => 'Visual\\CustomerService\\AvailableCreditResponse',
      'TestAvailableCredit' => 'Visual\\CustomerService\\TestAvailableCredit',
      'TestAvailableCreditResponse' => 'Visual\\CustomerService\\TestAvailableCreditResponse',
      'TestGetCustomerList' => 'Visual\\CustomerService\\TestGetCustomerList',
      'TestGetCustomerListResponse' => 'Visual\\CustomerService\\TestGetCustomerListResponse',
      'CustomerDataResponse' => 'Visual\\CustomerService\\CustomerDataResponse',
      'BaseDataResponse' => 'Visual\\CustomerService\\BaseDataResponse',
      'ArrayOfCustomerListItem' => 'Visual\\CustomerService\\ArrayOfCustomerListItem',
      'CustomerListItem' => 'Visual\\CustomerService\\CustomerListItem',
      'GetCustomerList' => 'Visual\\CustomerService\\GetCustomerList',
      'GetCustomerListResponse' => 'Visual\\CustomerService\\GetCustomerListResponse',
      'CurrentVersion' => 'Visual\\CustomerService\\CurrentVersion',
      'CurrentVersionResponse' => 'Visual\\CustomerService\\CurrentVersionResponse',
      'LoginCreds' => 'Visual\\CustomerService\\LoginCreds',
      'LoginCredsResponse' => 'Visual\\CustomerService\\LoginCredsResponse',
      'NextNumberGenAppenditure' => 'Visual\\CustomerService\\NextNumberGenAppenditure',
      'NextNumberGenAppenditureResponse' => 'Visual\\CustomerService\\NextNumberGenAppenditureResponse',
      'UserPermission' => 'Visual\\CustomerService\\UserPermission',
      'UserPermissionResponse' => 'Visual\\CustomerService\\UserPermissionResponse',
      'NextNumberGen2' => 'Visual\\CustomerService\\NextNumberGen2',
      'NextNumberGen2Response' => 'Visual\\CustomerService\\NextNumberGen2Response',
      'InstallSchemaDatabaseLogMessage' => 'Visual\\CustomerService\\InstallSchemaDatabaseLogMessage',
      'InstallSchemaDatabaseLogMessageResponse' => 'Visual\\CustomerService\\InstallSchemaDatabaseLogMessageResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'https://slvisual.shelterlogicdirect.com/derp/CustomerService.asmx?wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      parent::__construct($wsdl, $options);
    }

    /**
     * @param SampleXML $parameters
     * @return SampleXMLResponse
     */
    public function SampleXML(SampleXML $parameters)
    {
      return $this->__soapCall('SampleXML', array($parameters));
    }

    /**
     * @param ConfigureNextNumberGen $parameters
     * @return ConfigureNextNumberGenResponse
     */
    public function ConfigureNextNumberGen(ConfigureNextNumberGen $parameters)
    {
      return $this->__soapCall('ConfigureNextNumberGen', array($parameters));
    }

    /**
     * @param GetShipViaCodes2 $parameters
     * @return GetShipViaCodes2Response
     */
    public function GetShipViaCodes2(GetShipViaCodes2 $parameters)
    {
      return $this->__soapCall('GetShipViaCodes2', array($parameters));
    }

    /**
     * @param GetDefaultCustomerShipViaCode2 $parameters
     * @return GetDefaultCustomerShipViaCode2Response
     */
    public function GetDefaultCustomerShipViaCode2(GetDefaultCustomerShipViaCode2 $parameters)
    {
      return $this->__soapCall('GetDefaultCustomerShipViaCode2', array($parameters));
    }

    /**
     * @param GetDefaultCustomerShipViaCode $parameters
     * @return GetDefaultCustomerShipViaCodeResponse
     */
    public function GetDefaultCustomerShipViaCode(GetDefaultCustomerShipViaCode $parameters)
    {
      return $this->__soapCall('GetDefaultCustomerShipViaCode', array($parameters));
    }

    /**
     * @param GetShipViaCodes $parameters
     * @return GetShipViaCodesResponse
     */
    public function GetShipViaCodes(GetShipViaCodes $parameters)
    {
      return $this->__soapCall('GetShipViaCodes', array($parameters));
    }

    /**
     * @param PurchaseOrderIDExists $parameters
     * @return PurchaseOrderIDExistsResponse
     */
    public function PurchaseOrderIDExists(PurchaseOrderIDExists $parameters)
    {
      return $this->__soapCall('PurchaseOrderIDExists', array($parameters));
    }

    /**
     * @param PurchaseOrderIDExists2 $parameters
     * @return PurchaseOrderIDExists2Response
     */
    public function PurchaseOrderIDExists2(PurchaseOrderIDExists2 $parameters)
    {
      return $this->__soapCall('PurchaseOrderIDExists2', array($parameters));
    }

    /**
     * @param CreatePhoneCustomer2 $parameters
     * @return CreatePhoneCustomer2Response
     */
    public function CreatePhoneCustomer2(CreatePhoneCustomer2 $parameters)
    {
      return $this->__soapCall('CreatePhoneCustomer2', array($parameters));
    }

    /**
     * @param CreateCustomer2 $parameters
     * @return CreateCustomer2Response
     */
    public function CreateCustomer2(CreateCustomer2 $parameters)
    {
      return $this->__soapCall('CreateCustomer2', array($parameters));
    }

    /**
     * @param TestLoadCustomerDataByShipTO $parameters
     * @return TestLoadCustomerDataByShipTOResponse
     */
    public function TestLoadCustomerDataByShipTO(TestLoadCustomerDataByShipTO $parameters)
    {
      return $this->__soapCall('TestLoadCustomerDataByShipTO', array($parameters));
    }

    /**
     * @param LoadCustomerDataByShipTO2 $parameters
     * @return LoadCustomerDataByShipTO2Response
     */
    public function LoadCustomerDataByShipTO2(LoadCustomerDataByShipTO2 $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByShipTO2', array($parameters));
    }

    /**
     * @param LoadCustomerDataByShipTOUserDefined12 $parameters
     * @return LoadCustomerDataByShipTOUserDefined12Response
     */
    public function LoadCustomerDataByShipTOUserDefined12(LoadCustomerDataByShipTOUserDefined12 $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByShipTOUserDefined12', array($parameters));
    }

    /**
     * @param LoadCustomerDataByOrderID2 $parameters
     * @return LoadCustomerDataByOrderID2Response
     */
    public function LoadCustomerDataByOrderID2(LoadCustomerDataByOrderID2 $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByOrderID2', array($parameters));
    }

    /**
     * @param LoadCustomerDataByWebID $parameters
     * @return LoadCustomerDataByWebIDResponse
     */
    public function LoadCustomerDataByWebID(LoadCustomerDataByWebID $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByWebID', array($parameters));
    }

    /**
     * @param LoadShipTOByAddress $parameters
     * @return LoadShipTOByAddressResponse
     */
    public function LoadShipTOByAddress(LoadShipTOByAddress $parameters)
    {
      return $this->__soapCall('LoadShipTOByAddress', array($parameters));
    }

    /**
     * @param TestLoadCustomerDataByOrderID $parameters
     * @return TestLoadCustomerDataByOrderIDResponse
     */
    public function TestLoadCustomerDataByOrderID(TestLoadCustomerDataByOrderID $parameters)
    {
      return $this->__soapCall('TestLoadCustomerDataByOrderID', array($parameters));
    }

    /**
     * @param LokupWarehouseByID $parameters
     * @return LokupWarehouseByIDResponse
     */
    public function LokupWarehouseByID(LokupWarehouseByID $parameters)
    {
      return $this->__soapCall('LokupWarehouseByID', array($parameters));
    }

    /**
     * @param LookupNameByID $parameters
     * @return LookupNameByIDResponse
     */
    public function LookupNameByID(LookupNameByID $parameters)
    {
      return $this->__soapCall('LookupNameByID', array($parameters));
    }

    /**
     * @param LokupNameByID $parameters
     * @return LokupNameByIDResponse
     */
    public function LokupNameByID(LokupNameByID $parameters)
    {
      return $this->__soapCall('LokupNameByID', array($parameters));
    }

    /**
     * @param LoadCustomerDataByOrderID $parameters
     * @return LoadCustomerDataByOrderIDResponse
     */
    public function LoadCustomerDataByOrderID(LoadCustomerDataByOrderID $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByOrderID', array($parameters));
    }

    /**
     * @param LoadCustomerDataByShipTO $parameters
     * @return LoadCustomerDataByShipTOResponse
     */
    public function LoadCustomerDataByShipTO(LoadCustomerDataByShipTO $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByShipTO', array($parameters));
    }

    /**
     * @param LoadCustomerDataByShipTOUserDefined1 $parameters
     * @return LoadCustomerDataByShipTOUserDefined1Response
     */
    public function LoadCustomerDataByShipTOUserDefined1(LoadCustomerDataByShipTOUserDefined1 $parameters)
    {
      return $this->__soapCall('LoadCustomerDataByShipTOUserDefined1', array($parameters));
    }

    /**
     * @param CreateCustomer $parameters
     * @return CreateCustomerResponse
     */
    public function CreateCustomer(CreateCustomer $parameters)
    {
      return $this->__soapCall('CreateCustomer', array($parameters));
    }

    /**
     * @param SampleCustomer $parameters
     * @return SampleCustomerResponse
     */
    public function SampleCustomer(SampleCustomer $parameters)
    {
      return $this->__soapCall('SampleCustomer', array($parameters));
    }

    /**
     * @param SampleCustomerCD65 $parameters
     * @return SampleCustomerCD65Response
     */
    public function SampleCustomerCD65(SampleCustomerCD65 $parameters)
    {
      return $this->__soapCall('SampleCustomerCD65', array($parameters));
    }

    /**
     * @param TestSample $parameters
     * @return TestSampleResponse
     */
    public function TestSample(TestSample $parameters)
    {
      return $this->__soapCall('TestSample', array($parameters));
    }

    /**
     * @param TestUpdateCustomerAddress $parameters
     * @return TestUpdateCustomerAddressResponse
     */
    public function TestUpdateCustomerAddress(TestUpdateCustomerAddress $parameters)
    {
      return $this->__soapCall('TestUpdateCustomerAddress', array($parameters));
    }

    /**
     * @param AddNewAddress $parameters
     * @return AddNewAddressResponse
     */
    public function AddNewAddress(AddNewAddress $parameters)
    {
      return $this->__soapCall('AddNewAddress', array($parameters));
    }

    /**
     * @param AddressUseCount $parameters
     * @return AddressUseCountResponse
     */
    public function AddressUseCount(AddressUseCount $parameters)
    {
      return $this->__soapCall('AddressUseCount', array($parameters));
    }

    /**
     * @param TestAddressUseCount $parameters
     * @return TestAddressUseCountResponse
     */
    public function TestAddressUseCount(TestAddressUseCount $parameters)
    {
      return $this->__soapCall('TestAddressUseCount', array($parameters));
    }

    /**
     * @param SearchCustomer $parameters
     * @return SearchCustomerResponse
     */
    public function SearchCustomer(SearchCustomer $parameters)
    {
      return $this->__soapCall('SearchCustomer', array($parameters));
    }

    /**
     * @param SearchCustomerLike $parameters
     * @return SearchCustomerLikeResponse
     */
    public function SearchCustomerLike(SearchCustomerLike $parameters)
    {
      return $this->__soapCall('SearchCustomerLike', array($parameters));
    }

    /**
     * @param TestSearchCustomer $parameters
     * @return TestSearchCustomerResponse
     */
    public function TestSearchCustomer(TestSearchCustomer $parameters)
    {
      return $this->__soapCall('TestSearchCustomer', array($parameters));
    }

    /**
     * @param SearchAddress $parameters
     * @return SearchAddressResponse
     */
    public function SearchAddress(SearchAddress $parameters)
    {
      return $this->__soapCall('SearchAddress', array($parameters));
    }

    /**
     * @param SearchAddressLike $parameters
     * @return SearchAddressLikeResponse
     */
    public function SearchAddressLike(SearchAddressLike $parameters)
    {
      return $this->__soapCall('SearchAddressLike', array($parameters));
    }

    /**
     * @param TestSearchAdderess $parameters
     * @return TestSearchAdderessResponse
     */
    public function TestSearchAdderess(TestSearchAdderess $parameters)
    {
      return $this->__soapCall('TestSearchAdderess', array($parameters));
    }

    /**
     * @param AvailableCredit $parameters
     * @return AvailableCreditResponse
     */
    public function AvailableCredit(AvailableCredit $parameters)
    {
      return $this->__soapCall('AvailableCredit', array($parameters));
    }

    /**
     * @param TestAvailableCredit $parameters
     * @return TestAvailableCreditResponse
     */
    public function TestAvailableCredit(TestAvailableCredit $parameters)
    {
      return $this->__soapCall('TestAvailableCredit', array($parameters));
    }

    /**
     * @param TestGetCustomerList $parameters
     * @return TestGetCustomerListResponse
     */
    public function TestGetCustomerList(TestGetCustomerList $parameters)
    {
      return $this->__soapCall('TestGetCustomerList', array($parameters));
    }

    /**
     * @param GetCustomerList $parameters
     * @return GetCustomerListResponse
     */
    public function GetCustomerList(GetCustomerList $parameters)
    {
      return $this->__soapCall('GetCustomerList', array($parameters));
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
