<?php

namespace JuheApi\BasicService;

trait BaseConfig
{
    protected $BaseConfig = [
        // 请求地址
        'requeseUrl'  => 'http://lan.api.125.la/',
        
        // 项目Key，慧掌柜
        // 'project_key' => 'b1c5f116-eb6c-11ea-a1b2-051445484486',
        
        // 项目ID，没用的测试
        'project_key' => 'e2eb4122-b86e-11eb-ac9d-571462d6f2de',
    ];
    
    // 微信公众号/小程序，同项目多服务预定义
    // 名称必须以“CONFIGKEY_”开头
    protected $ConfigKey = [
        'CONFIGKEY_DTZ'    => 'now9m1s7s8pqmzgclzdxwi3kwysvxiidygnc6lrg',
        'CONFIGKEY_DTZFSZ' => 'sp3cisakybfmpincssbheye4zney7iyph6yyukpi',
        'CONFIGKEY_NDD'    => 'j8qaafkegt3kmirhhoj7hzy8eswyx1wcmwt1mmpb',
        'CONFIGKEY_Py'     => '5r9s6z4wpicb9y61zifr3jhm5wsknyktj1e08npt',
    ];
    
    /**
     * 初始化配置
     *
     * @param array  $config     配置
     * @param string $serverMark 服务标识
     * @return mixed
     */
    protected function initConfig($config, string $serverMark)
    {
        // 请求地址
        $config['requeseUrl'] = $this->BaseConfig['requeseUrl'];
        
        // 项目KEY
        if (!isset($config['project_key']) || !$config['project_key']) {
            if (isset($this->BaseConfig['project_key']) && $this->BaseConfig['project_key']) {
                $config['project_key'] = $this->BaseConfig['project_key'];
            }
        }
        
        // 预处理ConfigKey
        $config = $this->handleConfigKey($config);
        
        // 检测必要配置项
        $this->checkConfig($config);
        return $config;
    }
    
    /**
     * 检测必要配置项
     *
     * @param $config
     */
    protected function checkConfig($config)
    {
        // 项目KEY
        if (!isset($config['project_key']) || !$config['project_key']) {
            $this->fail('project_key 不能为空');
            
            // 微信公众号/小程序/特有的config_key
        } else if (!isset($config['config_key']) || strlen(trim($config['config_key'])) != 40) {
            $this->fail('config_key 不能为空');
        }
    }
    
    /**
     * 预处理ConfigKey
     *
     * @param $config
     * @return mixed
     */
    private function handleConfigKey($config)
    {
        if (!isset($config['config_key']) || strtoupper(substr($config['config_key'], 0, 10)) !== 'CONFIGKEY_') {
            return $config;
        }
        if (isset($this->ConfigKey[$config['config_key']])) {
            $config['config_key'] = $this->ConfigKey[$config['config_key']];
        }
        return $config;
    }
}
