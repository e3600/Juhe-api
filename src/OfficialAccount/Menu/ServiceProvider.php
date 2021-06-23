<?php

namespace JuheApi\OfficialAccount\Menu;

use JuheApi\Kernel\Http;

class ServiceProvider
{
    private $config = [];
    
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    public function create($menus = [])
    {
        return Http::httpUploadV2(
            [
                'action' => 'createMenu',
                'menus'  => $menus,
            ]
        );
    }
    
    public function get()
    {
        return Http::httpPostJson(
            sprintf('%s/k/%s', $this->config['requeseUrl'], $this->config['config_key']),
            ['action' => 'getMenu']
        );
    }
    
    public function remove()
    {
        return Http::httpPostJson(
            sprintf('k/%s/WxMp', $this->config['project_key']),
            ['action' => 'getMenu']
        );
    }
}
