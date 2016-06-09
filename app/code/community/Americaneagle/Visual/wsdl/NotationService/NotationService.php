<?php

namespace Visual\NotationService;

class NotationService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'TestAddNotation' => 'Visual\\NotationService\\TestAddNotation',
      'TestAddNotationResponse' => 'Visual\\NotationService\\TestAddNotationResponse',
      'TestLoadNotation' => 'Visual\\NotationService\\TestLoadNotation',
      'TestLoadNotationResponse' => 'Visual\\NotationService\\TestLoadNotationResponse',
      'SampleNotation' => 'Visual\\NotationService\\SampleNotation',
      'SampleNotationResponse' => 'Visual\\NotationService\\SampleNotationResponse',
      'NotationData' => 'Visual\\NotationService\\NotationData',
      'AddNotation2' => 'Visual\\NotationService\\AddNotation2',
      'AddNotation2Response' => 'Visual\\NotationService\\AddNotation2Response',
      'LoadNotation2' => 'Visual\\NotationService\\LoadNotation2',
      'LoadNotation2Response' => 'Visual\\NotationService\\LoadNotation2Response',
      'LoadNotation' => 'Visual\\NotationService\\LoadNotation',
      'LoadNotationResponse' => 'Visual\\NotationService\\LoadNotationResponse',
      'Header' => 'Visual\\NotationService\\Header',
      'AddNotation' => 'Visual\\NotationService\\AddNotation',
      'AddNotationResponse' => 'Visual\\NotationService\\AddNotationResponse',
      'CurrentVersion' => 'Visual\\NotationService\\CurrentVersion',
      'CurrentVersionResponse' => 'Visual\\NotationService\\CurrentVersionResponse',
      'LoginCreds' => 'Visual\\NotationService\\LoginCreds',
      'LoginCredsResponse' => 'Visual\\NotationService\\LoginCredsResponse',
      'NextNumberGenAppenditure' => 'Visual\\NotationService\\NextNumberGenAppenditure',
      'NextNumberGenAppenditureResponse' => 'Visual\\NotationService\\NextNumberGenAppenditureResponse',
      'UserPermission' => 'Visual\\NotationService\\UserPermission',
      'UserPermissionResponse' => 'Visual\\NotationService\\UserPermissionResponse',
      'NextNumberGen2' => 'Visual\\NotationService\\NextNumberGen2',
      'NextNumberGen2Response' => 'Visual\\NotationService\\NextNumberGen2Response',
      'InstallSchemaDatabaseLogMessage' => 'Visual\\NotationService\\InstallSchemaDatabaseLogMessage',
      'InstallSchemaDatabaseLogMessageResponse' => 'Visual\\NotationService\\InstallSchemaDatabaseLogMessageResponse',
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
        $wsdl = 'https://slvisual.shelterlogicdirect.com/derp/NotationService.asmx?wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param TestAddNotation $parameters
     * @return TestAddNotationResponse
     */
    public function TestAddNotation(TestAddNotation $parameters)
    {
      return $this->__soapCall('TestAddNotation', array($parameters));
    }

    /**
     * @param TestLoadNotation $parameters
     * @return TestLoadNotationResponse
     */
    public function TestLoadNotation(TestLoadNotation $parameters)
    {
      return $this->__soapCall('TestLoadNotation', array($parameters));
    }

    /**
     * @param SampleNotation $parameters
     * @return SampleNotationResponse
     */
    public function SampleNotation(SampleNotation $parameters)
    {
      return $this->__soapCall('SampleNotation', array($parameters));
    }

    /**
     * @param AddNotation2 $parameters
     * @return AddNotation2Response
     */
    public function AddNotation2(AddNotation2 $parameters)
    {
      return $this->__soapCall('AddNotation2', array($parameters));
    }

    /**
     * @param LoadNotation2 $parameters
     * @return LoadNotation2Response
     */
    public function LoadNotation2(LoadNotation2 $parameters)
    {
      return $this->__soapCall('LoadNotation2', array($parameters));
    }

    /**
     * @param LoadNotation $parameters
     * @return LoadNotationResponse
     */
    public function LoadNotation(LoadNotation $parameters)
    {
      return $this->__soapCall('LoadNotation', array($parameters));
    }

    /**
     * @param AddNotation $parameters
     * @return AddNotationResponse
     */
    public function AddNotation(AddNotation $parameters)
    {
      return $this->__soapCall('AddNotation', array($parameters));
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
