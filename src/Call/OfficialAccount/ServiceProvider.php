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
    
    public function push($call, $MsgType = null)
    {
        $message = XML::parse(file_get_contents("php://input"));
        if (!$message) {
            echo '消息解析失败，消息内容：' . file_get_contents("php://input");
            return false;
        }
        
        // 指定消息类型
        if ($MsgType) {
            if ($message['MsgType'] == $MsgType) {
                $call($message, $_GET, new ReplyMsg($message));
            }
            
        } else {
            $call($message, $_GET, new ReplyMsg($message));
        }
    }
}
