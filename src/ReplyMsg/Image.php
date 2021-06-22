<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait Image
{
    public function Image($MediaId)
    {
        exit(XML::build([
            'ToUserName'   => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime'   => time(),
            'MsgType'      => 'image',
            'Image'        => [
                'MediaId' => $MediaId,
            ],
        ]));
    }
}
