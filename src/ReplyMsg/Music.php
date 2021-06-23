<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait Music
{
    public function Music($MediaId, $param = [])
    {
        $param['title']       = $param['title'] ?? '';
        $param['description'] = $param['description'] ?? '';
        $param['musicurl']    = $param['musicurl'] ?? '';
        $param['hqmusicurl']  = $param['hqmusicurl'] ?? '';
        exit(XML::build([
            'ToUserName'   => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime'   => time(),
            'MsgType'      => 'music',
            'Music'        => [
                'ThumbMediaId' => $MediaId,
                'Title'        => $param['title'],
                'Description'  => $param['description'],
                'MusicURL'     => $param['musicurl'],
                'HQMusicUrl'   => $param['hqmusicurl']
            ],
        ]));
    }
}
