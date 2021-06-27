<?php

namespace JuheApi\OfficialAccount\PayScan;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function create($params = [])
    {
        return $this->httpPostJsonV2(
            array_merge([
                'action' => 'order_create',
            ], $params)
        );
    }
}
