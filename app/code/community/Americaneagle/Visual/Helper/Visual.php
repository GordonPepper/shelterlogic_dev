<?php

/**
 * Created by PhpStorm.
 * User: Levente Albert
 * Date: 12/12/14
 * Time: 8:19 AM
 */
class Americaneagle_Visual_Helper_Visual extends Mage_Core_Helper_Abstract
{
    /** @var Americaneagle_Visual_Helper_Data helper */
    private $config;
    /** @var SoapHeader header */
    private $header;
    private $options = array();

    /**
     * Americaneagle_Visual_Helper_Visual constructor.
     */
    public function __construct()
    {
        if (!isset($this->config)) {
            $this->config = Mage::helper('americaneagle_visual');
        }
        if ($this->config->getSoaplogEnable()) {
            $this->options['trace'] = 1;
        }
        $this->options['soap_version'] = SOAP_1_2;

        $this->header = new SoapHeader('http://tempuri.org/', 'Header', array(
            'Key' => $this->config->getServiceKey(),
            'ExternalRefGroup' => $this->config->getExternalRefGroup()));
    }

    /**
     * @return Americaneagle_Visual_Helper_Data
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return SoapHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function soapLog(SoapClient $client, $code, $message)
    {
        if (!isset($this->config)) {
            $this->config = Mage::helper('americaneagle_visual');
        }
        if (!$this->config->getSoaplogEnable()) {
            return;
        }
        $log = Mage::getModel('americaneagle_visual/soaplog');
        $log->setCode($code);
        $log->setDatetime(Varien_Date::now());
        $log->setMessage($message);
        $log->setRequestData($client->__getLastRequest());
        $log->setResponseData($client->__getLastResponse());
        $log->save();
    }

    public function soapLogException($client, $code, $message)
    {

        if (!isset($this->config)) {
            $this->config = Mage::helper('americaneagle_visual');
        }
        if (!$this->config->getSoaplogEnable()) {
            return;
        }
        $log = Mage::getModel('americaneagle_visual/soaplog');
        $log->setCode($code);
        $log->setDatetime(Varien_Date::now());
        $log->setMessage($message);
        if (isset($client)) {
            $log->setRequestData($client->__getLastRequest());
            $log->setResponseData($client->__getLastResponse());
        }
        $log->save();

    }

    function progressBar($done, $total) {
        $perc = floor(($done / $total) * 100);
        $left = 100 - $perc;
        $write = sprintf("\033[0G\033[2K[%'={$perc}s>%-{$left}s] - $perc%% - $done/$total", "", "");
        fwrite(STDERR, $write);
    }
} 