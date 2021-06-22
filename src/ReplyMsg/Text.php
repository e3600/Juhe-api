<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait Text
{
    public function Text($Text){
        $this->headerXml();
        exit(XML::build([
            'ToUserName' => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime' => time(),
            'MsgType' => 'text',
            'Content' => $Text,
        ]));
    }
}
