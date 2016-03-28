<?php

require 'vendor/autoload.php';

$generator = new \Wsdl2PhpGenerator\Generator();
$generator->generate(
    new \Wsdl2PhpGenerator\Config(array(
        'inputFile' => 'https://slvisual.shelterlogicdirect.com/derp/SalesOrderService.asmx?wsdl',
        'outputDir' => 'app/code/community/Americaneagle/Visual/wsdl/SalesOrderService',
        'namespaceName' => 'Visual\SalesOrderService'
    ))
);
$generator->generate(
    new \Wsdl2PhpGenerator\Config(array(
        'inputFile' => 'https://slvisual.shelterlogicdirect.com/derp/CustomerService.asmx?wsdl',
        'outputDir' => 'app/code/community/Americaneagle/Visual/wsdl/CustomerService',
        'namespaceName' => 'Visual\CustomerService'
    ))
);
$generator->generate(
    new \Wsdl2PhpGenerator\Config(array(
        'inputFile' => 'https://slvisual.shelterlogicdirect.com/derp/InventoryService.asmx?wsdl',
        'outputDir' => 'app/code/community/Americaneagle/Visual/wsdl/InventoryService',
        'namespaceName' => 'Visual\InventoryService'
    ))
);
$generator->generate(
    new \Wsdl2PhpGenerator\Config(array(
        'inputFile' => 'https://slvisual.shelterlogicdirect.com/derp/UserDefinedFieldService.asmx?wsdl',
        'outputDir' => 'app/code/community/Americaneagle/Visual/wsdl/UserDefinedFieldService',
        'namespaceName' => 'Visual\UserDefinedFieldService'
    ))
);