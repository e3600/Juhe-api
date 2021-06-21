<?php

namespace JuheApi\OfficialAccount\Login;

use JuheApi\Kernel\Http;

class ServiceProvider
{
    private $config = [];
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    public function login()
    {
        return Http::httpPostJson(
            sprintf('k/%s/WxMp', $this->config['project_key']),
            ['action' => 'getToken']
        );
    }
}
