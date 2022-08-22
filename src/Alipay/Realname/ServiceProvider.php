<?php

namespace JuheApi\Alipay\Realname;

use JuheApi\BasicService\RequestContainer;

/**
 * 支付宝实名信息验证
 */
class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    /**
     * 第1-2步: 实名信息预录入
     *
     * @param array $params
     * @return mixed
     */
    public function certificateVerifyInput($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'certificateVerifyInput',
            ], $params)
        );
    }
    
    /**
     * 第3步:换取授权访问令牌 和 第4步: 开始验证
     *
     * @param string $verify_id 验证ID，在第1-2步获得
     * @param string $auth_code 授权码，用户授权成功302跳转带回
     * @return mixed
     */
    public function certificateVerifyStart($verify_id, $auth_code)
    {
        return $this->httpPostJsonV2(
            [
                'action'    => 'certificateVerifyStart',
                'verify_id' => $verify_id,
                'auth_code' => $auth_code,
            ]
        );
    }
}
