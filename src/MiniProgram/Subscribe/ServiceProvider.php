<?php

namespace JuheApi\MiniProgram\Subscribe;

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
        return $this->httpPostJsonV2(
            [
                'action'            => 'sendSubscribeMsg',
                'mark'              => $params['mark'],
                'template_id'       => $params['template_id'],
                'template_name'     => $params['template_name'],
                'openid'            => $params['openid'],
                'page'              => isset($params['page']) ? $params['page'] : '',
                'miniprogram_state' => isset($params['miniprogram_state']) ? $params['miniprogram_state'] : '',
                'params'            => $params['params'],
                'syn'               => $params['syn'],
            ]
        );
    }
    
    public function getTemplateList($params = [])
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'getTemplateList'
            ]
        );
    }
}
