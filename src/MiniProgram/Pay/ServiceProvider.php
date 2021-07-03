<?php

namespace JuheApi\MiniProgram\Pay;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    /**
     * 创建支付订单
     *
     * @param array $params
     * @return mixed
     */
    public function create($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'payCreate',
            ], $params)
        );
    }
    
    /**
     * 查询订单
     *
     * @param string $params
     * @return mixed
     */
    public function query($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'payQuery',
            ], $params)
        );
    }
    
    /**
     * 订单退款
     *
     * @param string $params
     * @return mixed
     */
    public function refund($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'payRefund',
            ], $params),[],false
        );
    }
    
    /**
     * 订单退款查询
     *
     * @param string $params
     * @return mixed
     */
    public function refundQuery($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'payRefundQuery',
            ], $params),[],false
        );
    }
    
    
    /**
     * 生成订单号
     *
     * @return string
     */
    public function generateOrderId()
    {
        $first  = time() . mt_rand(100, 999);
        $second = substr(sha1(uniqid() . $first), -4);
        $third  = substr(sha1(uniqid() . $second), 0, 2);
        return strtoupper($first . $third . $second);
    }
}
