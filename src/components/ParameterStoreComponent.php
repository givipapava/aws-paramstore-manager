<?php

namespace GiviPapava\ParameterStoreManager\components;


use Aws\Exception\AwsException;
use Aws\Ssm\SsmClient;
use Exception;

class ParameterStoreComponent
{

    private static function putSecretsInFile($content = null)
    {

        $fp = fopen(getenv("DOCUMENT_ROOT") . "/.env", "w");
        fwrite($fp, $content);
        fclose($fp);
    }

    /**
     * get parameters from aws parameter store
     *
     * @param $parameterNames
     * @param $credentials
     * @return array|string
     * @throws Exception
     */
    private static function getParameters($parameterNames, $envType, $credentials = null)
    {

        try {

            if (!isset($parameterNames['data'])) {
                throw  new Exception("Parameters structure is not valid, check docs");
            }

            $parameterNames = $parameterNames['data'];

            $parameterNameValues = array_values($parameterNames);
            $parameterNameKeys = array_keys($parameterNames);


            $envData = "env=" . $envType . "\n";

            if ($envType === "local") {

                foreach ($parameterNameValues as $key => $value) {
                    $envData .= "$parameterNameKeys[$key]=" . $value['local'] . "\n";
                }

                self::putSecretsInFile($envData);
                return [
                    "status" => "success",
                    "message" => ".env file is created"
                ];
            }


            $ssmClient = new SsmClient(["credentials" => [
                "key" => $credentials["key"],
                "secret" => $credentials["secret"],
                "token" => $credentials["token"],
            ], "region" => $credentials["region"], "version" => $credentials["version"]]);


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

    /**
     * @param array $data
     * @param string $envType
     * @param $credentials
     * @return array|string
     * @throws Exception
     */
    public static function createEnv($data, $envType, $credentials)
    {

        return self::getParameters($data, $envType, $credentials);

    }


}