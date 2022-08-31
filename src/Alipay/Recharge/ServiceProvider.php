<?php

namespace JuheApi\Alipay\Recharge;

use JuheApi\BasicService\RequestContainer;

/**
 * 支付宝电脑网站，手机网站充值
 */
class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    /**
     * 电脑网站，创建支付订单
     *
     * @param array $params
     * @return mixed
     */
    public function createOrderPc($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'createOrderPc',
            ], $params)
        );
    }
    
    /**
     * 手机网站，创建支付订单
     *
     * @param array $params
     * @return mixed
     */
    public function createOrderWap($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'createOrderWap',
            ], $params)
        );
    }
    
    /**
     * 查看交易订单
     *
     * @param array $params
     * @return mixed
     */
    public function queryOrder($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'queryOrder',
            ], $params)
        );
    }
    
    /**
     * 检验签名
     *
     * @remark 如：支付宝在线充值成功后，302跳回原网站，需要校验数据是否被篡改，内部会去除无用的POST参数
     * @param array $params
     * @return mixed
     */
    public function checkSign($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'checkSign',
            ], $params)
        );
    }
}
