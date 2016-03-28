<?php

namespace Visual\UserDefinedFieldService;

class UserDefinedFieldService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'SaveUserDefined' => 'Visual\\UserDefinedFieldService\\SaveUserDefined',
      'UserDefinedData' => 'Visual\\UserDefinedFieldService\\UserDefinedData',
      'BaseDataRequest' => 'Visual\\UserDefinedFieldService\\BaseDataRequest',
      'ArrayOfUserDefinedFieldValue' => 'Visual\\UserDefinedFieldService\\ArrayOfUserDefinedFieldValue',
      'UserDefinedFieldValue' => 'Visual\\UserDefinedFieldService\\UserDefinedFieldValue',
      'UserDefinedFieldLabel' => 'Visual\\UserDefinedFieldService\\UserDefinedFieldLabel',
      'SaveUserDefinedResponse' => 'Visual\\UserDefinedFieldService\\SaveUserDefinedResponse',
      'UserDefinedDataResponse' => 'Visual\\UserDefinedFieldService\\UserDefinedDataResponse',
      'BaseDataResponse' => 'Visual\\UserDefinedFieldService\\BaseDataResponse',
      'ArrayOfUserDefinedFieldValueResponse' => 'Visual\\UserDefinedFieldService\\ArrayOfUserDefinedFieldValueResponse',
      'UserDefinedFieldValueResponse' => 'Visual\\UserDefinedFieldService\\UserDefinedFieldValueResponse',
      'BaseObjectResponse' => 'Visual\\UserDefinedFieldService\\BaseObjectResponse',
      'Header' => 'Visual\\UserDefinedFieldService\\Header',
      'SaveUserDefined2' => 'Visual\\UserDefinedFieldService\\SaveUserDefined2',
      'SaveUserDefined2Response' => 'Visual\\UserDefinedFieldService\\SaveUserDefined2Response',
      'Test' => 'Visual\\UserDefinedFieldService\\Test',
      'TestResponse' => 'Visual\\UserDefinedFieldService\\TestResponse',
      'CreateUDF' => 'Visual\\UserDefinedFieldService\\CreateUDF',
      'UDFData' => 'Visual\\UserDefinedFieldService\\UDFData',
      'ArrayOfUDFValue' => 'Visual\\UserDefinedFieldService\\ArrayOfUDFValue',
      'UDFValue' => 'Visual\\UserDefinedFieldService\\UDFValue',
      'CreateUDFResponse' => 'Visual\\UserDefinedFieldService\\CreateUDFResponse',
      'UDFDataResponse' => 'Visual\\UserDefinedFieldService\\UDFDataResponse',
      'ArrayOfUDFValueResponse' => 'Visual\\UserDefinedFieldService\\ArrayOfUDFValueResponse',
      'UDFValueResponse' => 'Visual\\UserDefinedFieldService\\UDFValueResponse',
      'ArrayOfUDFLabelResponse' => 'Visual\\UserDefinedFieldService\\ArrayOfUDFLabelResponse',
      'UDFLabelResponse' => 'Visual\\UserDefinedFieldService\\UDFLabelResponse',
      'UDFLabel' => 'Visual\\UserDefinedFieldService\\UDFLabel',
      'TestCreateUserDefined' => 'Visual\\UserDefinedFieldService\\TestCreateUserDefined',
      'TestCreateUserDefinedResponse' => 'Visual\\UserDefinedFieldService\\TestCreateUserDefinedResponse',
      'SearchUserDefined' => 'Visual\\UserDefinedFieldService\\SearchUserDefined',
      'SearchUserDefinedResponse' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedResponse',
      'SearchUserDefinedLike' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLike',
      'SearchUserDefinedLikeResponse' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLikeResponse',
      'TestSearchUserDefined' => 'Visual\\UserDefinedFieldService\\TestSearchUserDefined',
      'TestSearchUserDefinedResponse' => 'Visual\\UserDefinedFieldService\\TestSearchUserDefinedResponse',
      'SearchUserDefinedLabel' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLabel',
      'UDFLabels' => 'Visual\\UserDefinedFieldService\\UDFLabels',
      'ArrayOfUDFLabel' => 'Visual\\UserDefinedFieldService\\ArrayOfUDFLabel',
      'SearchUserDefinedLabelResponse' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLabelResponse',
      'SearchUserDefinedLabelLike' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLabelLike',
      'SearchUserDefinedLabelLikeResponse' => 'Visual\\UserDefinedFieldService\\SearchUserDefinedLabelLikeResponse',
      'TestSearchUserDefinedLabel' => 'Visual\\UserDefinedFieldService\\TestSearchUserDefinedLabel',
      'TestSearchUserDefinedLabelResponse' => 'Visual\\UserDefinedFieldService\\TestSearchUserDefinedLabelResponse',
      'CurrentVersion' => 'Visual\\UserDefinedFieldService\\CurrentVersion',
      'CurrentVersionResponse' => 'Visual\\UserDefinedFieldService\\CurrentVersionResponse',
      'LoginCreds' => 'Visual\\UserDefinedFieldService\\LoginCreds',
      'LoginCredsResponse' => 'Visual\\UserDefinedFieldService\\LoginCredsResponse',
      'NextNumberGenAppenditure' => 'Visual\\UserDefinedFieldService\\NextNumberGenAppenditure',
      'NextNumberGenAppenditureResponse' => 'Visual\\UserDefinedFieldService\\NextNumberGenAppenditureResponse',
      'UserPermission' => 'Visual\\UserDefinedFieldService\\UserPermission',
      'UserPermissionResponse' => 'Visual\\UserDefinedFieldService\\UserPermissionResponse',
      'NextNumberGen2' => 'Visual\\UserDefinedFieldService\\NextNumberGen2',
      'NextNumberGen2Response' => 'Visual\\UserDefinedFieldService\\NextNumberGen2Response',
      'InstallSchemaDatabaseLogMessage' => 'Visual\\UserDefinedFieldService\\InstallSchemaDatabaseLogMessage',
      'InstallSchemaDatabaseLogMessageResponse' => 'Visual\\UserDefinedFieldService\\InstallSchemaDatabaseLogMessageResponse',
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
        $wsdl = 'https://slvisual.shelterlogicdirect.com/derp/UserDefinedFieldService.asmx?wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param SaveUserDefined $parameters
     * @return SaveUserDefinedResponse
     */
    public function SaveUserDefined(SaveUserDefined $parameters)
    {
      return $this->__soapCall('SaveUserDefined', array($parameters));
    }

    /**
     * @param SaveUserDefined2 $parameters
     * @return SaveUserDefined2Response
     */
    public function SaveUserDefined2(SaveUserDefined2 $parameters)
    {
      return $this->__soapCall('SaveUserDefined2', array($parameters));
    }

    /**
     * @param Test $parameters
     * @return TestResponse
     */
    public function Test(Test $parameters)
    {
      return $this->__soapCall('Test', array($parameters));
    }

    /**
     * @param CreateUDF $parameters
     * @return CreateUDFResponse
     */
    public function CreateUDF(CreateUDF $parameters)
    {
      return $this->__soapCall('CreateUDF', array($parameters));
    }

    /**
     * @param TestCreateUserDefined $parameters
     * @return TestCreateUserDefinedResponse
     */
    public function TestCreateUserDefined(TestCreateUserDefined $parameters)
    {
      return $this->__soapCall('TestCreateUserDefined', array($parameters));
    }

    /**
     * @param SearchUserDefined $parameters
     * @return SearchUserDefinedResponse
     */
    public function SearchUserDefined(SearchUserDefined $parameters)
    {
      return $this->__soapCall('SearchUserDefined', array($parameters));
    }

    /**
     * @param SearchUserDefinedLike $parameters
     * @return SearchUserDefinedLikeResponse
     */
    public function SearchUserDefinedLike(SearchUserDefinedLike $parameters)
    {
      return $this->__soapCall('SearchUserDefinedLike', array($parameters));
    }

    /**
     * @param TestSearchUserDefined $parameters
     * @return TestSearchUserDefinedResponse
     */
    public function TestSearchUserDefined(TestSearchUserDefined $parameters)
    {
      return $this->__soapCall('TestSearchUserDefined', array($parameters));
    }

    /**
     * @param SearchUserDefinedLabel $parameters
     * @return SearchUserDefinedLabelResponse
     */
    public function SearchUserDefinedLabel(SearchUserDefinedLabel $parameters)
    {
      return $this->__soapCall('SearchUserDefinedLabel', array($parameters));
    }

    /**
     * @param SearchUserDefinedLabelLike $parameters
     * @return SearchUserDefinedLabelLikeResponse
     */
    public function SearchUserDefinedLabelLike(SearchUserDefinedLabelLike $parameters)
    {
      return $this->__soapCall('SearchUserDefinedLabelLike', array($parameters));
    }

    /**
     * @param TestSearchUserDefinedLabel $parameters
     * @return TestSearchUserDefinedLabelResponse
     */
    public function TestSearchUserDefinedLabel(TestSearchUserDefinedLabel $parameters)
    {
      return $this->__soapCall('TestSearchUserDefinedLabel', array($parameters));
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
