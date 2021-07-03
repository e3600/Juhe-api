<?php

namespace JuheApi\Call\MiniProgram;

use JuheApi\Kernel\Http;
use JuheApi\Kernel\XML;

class ServiceProvider
{
    private $config = [];
    private $message = null;
    
    public function __construct($config = null)
    {
        $this->config = $config;
    }
    
    public function push($call, $MsgType = null)
    {
        if (!$this->message) {
            $message = file_get_contents("php://input");
            if (!$this->message = XML::parse($message)) {
                echo '消息解析失败，消息内容：' . $message;
                return false;
            }
        }
        
        // 指定消息类型 && 用户操作回调消息
        if ($MsgType && isset($this->message['MsgType'])) {
            if ($this->message['MsgType'] == $MsgType) {
                $call($this->message, $_GET);
                exit();
            }
            
            // 支付回调
        } else if (isset($this->message['mch_id']) && isset($this->message['appid']) && isset($this->message['total_fee'])) {
            if ($MsgType !== 'pay') {
                return false;
            }
            if ($call($this->message, $_GET)) {
                exit('SUCCESS');
            } else {
                exit('FAIL');
            }
            
        } else {
            
            $call($this->message, $_GET);
            exit();
        }
    }
}
