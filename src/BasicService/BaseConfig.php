<?php

namespace JuheApi\BasicService;

use JuheApi\Kernel\Env;

$envFile = dirname(__DIR__, 5) . '/.env.juhe';
if (!file_exists($envFile)){
    copy(dirname(__DIR__, 2). '/env.juhe.example', $envFile);
    echo "首次加载，请修改juheApi的配置文件: ".$envFile;
    chmod($envFile, 0400); // 更改访问权限，禁止用户在线读取
    exit();
}else{
    Env::loadFile($envFile);
}

trait BaseConfig
{
    /**
     * 初始化配置
     *
     * @param array  $config           配置
     * @param string $serverMark       服务标识
     * @param string $isCheckConfigKey 是否检测config_key（公众号/小程序专用）
     * @return mixed
     */
    protected function initConfig($config, string $serverMark, $isCheckConfigKey = false)
    {
        // 请求地址
        $config['requeseUrl'] = Env::get('system.requeseUrl');
        
        // 项目KEY
        if (!isset($config['project_key']) || !$config['project_key']) {
            if ($project_key = Env::get('system.project_key')) {
                $config['project_key'] = $project_key;
            }
        }
        
        // 预处理ConfigKey
        $config = $this->handleConfigKey($config);
        
        // 检测必要配置项
        $this->checkConfig($config, $isCheckConfigKey);
        return $config;
    }
    
    /**
     * 检测必要配置项
     *
     * @param $config
     */
    protected function checkConfig($config, $isCheckConfigKey)
    {
        // 项目KEY
        if (!isset($config['project_key']) || !$config['project_key']) {
            $this->fail('project_key 不能为空');
            
            // 微信公众号/小程序/特有的config_key
        } else if ($isCheckConfigKey && (!isset($config['config_key']) || strlen(trim($config['config_key'])) != 40)) {
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
        if (!isset($config['config_key'])) {
            return $config;
        }
        if ($temp = Env::get('mpConfigKey.' . $config['config_key'])) {
            $config['config_key'] = $temp;
        }
        return $config;
    }
}
