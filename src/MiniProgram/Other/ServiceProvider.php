<?php

namespace JuheApi\MiniProgram\Other;

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
    
    /**
     * 数据解密
     */
    public function decryptData($params = [])
    {
        return $this->httpPostJsonV2(
            [
                'action'        => 'decryptData',
                'appid'         => $params['appid'],
                'session_key'   => $params['session_key'],
                'encryptedData' => $params['encryptedData'],
                'iv'            => $params['iv'],
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
}
