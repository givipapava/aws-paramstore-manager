# aws-paramstore-manager
Manage application secrets  efficienlty.


# Instalation
```php
 composer require givi/aws-paramstore-manager
```


# Permissions

Created By: Givi Papava   
Version: 1.0 <br>
Language: PHP <br>

### Change Log

| Name | Version | Description | Date |
| :---: | --- | --- | --- |
| PHP ip tools | 1.0.0 | In development | 07-11-2020|

### Parameters file  structure
```javascript
{
  "data": {
  
    "mysql_host": {
      "paramStore": "db.hostname",
      "local": "localhost"
    },

   "key_saved_in_env_file": {
      "paramStore": "key name in aws parameter store",
      "local": "local value"
   }
}


```

## Usage
### Example
```php
use GiviPapava\ParameterStoreManager\ParameterStoreManager;

$loader = require __DIR__ . '/vendor/autoload.php';

$path  = dirname(__FILE__).'/parametersTemplate/parameters-store.json';

$data = file_get_contents($path);

 ParameterStoreManager::getParametersFromParamStore($data, "dev", [
    "key" => "key",
    "secret" => "secret",
    "token" => "token",
    "region" => "region",
    "version" => "version"
]);


``` 
