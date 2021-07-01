<?php
// 主动回复消息
namespace JuheApi\MiniProgram\Message;

use JuheApi\BasicService\RequestContainer;
use JuheApi\Kernel\Response;

class ServiceProvider extends RequestContainer
{
    use Response;
    
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function sendText($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendText'], $params));
    }
    
    public function sendLink($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendLink'], $params));
    }
    
    public function sendImage($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendImage'], $params));
    }
}
