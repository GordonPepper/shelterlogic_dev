<?php

namespace Visual\SalesOrderService;

class SalesOrderService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'CustomerOrderDS' => 'Visual\\SalesOrderService\\CustomerOrderDS',
      'CUSTOMER_ORDER' => 'Visual\\SalesOrderService\\CUSTOMER_ORDER',
      'TestGetEmailAddress' => 'Visual\\SalesOrderService\\TestGetEmailAddress',
      'TestGetEmailAddressResponse' => 'Visual\\SalesOrderService\\TestGetEmailAddressResponse',
      'GetEmailAddress2' => 'Visual\\SalesOrderService\\GetEmailAddress2',
      'GetEmailAddress2Response' => 'Visual\\SalesOrderService\\GetEmailAddress2Response',
      'GetEmailAddress' => 'Visual\\SalesOrderService\\GetEmailAddress',
      'GetEmailAddressResponse' => 'Visual\\SalesOrderService\\GetEmailAddressResponse',
      'Header' => 'Visual\\SalesOrderService\\Header',
      'CreateSalesOrder' => 'Visual\\SalesOrderService\\CreateSalesOrder',
      'CustomerOrderData' => 'Visual\\SalesOrderService\\CustomerOrderData',
      'BaseDataRequest' => 'Visual\\SalesOrderService\\BaseDataRequest',
      'ArrayOfCustomerOrderHeader' => 'Visual\\SalesOrderService\\ArrayOfCustomerOrderHeader',
      'CustomerOrderHeader' => 'Visual\\SalesOrderService\\CustomerOrderHeader',
      'ExternalReference' => 'Visual\\SalesOrderService\\ExternalReference',
      'ArrayOfReference' => 'Visual\\SalesOrderService\\ArrayOfReference',
      'Reference' => 'Visual\\SalesOrderService\\Reference',
      'CustomerOrderLine' => 'Visual\\SalesOrderService\\CustomerOrderLine',
      'CFG8Data' => 'Visual\\SalesOrderService\\CFG8Data',
      'ArrayOfUserDefinedFieldValue' => 'Visual\\SalesOrderService\\ArrayOfUserDefinedFieldValue',
      'UserDefinedFieldValue' => 'Visual\\SalesOrderService\\UserDefinedFieldValue',
      'UserDefinedFieldLabel' => 'Visual\\SalesOrderService\\UserDefinedFieldLabel',
      'ArrayOfUDFValue' => 'Visual\\SalesOrderService\\ArrayOfUDFValue',
      'UDFValue' => 'Visual\\SalesOrderService\\UDFValue',
      'ArrayOfCustomerOrderLine' => 'Visual\\SalesOrderService\\ArrayOfCustomerOrderLine',
      'NewOrderPayment' => 'Visual\\SalesOrderService\\NewOrderPayment',
      'CreateSalesOrderResponse' => 'Visual\\SalesOrderService\\CreateSalesOrderResponse',
      'CustomerOrderDataResponse' => 'Visual\\SalesOrderService\\CustomerOrderDataResponse',
      'BaseDataResponse' => 'Visual\\SalesOrderService\\BaseDataResponse',
      'ArrayOfCustomerOrderHeaderResponse' => 'Visual\\SalesOrderService\\ArrayOfCustomerOrderHeaderResponse',
      'CustomerOrderHeaderResponse' => 'Visual\\SalesOrderService\\CustomerOrderHeaderResponse',
      'BaseObjectResponse' => 'Visual\\SalesOrderService\\BaseObjectResponse',
      'CreateSalesOrder2' => 'Visual\\SalesOrderService\\CreateSalesOrder2',
      'CreateSalesOrder2Response' => 'Visual\\SalesOrderService\\CreateSalesOrder2Response',
      'SampleOrder' => 'Visual\\SalesOrderService\\SampleOrder',
      'SampleOrderResponse' => 'Visual\\SalesOrderService\\SampleOrderResponse',
      'SampleEDIOrder' => 'Visual\\SalesOrderService\\SampleEDIOrder',
      'SampleEDIOrderResponse' => 'Visual\\SalesOrderService\\SampleEDIOrderResponse',
      'SampleOrderCD65' => 'Visual\\SalesOrderService\\SampleOrderCD65',
      'SampleOrderCD65Response' => 'Visual\\SalesOrderService\\SampleOrderCD65Response',
      'SampleCUDFOrder' => 'Visual\\SalesOrderService\\SampleCUDFOrder',
      'SampleCUDFOrderResponse' => 'Visual\\SalesOrderService\\SampleCUDFOrderResponse',
      'CreateSampleOrder' => 'Visual\\SalesOrderService\\CreateSampleOrder',
      'CreateSampleOrderResponse' => 'Visual\\SalesOrderService\\CreateSampleOrderResponse',
      'TestSetPrintedDate' => 'Visual\\SalesOrderService\\TestSetPrintedDate',
      'TestSetPrintedDateResponse' => 'Visual\\SalesOrderService\\TestSetPrintedDateResponse',
      'TestBadOrder' => 'Visual\\SalesOrderService\\TestBadOrder',
      'TestBadOrderResponse' => 'Visual\\SalesOrderService\\TestBadOrderResponse',
      'CDStoreSample' => 'Visual\\SalesOrderService\\CDStoreSample',
      'CDStoreSampleResponse' => 'Visual\\SalesOrderService\\CDStoreSampleResponse',
      'Test_LoadUnPrintedOrders' => 'Visual\\SalesOrderService\\Test_LoadUnPrintedOrders',
      'Test_LoadUnPrintedOrdersResponse' => 'Visual\\SalesOrderService\\Test_LoadUnPrintedOrdersResponse',
      'Test_LoadUnPrintedOrdersResult' => 'Visual\\SalesOrderService\\Test_LoadUnPrintedOrdersResult',
      'TestSearchCustomerOrder' => 'Visual\\SalesOrderService\\TestSearchCustomerOrder',
      'TestSearchCustomerOrderResponse' => 'Visual\\SalesOrderService\\TestSearchCustomerOrderResponse',
      'SearchCustomerOrder' => 'Visual\\SalesOrderService\\SearchCustomerOrder',
      'SearchCustomerOrderResponse' => 'Visual\\SalesOrderService\\SearchCustomerOrderResponse',
      'SearchCustomerOrderLike' => 'Visual\\SalesOrderService\\SearchCustomerOrderLike',
      'SearchCustomerOrderLikeResponse' => 'Visual\\SalesOrderService\\SearchCustomerOrderLikeResponse',
      'CurrentVersion' => 'Visual\\SalesOrderService\\CurrentVersion',
      'CurrentVersionResponse' => 'Visual\\SalesOrderService\\CurrentVersionResponse',
      'LoginCreds' => 'Visual\\SalesOrderService\\LoginCreds',
      'LoginCredsResponse' => 'Visual\\SalesOrderService\\LoginCredsResponse',
      'NextNumberGenAppenditure' => 'Visual\\SalesOrderService\\NextNumberGenAppenditure',
      'NextNumberGenAppenditureResponse' => 'Visual\\SalesOrderService\\NextNumberGenAppenditureResponse',
      'UserPermission' => 'Visual\\SalesOrderService\\UserPermission',
      'UserPermissionResponse' => 'Visual\\SalesOrderService\\UserPermissionResponse',
      'NextNumberGen2' => 'Visual\\SalesOrderService\\NextNumberGen2',
      'NextNumberGen2Response' => 'Visual\\SalesOrderService\\NextNumberGen2Response',
      'InstallSchemaDatabaseLogMessage' => 'Visual\\SalesOrderService\\InstallSchemaDatabaseLogMessage',
      'InstallSchemaDatabaseLogMessageResponse' => 'Visual\\SalesOrderService\\InstallSchemaDatabaseLogMessageResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'https://slvisual.shelterlogicdirect.com/derp/SalesOrderService.asmx?wsdl')
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
     * @param TestGetEmailAddress $parameters
     * @return TestGetEmailAddressResponse
     */
    public function TestGetEmailAddress(TestGetEmailAddress $parameters)
    {
      return $this->__soapCall('TestGetEmailAddress', array($parameters));
    }

    /**
     * @param GetEmailAddress2 $parameters
     * @return GetEmailAddress2Response
     */
    public function GetEmailAddress2(GetEmailAddress2 $parameters)
    {
      return $this->__soapCall('GetEmailAddress2', array($parameters));
    }

    /**
     * @param GetEmailAddress $parameters
     * @return GetEmailAddressResponse
     */
    public function GetEmailAddress(GetEmailAddress $parameters)
    {
      return $this->__soapCall('GetEmailAddress', array($parameters));
    }

    /**
     * @param CreateSalesOrder $parameters
     * @return CreateSalesOrderResponse
     */
    public function CreateSalesOrder(CreateSalesOrder $parameters)
    {
      return $this->__soapCall('CreateSalesOrder', array($parameters));
    }

    /**
     * @param CreateSalesOrder2 $parameters
     * @return CreateSalesOrder2Response
     */
    public function CreateSalesOrder2(CreateSalesOrder2 $parameters)
    {
      return $this->__soapCall('CreateSalesOrder2', array($parameters));
    }

    /**
     * @param SampleOrder $parameters
     * @return SampleOrderResponse
     */
    public function SampleOrder(SampleOrder $parameters)
    {
      return $this->__soapCall('SampleOrder', array($parameters));
    }

    /**
     * @param SampleEDIOrder $parameters
     * @return SampleEDIOrderResponse
     */
    public function SampleEDIOrder(SampleEDIOrder $parameters)
    {
      return $this->__soapCall('SampleEDIOrder', array($parameters));
    }

    /**
     * @param SampleOrderCD65 $parameters
     * @return SampleOrderCD65Response
     */
    public function SampleOrderCD65(SampleOrderCD65 $parameters)
    {
      return $this->__soapCall('SampleOrderCD65', array($parameters));
    }

    /**
     * @param SampleCUDFOrder $parameters
     * @return SampleCUDFOrderResponse
     */
    public function SampleCUDFOrder(SampleCUDFOrder $parameters)
    {
      return $this->__soapCall('SampleCUDFOrder', array($parameters));
    }

    /**
     * @param CreateSampleOrder $parameters
     * @return CreateSampleOrderResponse
     */
    public function CreateSampleOrder(CreateSampleOrder $parameters)
    {
      return $this->__soapCall('CreateSampleOrder', array($parameters));
    }

    /**
     * @param TestSetPrintedDate $parameters
     * @return TestSetPrintedDateResponse
     */
    public function TestSetPrintedDate(TestSetPrintedDate $parameters)
    {
      return $this->__soapCall('TestSetPrintedDate', array($parameters));
    }

    /**
     * @param TestBadOrder $parameters
     * @return TestBadOrderResponse
     */
    public function TestBadOrder(TestBadOrder $parameters)
    {
      return $this->__soapCall('TestBadOrder', array($parameters));
    }

    /**
     * @param CDStoreSample $parameters
     * @return CDStoreSampleResponse
     */
    public function CDStoreSample(CDStoreSample $parameters)
    {
      return $this->__soapCall('CDStoreSample', array($parameters));
    }

    /**
     * @param Test_LoadUnPrintedOrders $parameters
     * @return Test_LoadUnPrintedOrdersResponse
     */
    public function Test_LoadUnPrintedOrders(Test_LoadUnPrintedOrders $parameters)
    {
      return $this->__soapCall('Test_LoadUnPrintedOrders', array($parameters));
    }

    /**
     * @param TestSearchCustomerOrder $parameters
     * @return TestSearchCustomerOrderResponse
     */
    public function TestSearchCustomerOrder(TestSearchCustomerOrder $parameters)
    {
      return $this->__soapCall('TestSearchCustomerOrder', array($parameters));
    }

    /**
     * @param SearchCustomerOrder $parameters
     * @return SearchCustomerOrderResponse
     */
    public function SearchCustomerOrder(SearchCustomerOrder $parameters)
    {
      return $this->__soapCall('SearchCustomerOrder', array($parameters));
    }

    /**
     * @param SearchCustomerOrderLike $parameters
     * @return SearchCustomerOrderLikeResponse
     */
    public function SearchCustomerOrderLike(SearchCustomerOrderLike $parameters)
    {
      return $this->__soapCall('SearchCustomerOrderLike', array($parameters));
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
