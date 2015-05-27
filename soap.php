<?php
$client = new SoapClient('http://mag.farmbuildings.com/api/?wsdl');

// If somestuff requires api authentification,
// then get a session token
$session = $client->login('WordpressIntegration', 'Kelly21Sammy!');

$result = $client->call($session, 'catalog_category.tree',array('parentId' => 2));
var_dump($result);

// If you don't need the session anymore
//$client->endSession($session);


$result = $client->call($session, 'catalog_category.info', '6');
var_dump($result);