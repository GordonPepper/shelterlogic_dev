<?php


 function autoload_7ba7749498bb10ad4aef3a95a4bfc4d6($class)
{
    $classes = array(
        'Visual\SalesOrderService\SalesOrderService' => __DIR__ .'/SalesOrderService.php',
        'Visual\SalesOrderService\CustomerOrderDS' => __DIR__ .'/CustomerOrderDS.php',
        'Visual\SalesOrderService\CUSTOMER_ORDER' => __DIR__ .'/CUSTOMER_ORDER.php',
        'Visual\SalesOrderService\TestGetEmailAddress' => __DIR__ .'/TestGetEmailAddress.php',
        'Visual\SalesOrderService\TestGetEmailAddressResponse' => __DIR__ .'/TestGetEmailAddressResponse.php',
        'Visual\SalesOrderService\GetEmailAddress2' => __DIR__ .'/GetEmailAddress2.php',
        'Visual\SalesOrderService\GetEmailAddress2Response' => __DIR__ .'/GetEmailAddress2Response.php',
        'Visual\SalesOrderService\GetEmailAddress' => __DIR__ .'/GetEmailAddress.php',
        'Visual\SalesOrderService\GetEmailAddressResponse' => __DIR__ .'/GetEmailAddressResponse.php',
        'Visual\SalesOrderService\Header' => __DIR__ .'/Header.php',
        'Visual\SalesOrderService\CreateSalesOrder' => __DIR__ .'/CreateSalesOrder.php',
        'Visual\SalesOrderService\CustomerOrderData' => __DIR__ .'/CustomerOrderData.php',
        'Visual\SalesOrderService\BaseDataRequest' => __DIR__ .'/BaseDataRequest.php',
        'Visual\SalesOrderService\ArrayOfCustomerOrderHeader' => __DIR__ .'/ArrayOfCustomerOrderHeader.php',
        'Visual\SalesOrderService\CustomerOrderHeader' => __DIR__ .'/CustomerOrderHeader.php',
        'Visual\SalesOrderService\ExternalReference' => __DIR__ .'/ExternalReference.php',
        'Visual\SalesOrderService\ArrayOfReference' => __DIR__ .'/ArrayOfReference.php',
        'Visual\SalesOrderService\Reference' => __DIR__ .'/Reference.php',
        'Visual\SalesOrderService\CustomerOrderLine' => __DIR__ .'/CustomerOrderLine.php',
        'Visual\SalesOrderService\CFG8Data' => __DIR__ .'/CFG8Data.php',
        'Visual\SalesOrderService\ArrayOfUserDefinedFieldValue' => __DIR__ .'/ArrayOfUserDefinedFieldValue.php',
        'Visual\SalesOrderService\UserDefinedFieldValue' => __DIR__ .'/UserDefinedFieldValue.php',
        'Visual\SalesOrderService\UserDefinedFieldLabel' => __DIR__ .'/UserDefinedFieldLabel.php',
        'Visual\SalesOrderService\TabOrTableEnum' => __DIR__ .'/TabOrTableEnum.php',
        'Visual\SalesOrderService\ArrayOfUDFValue' => __DIR__ .'/ArrayOfUDFValue.php',
        'Visual\SalesOrderService\UDFValue' => __DIR__ .'/UDFValue.php',
        'Visual\SalesOrderService\ArrayOfCustomerOrderLine' => __DIR__ .'/ArrayOfCustomerOrderLine.php',
        'Visual\SalesOrderService\NewOrderPayment' => __DIR__ .'/NewOrderPayment.php',
        'Visual\SalesOrderService\CreateSalesOrderResponse' => __DIR__ .'/CreateSalesOrderResponse.php',
        'Visual\SalesOrderService\CustomerOrderDataResponse' => __DIR__ .'/CustomerOrderDataResponse.php',
        'Visual\SalesOrderService\BaseDataResponse' => __DIR__ .'/BaseDataResponse.php',
        'Visual\SalesOrderService\ArrayOfCustomerOrderHeaderResponse' => __DIR__ .'/ArrayOfCustomerOrderHeaderResponse.php',
        'Visual\SalesOrderService\CustomerOrderHeaderResponse' => __DIR__ .'/CustomerOrderHeaderResponse.php',
        'Visual\SalesOrderService\BaseObjectResponse' => __DIR__ .'/BaseObjectResponse.php',
        'Visual\SalesOrderService\CreateSalesOrder2' => __DIR__ .'/CreateSalesOrder2.php',
        'Visual\SalesOrderService\CreateSalesOrder2Response' => __DIR__ .'/CreateSalesOrder2Response.php',
        'Visual\SalesOrderService\SampleOrder' => __DIR__ .'/SampleOrder.php',
        'Visual\SalesOrderService\SampleOrderResponse' => __DIR__ .'/SampleOrderResponse.php',
        'Visual\SalesOrderService\SampleEDIOrder' => __DIR__ .'/SampleEDIOrder.php',
        'Visual\SalesOrderService\SampleEDIOrderResponse' => __DIR__ .'/SampleEDIOrderResponse.php',
        'Visual\SalesOrderService\SampleOrderCD65' => __DIR__ .'/SampleOrderCD65.php',
        'Visual\SalesOrderService\SampleOrderCD65Response' => __DIR__ .'/SampleOrderCD65Response.php',
        'Visual\SalesOrderService\SampleCUDFOrder' => __DIR__ .'/SampleCUDFOrder.php',
        'Visual\SalesOrderService\SampleCUDFOrderResponse' => __DIR__ .'/SampleCUDFOrderResponse.php',
        'Visual\SalesOrderService\CreateSampleOrder' => __DIR__ .'/CreateSampleOrder.php',
        'Visual\SalesOrderService\CreateSampleOrderResponse' => __DIR__ .'/CreateSampleOrderResponse.php',
        'Visual\SalesOrderService\TestSetPrintedDate' => __DIR__ .'/TestSetPrintedDate.php',
        'Visual\SalesOrderService\TestSetPrintedDateResponse' => __DIR__ .'/TestSetPrintedDateResponse.php',
        'Visual\SalesOrderService\TestBadOrder' => __DIR__ .'/TestBadOrder.php',
        'Visual\SalesOrderService\TestBadOrderResponse' => __DIR__ .'/TestBadOrderResponse.php',
        'Visual\SalesOrderService\CDStoreSample' => __DIR__ .'/CDStoreSample.php',
        'Visual\SalesOrderService\CDStoreSampleResponse' => __DIR__ .'/CDStoreSampleResponse.php',
        'Visual\SalesOrderService\Test_LoadUnPrintedOrders' => __DIR__ .'/Test_LoadUnPrintedOrders.php',
        'Visual\SalesOrderService\Test_LoadUnPrintedOrdersResponse' => __DIR__ .'/Test_LoadUnPrintedOrdersResponse.php',
        'Visual\SalesOrderService\Test_LoadUnPrintedOrdersResult' => __DIR__ .'/Test_LoadUnPrintedOrdersResult.php',
        'Visual\SalesOrderService\TestSearchCustomerOrder' => __DIR__ .'/TestSearchCustomerOrder.php',
        'Visual\SalesOrderService\TestSearchCustomerOrderResponse' => __DIR__ .'/TestSearchCustomerOrderResponse.php',
        'Visual\SalesOrderService\SearchCustomerOrder' => __DIR__ .'/SearchCustomerOrder.php',
        'Visual\SalesOrderService\SearchCustomerOrderResponse' => __DIR__ .'/SearchCustomerOrderResponse.php',
        'Visual\SalesOrderService\SearchCustomerOrderLike' => __DIR__ .'/SearchCustomerOrderLike.php',
        'Visual\SalesOrderService\SearchCustomerOrderLikeResponse' => __DIR__ .'/SearchCustomerOrderLikeResponse.php',
        'Visual\SalesOrderService\CurrentVersion' => __DIR__ .'/CurrentVersion.php',
        'Visual\SalesOrderService\CurrentVersionResponse' => __DIR__ .'/CurrentVersionResponse.php',
        'Visual\SalesOrderService\LoginCreds' => __DIR__ .'/LoginCreds.php',
        'Visual\SalesOrderService\LoginCredsResponse' => __DIR__ .'/LoginCredsResponse.php',
        'Visual\SalesOrderService\NextNumberGenAppenditure' => __DIR__ .'/NextNumberGenAppenditure.php',
        'Visual\SalesOrderService\NextNumberGenAppenditureResponse' => __DIR__ .'/NextNumberGenAppenditureResponse.php',
        'Visual\SalesOrderService\UserPermission' => __DIR__ .'/UserPermission.php',
        'Visual\SalesOrderService\UserPermissionResponse' => __DIR__ .'/UserPermissionResponse.php',
        'Visual\SalesOrderService\UserPermissionEnum' => __DIR__ .'/UserPermissionEnum.php',
        'Visual\SalesOrderService\NextNumberGen2' => __DIR__ .'/NextNumberGen2.php',
        'Visual\SalesOrderService\NextNumberGen2Response' => __DIR__ .'/NextNumberGen2Response.php',
        'Visual\SalesOrderService\InstallSchemaDatabaseLogMessage' => __DIR__ .'/InstallSchemaDatabaseLogMessage.php',
        'Visual\SalesOrderService\InstallSchemaDatabaseLogMessageResponse' => __DIR__ .'/InstallSchemaDatabaseLogMessageResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_7ba7749498bb10ad4aef3a95a4bfc4d6', true, true);

// Do nothing. The rest is just leftovers from the code generation.
{
}
