<?php

namespace GiviPapava\Bootstrap;


/**
 * @author GiviPapava <givi.papava12@gmail.com>
 * @link https://github.com/givipapava/php-aws-paramstore-manager
 */
class Bootstrap
{

    private $configPath;
    private $env;
    private $awsConfig;

    public function __construct($configPath, $env, $awsConfig)
    {
        $this->configPath = $configPath;
        $this->env = $env;
        $this->awsConfig = $awsConfig;

    }


    public  static  function getParametersFromParamStore() {




    }

}