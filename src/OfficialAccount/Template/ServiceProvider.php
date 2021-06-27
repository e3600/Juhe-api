<?php

namespace JuheApi\OfficialAccount\Template;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function send($params = [])
    {
        $params['syn']           = isset($params['syn']) ? intval($params['syn']) : 0;
        $params['mark']          = isset($params['mark']) ? $params['mark'] : '';
        $params['template_id']   = isset($params['template_id']) ? $params['template_id'] : '';
        $params['template_name'] = isset($params['template_name']) ? $params['template_name'] : '';
        $params['miniprogram']   = isset($params['miniprogram']) ? $params['miniprogram'] : [];
        return $this->httpPostJsonV2(
            [
                'action'        => 'send_template',
                'mark'          => $params['mark'],
                'template_id'   => $params['template_id'],
                'template_name' => $params['template_name'],
                'openid'        => $params['openid'],
                'url'           => isset($params['url']) ? $params['url'] : '',
                'miniprogram'   => $params['miniprogram'],
                'params'        => $params['params'],
                'syn'           => $params['syn'],
            ]
        );
    }
    
    public function check($params = [])
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'check_template_code',
                'mark'   => $params['mark'],
                'code'   => $params['code'],
            ]
        );
    }
}
