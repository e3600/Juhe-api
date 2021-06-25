<?php

namespace JuheApi\Sms;

use JuheApi\Kernel\Response;
use JuheApi\BasicService\BaseConfig;
use JuheApi\BasicService\RequestContainer;

/**
 * Class Application.
 */
class Application extends RequestContainer
{
    use Response;
    use BaseConfig;
    
    // 服务标识
    private $serverMark = 'sms';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    public function send($params = [])
    {
        return $this->httpPostJsonV1(
            array_merge([
                'action' => 'send',
            ], $params)
        );
    }
    
    public function check($params = [])
    {
        return $this->httpPostJsonV1(
            array_merge([
                'action' => 'check',
            ], $params)
        );
    }
}
