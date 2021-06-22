<?php

namespace JuheApi\Call\OfficialAccount;

use JuheApi\Kernel\Http;
use JuheApi\Kernel\XML;
use JuheApi\ReplyMsg\ReplyMsg;

class ServiceProvider
{
    private $config = [];
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    public function message($call)
    {
        $message = XML::parse(file_get_contents("php://input"));
        $call($message, new ReplyMsg($message));
    }
}
