<?php

namespace JuheApi\OfficialAccount\Login;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function create($redirect_uri='', $scope = 'snsapi_base', $state = '0')
    {
        if (!$redirect_uri && substr($redirect_uri, 0, 4) != 'http') {
            return 'Login redirect_uri 不能为空';
        }
        return $this->httpPostJsonV2(
            [
                'action'       => 'login_create',
                'redirect_uri' => $redirect_uri,
                'scope'        => $scope,
                'state'        => $state,
            ]
        );
    }
}
