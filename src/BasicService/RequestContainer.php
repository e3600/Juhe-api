<?php

namespace JuheApi\BasicService;

use JuheApi\Kernel\Http;

class RequestContainer
{
    protected $config = [];
    
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    protected function httpPostJsonV2($data = [], $query = [], $returnJson = true)
    {
        return Http::httpPostJson(
            sprintf('%s/k/%s', $this->config['requeseUrl'], $this->config['config_key']),
            $data,
            $query,
            $returnJson
        );
    }
    
    protected function httpUploadV2($files = [], $form = [], $query = [])
    {
        return Http::httpUpload(
            sprintf('%s/k/%s', $this->config['requeseUrl'], $this->config['config_key']),
            $files,
            $form,
            $query
        );
    }
}
