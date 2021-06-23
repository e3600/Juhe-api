<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait Voice
{
    public function Voice($MediaId)
    {
        exit(XML::build([
            'ToUserName'   => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime'   => time(),
            'MsgType'      => 'voice',
            'Voice'        => [
                'MediaId'     => $MediaId,
            ],
        ]));
    }
}
