<?php

namespace Visual\InventoryService;

class InstallSchemaDatabaseLogMessageResponse
{

    /**
     * @var string $InstallSchemaDatabaseLogMessageResult
     */
    protected $InstallSchemaDatabaseLogMessageResult = null;

    /**
     * @param string $InstallSchemaDatabaseLogMessageResult
     */
    public function __construct($InstallSchemaDatabaseLogMessageResult)
    {
      $this->InstallSchemaDatabaseLogMessageResult = $InstallSchemaDatabaseLogMessageResult;
    }

    /**
     * @return string
     */
    public function getInstallSchemaDatabaseLogMessageResult()
    {
      return $this->InstallSchemaDatabaseLogMessageResult;
    }

    /**
     * @param string $InstallSchemaDatabaseLogMessageResult
     * @return \Visual\InventoryService\InstallSchemaDatabaseLogMessageResponse
     */
    public function setInstallSchemaDatabaseLogMessageResult($InstallSchemaDatabaseLogMessageResult)
    {
      $this->InstallSchemaDatabaseLogMessageResult = $InstallSchemaDatabaseLogMessageResult;
      return $this;
    }

}
