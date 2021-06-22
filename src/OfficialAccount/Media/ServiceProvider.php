<?php

namespace JuheApi\OfficialAccount\Media;

use JuheApi\Kernel\Http;

class ServiceProvider
{
    private $config = [];
    
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    public function uploadImage($path, $kind = 0)
    {
        return Http::httpUpload(
            sprintf('%s/k/%s', $this->config['requeseUrl'], $this->config['config_key']),
            [
                'file' => $path,
            ],
            [
                'action' => 'upload_res',
                'filename' => '1.png',
                'kind'   => $kind,
                'type'   => 'image',
            ]
        );
    }
}
