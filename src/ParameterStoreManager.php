<?php

namespace GiviPapava\ParameterStoreManager;


use Exception;
use GiviPapava\ParameterStoreManager\components\ParameterStoreComponent;


/**
 * @author GiviPapava <givi.papava12@gmail.com>
 * @link https://github.com/givipapava/php-aws-paramstore-manager
 */
class ParameterStoreManager
{


    /**
     * @param array| null $data
     * @param string| null $envType
     * @param array| null $credentials
     * @return string|string[]
     */
    public static function getParametersFromParamStore($data = null, $envType = null, $credentials = null)
    {

        try {

            if (!$data || empty($data)) {
                throw  new Exception("Parameters store keys are missing, check file path");
            }

            if (!$envType) {
                throw  new Exception("Environment type is missing");
            }

            if (!$credentials) {
                throw  new Exception("Aws credentials are  missing");
            }

            $data = is_string($data) ? json_decode($data,true) : $data;

            return ParameterStoreComponent::createEnv($data, $envType, $credentials);

        } catch (Exception $e) {
            return $e->getMessage();
        }


    }

}