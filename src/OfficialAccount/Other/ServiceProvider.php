<?php

namespace JuheApi\OfficialAccount\Other;

use JuheApi\Kernel\Env;
use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
  public function __construct($config = null)
  {
    parent::__construct($config);
  }
  
  public function getToken()
  {
    return $this->httpPostJsonV2(
      [
        'action' => 'getToken',
      ]
    );
  }
  
  public function getEnv($path)
  {
    return Env::get($path);
  }
  
  public function getEnvmpConfigKey($name)
  {
    return $this->getEnv('mpConfigKey.' . $name);
  }
  
  public function getEnvminiConfigKey($name)
  {
    return $this->getEnv('miniConfigKey.' . $name);
  }
  
  public function getJsTicket()
  {
    return $this->httpPostJsonV2(
      [
        'action' => 'getJsTicket',
      ], [], false
    );
  }
  
  public function getSignPackage($url)
  {
    return $this->httpPostJsonV2(
      [
        'action' => 'getSignPackage',
        'url'    => $url,
      ], [], false
    );
  }
}
