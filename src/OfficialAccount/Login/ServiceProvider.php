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
    
    public function getToken()
    {
        return Http::httpPostJson(
            sprintf('%s/k/%s', $this->config['requeseUrl'], $this->config['config_key']),
            ['action' => 'getToken']
        );
    }
}
