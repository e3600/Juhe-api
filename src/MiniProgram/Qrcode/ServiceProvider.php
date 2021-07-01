<?php

namespace JuheApi\MiniProgram\Qrcode;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    /**
     * 创建小程序码
     * @param array $params
     * @return mixed
     */
    public function getwxacode($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'getwxacode',
            ], $params)
        );
    }
    
    /**
     * 创建小程序二维码
     * @param array $params
     * @return mixed
     */
    public function createQRCode($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'createQRCode',
            ], $params)
        );
    }
    
    /**
     * 创建限时小程序二维码
     * @param array $params
     * @return mixed
     */
    public function generate($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'generate',
            ], $params)
        );
    }
    
    /**
     * 创建小程序码-不限数量
     * @param array $params
     * @return mixed
     */
    public function getUnlimited($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'getUnlimited',
            ], $params)
        );
    }
}
