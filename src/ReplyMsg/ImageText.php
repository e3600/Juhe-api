<?php

namespace JuheApi\ReplyMsg;

use JuheApi\Kernel\XML;

trait ImageText
{
    /**
     * @param array $items
     */
    public function ImageText(array $items)
    {
        exit(XML::build([
            'ToUserName'   => $this->message['FromUserName'],
            'FromUserName' => $this->message['ToUserName'],
            'CreateTime'   => time(),
            'MsgType'      => 'news',
            'ArticleCount' => count($items),
            'Articles'     => $items,
        ], 'xml', 'item', '', ''));
    }
    
    public function ImageItem($Title, $Description, $PicUrl, $Url)
    {
        return [
            'Title'       => $Title,
            'Description' => $Description,
            'PicUrl'      => $PicUrl,
            'Url'         => $Url,
        ];
    }
}
