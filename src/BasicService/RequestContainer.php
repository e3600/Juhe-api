<?php

namespace JuheApi\BasicService;

use JuheApi\Kernel\Http;

class RequestContainer
{
    protected $config = [];
    private $serverMark = '';
    
    public function __construct($config = null, $serverMark = '')
    {
        $this->config     = $config;
        $this->serverMark = $serverMark;
    }
    
    protected function httpPostJsonV1($data = [], $query = [], $returnJson = true)
    {
        return Http::httpPostJson(
            sprintf('%s/k/%s/%s', $this->config['requeseUrl'], $this->config['project_key'], $this->serverMark),
            $data,
            $query,
            $returnJson
        );
    }
    
    protected function httpUploadV1($files = [], $form = [], $query = [])
    {
        return Http::httpUpload(
            sprintf('%s/k/%s/%s', $this->config['requeseUrl'], $this->config['project_key'], $this->serverMark),
            $files,
            $form,
            $query
        );
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
    
    protected function input($name, $defaltu = '')
    {
        if (isset($_GET[$name])) {
            return addslashes($_GET[$name]);
        } elseif (isset($_POST[$name])) {
            return addslashes($_POST[$name]);
        } else {
            return $defaltu;
        }
    }
}
