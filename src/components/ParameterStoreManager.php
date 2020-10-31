<?php

namespace GiviPapava\components\ParameterStoreManager;


use Aws\Exception\AwsException;
use Aws\Ssm\SsmClient;

class ParameterStoreManager
{


    /**
     * get parameters from aws parameter store
     *
     * @param $env
     * @return array|string
     */
    private static function getParameters($parameterNames, $path, $config)
    {

        try {


            $ssmClient = SsmClient::factory($config);
            $chunkedParameterNames = array_chunk($parameterNames, 10);
            $filteredParameter = [];
            foreach ($chunkedParameterNames as $chunkedParameterName) {
                $parameters = $ssmClient->getParameters(["Names" => $chunkedParameterName]);

            }
            return $filteredParameter;


        } catch (AwsException $e) {

            return $e->getMessage();
        }


    }


}