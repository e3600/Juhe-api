<?php

namespace JuheApi\OfficialAccount\Other;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function getToken()
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'getToken'
            ]
        );
    }
}
