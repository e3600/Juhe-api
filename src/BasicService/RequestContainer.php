<?php

namespace JuheApi\BasicService;

use JuheApi\Kernel\Http;

class RequestContainer
{
    protected $config = [];
    protected $longtimeProjectKey = ''; // 长时项目key，设置后只有将当前请求工程结束，或手动调用清空才会使用全局key
    protected $tempProjectKey = '';     // 临时项目key
    private $serverMark = '';
    
    public function __construct($config = null, $serverMark = '')
    {
        $this->config     = $config;
        $this->serverMark = $serverMark;
    }
    
    /**
     * 设置临时项目key，使用1次后失效
     *
     * @param $project_key
     * @return void
     */
    public function setTempProjectKey($project_key)
    {
        $this->tempProjectKey = $project_key;
    }
    
    /**
     * 设置长时项目key
     *
     * @remark 设置后只有将当前请求工程结束，或手动调用清空才会使用全局key
     * @param $project_key
     * @return void
     */
    public function setLongtimeProjectKey($project_key)
    {
        $this->longtimeProjectKey = $project_key;
    }
    
    /**
     * 清空长时项目key
     *
     * @remark 清空后瘵会使用全局key
     * @return void
     */
    public function clearLongtimeProjectKey()
    {
        $this->longtimeProjectKey = '';
    }
    
    /**
     * 聚合权限接口专用
     *
     * @param array $data
     * @param array $query
     * @param bool  $returnJson
     * @return mixed
     */
    protected function httpPostJsonAuth($data = [], $query = [], $returnJson = true)
    {
        return Http::httpPostJson(
            sprintf('%sam/%s', $this->config['requeseUrl'], $this->config['project_auth_key']),
            array_merge($data, ['debug' => $this->config['debug']]),
            $query,
            $returnJson
        );
    }
    
    /**
     * 聚合服务1.0，普通接口专用
     *
     * @param array $data
     * @param array $query
     * @param bool  $returnJson
     * @return mixed
     */
    protected function httpPostJsonV1($data = [], $query = [], $returnJson = true)
    {
        return Http::httpPostJson(
            sprintf('%sk/%s/%s', $this->config['requeseUrl'], $this->getProjectKey(), $this->serverMark),
            array_merge($data, ['debug' => $this->config['debug']]),
            $query,
            $returnJson
        );
    }
    
    /**
     * 聚合服务1.0，上传接口专用
     *
     * @param array $files
     * @param array $form
     * @param array $query
     * @return mixed
     */
    protected function httpUploadV1($files = [], $form = [], $query = [])
    {
        return Http::httpUpload(
            sprintf('%sk/%s/%s', $this->config['requeseUrl'], $this->getProjectKey(), $this->serverMark),
            $files,
            array_merge($form, ['debug' => $this->config['debug']]),
            $query
        );
    }
    
    /**
     * 聚合服务2.0，普通接口专用
     *
     * @param array $data
     * @param array $query
     * @param bool  $returnJson
     * @return mixed
     */
    protected function httpPostJsonV2($data = [], $query = [], $returnJson = true)
    {
        return Http::httpPostJson(
            sprintf('%sk/%s', $this->config['requeseUrl'], $this->config['config_key']),
            array_merge($data, ['debug' => $this->config['debug']]),
            $query,
            $returnJson
        );
    }
    
    /**
     * 聚合服务2.0，上传接口专用
     *
     * @param array $files
     * @param array $form
     * @param array $query
     * @return mixed
     */
    protected function httpUploadV2($files = [], $form = [], $query = [])
    {
        return Http::httpUpload(
            sprintf('%sk/%s', $this->config['requeseUrl'], $this->config['config_key']),
            $files,
            array_merge($form, ['debug' => $this->config['debug']]),
            $query
        );
    }
    
    /**
     * 简单安全过虑
     *
     * @param string $name
     * @param string $defaltu
     * @return string
     */
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
    
    private function getProjectKey()
    {
        if ($this->tempProjectKey) {
            $temp                 = $this->tempProjectKey;
            $this->tempProjectKey = ''; // 临时key只有1次的有效性
            return $temp;
        } else if ($this->longtimeProjectKey) {
            return $this->longtimeProjectKey;
        } else {
            return $this->config['project_key'];
        }
    }
}
