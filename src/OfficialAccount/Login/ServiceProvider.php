<?php

namespace JuheApi\OfficialAccount\Login;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function create($params = [], $call)
    {
        // 带有code的应该走到了第二步[success]
        if (isset($_GET['code'])) {
            return false;
        }
        
        if (!$params['redirect_uri'] && substr($params['redirect_uri'], 0, 4) != 'http') {
            $call('Login redirect_uri 不能为空');
            return false;
        }
        $res = $this->httpPostJsonV2(
            [
                'action'       => 'login_create',
                'redirect_uri' => $params['redirect_uri'],
                'scope'        => $params['scope'],
                'state'        => $params['state'],
            ]
        );
        $call($res);
    }
    
    public function success($call)
    {
        // 应该在create，直接返回
        if (!isset($_GET['code'])) {
            return false;
        }
        $code  = $this->input('code');
        $state = $this->input('state');
    }
    
    public function getAccessToken($code)
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'login_authorization_code',
                'code'   => $code,
            ],[],false
        );
    }
}
