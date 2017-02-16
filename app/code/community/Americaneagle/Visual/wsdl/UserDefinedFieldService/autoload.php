<?php


 function autoload_9920613d2650ec01a6b74abfdc33d2c5($class)
{
    $classes = array(
        'Visual\UserDefinedFieldService\UserDefinedFieldService' => __DIR__ .'/UserDefinedFieldService.php',
        'Visual\UserDefinedFieldService\SaveUserDefined' => __DIR__ .'/SaveUserDefined.php',
        'Visual\UserDefinedFieldService\UserDefinedData' => __DIR__ .'/UserDefinedData.php',
        'Visual\UserDefinedFieldService\BaseDataRequest' => __DIR__ .'/BaseDataRequest.php',
        'Visual\UserDefinedFieldService\ArrayOfUserDefinedFieldValue' => __DIR__ .'/ArrayOfUserDefinedFieldValue.php',
        'Visual\UserDefinedFieldService\UserDefinedFieldValue' => __DIR__ .'/UserDefinedFieldValue.php',
        'Visual\UserDefinedFieldService\UserDefinedFieldLabel' => __DIR__ .'/UserDefinedFieldLabel.php',
        'Visual\UserDefinedFieldService\TabOrTableEnum' => __DIR__ .'/TabOrTableEnum.php',
        'Visual\UserDefinedFieldService\SaveUserDefinedResponse' => __DIR__ .'/SaveUserDefinedResponse.php',
        'Visual\UserDefinedFieldService\UserDefinedDataResponse' => __DIR__ .'/UserDefinedDataResponse.php',
        'Visual\UserDefinedFieldService\BaseDataResponse' => __DIR__ .'/BaseDataResponse.php',
        'Visual\UserDefinedFieldService\ArrayOfUserDefinedFieldValueResponse' => __DIR__ .'/ArrayOfUserDefinedFieldValueResponse.php',
        'Visual\UserDefinedFieldService\UserDefinedFieldValueResponse' => __DIR__ .'/UserDefinedFieldValueResponse.php',
        'Visual\UserDefinedFieldService\BaseObjectResponse' => __DIR__ .'/BaseObjectResponse.php',
        'Visual\UserDefinedFieldService\Header' => __DIR__ .'/Header.php',
        'Visual\UserDefinedFieldService\SaveUserDefined2' => __DIR__ .'/SaveUserDefined2.php',
        'Visual\UserDefinedFieldService\SaveUserDefined2Response' => __DIR__ .'/SaveUserDefined2Response.php',
        'Visual\UserDefinedFieldService\Test' => __DIR__ .'/Test.php',
        'Visual\UserDefinedFieldService\TestResponse' => __DIR__ .'/TestResponse.php',
        'Visual\UserDefinedFieldService\CreateUDF' => __DIR__ .'/CreateUDF.php',
        'Visual\UserDefinedFieldService\UDFData' => __DIR__ .'/UDFData.php',
        'Visual\UserDefinedFieldService\ArrayOfUDFValue' => __DIR__ .'/ArrayOfUDFValue.php',
        'Visual\UserDefinedFieldService\UDFValue' => __DIR__ .'/UDFValue.php',
        'Visual\UserDefinedFieldService\CreateUDFResponse' => __DIR__ .'/CreateUDFResponse.php',
        'Visual\UserDefinedFieldService\UDFDataResponse' => __DIR__ .'/UDFDataResponse.php',
        'Visual\UserDefinedFieldService\ArrayOfUDFValueResponse' => __DIR__ .'/ArrayOfUDFValueResponse.php',
        'Visual\UserDefinedFieldService\UDFValueResponse' => __DIR__ .'/UDFValueResponse.php',
        'Visual\UserDefinedFieldService\ArrayOfUDFLabelResponse' => __DIR__ .'/ArrayOfUDFLabelResponse.php',
        'Visual\UserDefinedFieldService\UDFLabelResponse' => __DIR__ .'/UDFLabelResponse.php',
        'Visual\UserDefinedFieldService\UDFLabel' => __DIR__ .'/UDFLabel.php',
        'Visual\UserDefinedFieldService\DataTypeEnum' => __DIR__ .'/DataTypeEnum.php',
        'Visual\UserDefinedFieldService\LabelTabOrTableEnum' => __DIR__ .'/LabelTabOrTableEnum.php',
        'Visual\UserDefinedFieldService\TestCreateUserDefined' => __DIR__ .'/TestCreateUserDefined.php',
        'Visual\UserDefinedFieldService\TestCreateUserDefinedResponse' => __DIR__ .'/TestCreateUserDefinedResponse.php',
        'Visual\UserDefinedFieldService\SearchUserDefined' => __DIR__ .'/SearchUserDefined.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedResponse' => __DIR__ .'/SearchUserDefinedResponse.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLike' => __DIR__ .'/SearchUserDefinedLike.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLikeResponse' => __DIR__ .'/SearchUserDefinedLikeResponse.php',
        'Visual\UserDefinedFieldService\TestSearchUserDefined' => __DIR__ .'/TestSearchUserDefined.php',
        'Visual\UserDefinedFieldService\TestSearchUserDefinedResponse' => __DIR__ .'/TestSearchUserDefinedResponse.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLabel' => __DIR__ .'/SearchUserDefinedLabel.php',
        'Visual\UserDefinedFieldService\UDFLabels' => __DIR__ .'/UDFLabels.php',
        'Visual\UserDefinedFieldService\ArrayOfUDFLabel' => __DIR__ .'/ArrayOfUDFLabel.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLabelResponse' => __DIR__ .'/SearchUserDefinedLabelResponse.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLabelLike' => __DIR__ .'/SearchUserDefinedLabelLike.php',
        'Visual\UserDefinedFieldService\SearchUserDefinedLabelLikeResponse' => __DIR__ .'/SearchUserDefinedLabelLikeResponse.php',
        'Visual\UserDefinedFieldService\TestSearchUserDefinedLabel' => __DIR__ .'/TestSearchUserDefinedLabel.php',
        'Visual\UserDefinedFieldService\TestSearchUserDefinedLabelResponse' => __DIR__ .'/TestSearchUserDefinedLabelResponse.php',
        'Visual\UserDefinedFieldService\CurrentVersion' => __DIR__ .'/CurrentVersion.php',
        'Visual\UserDefinedFieldService\CurrentVersionResponse' => __DIR__ .'/CurrentVersionResponse.php',
        'Visual\UserDefinedFieldService\LoginCreds' => __DIR__ .'/LoginCreds.php',
        'Visual\UserDefinedFieldService\LoginCredsResponse' => __DIR__ .'/LoginCredsResponse.php',
        'Visual\UserDefinedFieldService\NextNumberGenAppenditure' => __DIR__ .'/NextNumberGenAppenditure.php',
        'Visual\UserDefinedFieldService\NextNumberGenAppenditureResponse' => __DIR__ .'/NextNumberGenAppenditureResponse.php',
        'Visual\UserDefinedFieldService\UserPermission' => __DIR__ .'/UserPermission.php',
        'Visual\UserDefinedFieldService\UserPermissionResponse' => __DIR__ .'/UserPermissionResponse.php',
        'Visual\UserDefinedFieldService\UserPermissionEnum' => __DIR__ .'/UserPermissionEnum.php',
        'Visual\UserDefinedFieldService\NextNumberGen2' => __DIR__ .'/NextNumberGen2.php',
        'Visual\UserDefinedFieldService\NextNumberGen2Response' => __DIR__ .'/NextNumberGen2Response.php',
        'Visual\UserDefinedFieldService\InstallSchemaDatabaseLogMessage' => __DIR__ .'/InstallSchemaDatabaseLogMessage.php',
        'Visual\UserDefinedFieldService\InstallSchemaDatabaseLogMessageResponse' => __DIR__ .'/InstallSchemaDatabaseLogMessageResponse.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_9920613d2650ec01a6b74abfdc33d2c5', true, true);

// Do nothing. The rest is just leftovers from the code generation.
{
}
