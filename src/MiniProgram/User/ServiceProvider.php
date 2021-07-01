<?php

namespace JuheApi\MiniProgram\User;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function Login($js_code)
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'login',
                'js_code'  => $js_code,
            ]
        );
    }
}
