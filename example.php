<?php

use GiviPapava\ParameterStoreManager\ParameterStoreManager;

$loader = require __DIR__ . '/vendor/autoload.php';

$path  = dirname(__FILE__).'/parametersTemplate/parameters-store.json';

$data = file_get_contents($path);


$result =  ParameterStoreManager::getParametersFromParamStore($data, "dev", [
    "key" => "key",
    "secret" => "secret",
    "token" => "token",
    "region" => "region",
    "version" => "version"
]);

print_r($result);

