<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait Video
{
    public function Video($MediaId, $param=[])
    {
        $param['title']       = $param['title'] ?? '';
        $param['description'] = $param['description'] ?? '';
        exit(XML::build([
            'ToUserName'   => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime'   => time(),
            'MsgType'      => 'video',
            'Video'        => [
                'MediaId'     => $MediaId,
                'Title'       => $param['title'],
                'Description' => $param['description'],
            ],
        ]));
    }
}
