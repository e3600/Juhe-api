<?php

namespace JuheApi\OfficialAccount\Redpack;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    /**
     * 发放普通红包
     *
     * @param array $params
     * @return mixed
     */
    public function redpack($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'redpack',
            ], $params)
        );
    }
    
    /**
     * 发放裂变红包
     *
     * @param array $params
     * @return mixed
     */
    public function redpackGroup($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'redpackGroup',
            ], $params)
        );
    }
    
    /**
     * 查询红包记录
     *
     * @param string $mch_billno
     * @return mixed
     */
    public function redpackQuery($mch_billno)
    {
        return $this->httpPostJsonV2([
            'action'     => 'redpackQuery',
            'mch_billno' => $mch_billno,
        ]);
    }
}
