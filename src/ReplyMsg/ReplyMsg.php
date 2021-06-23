<?php
// 技术地址
// https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Passive_user_reply_message.html#1

namespace JuheApi\ReplyMsg;

class ReplyMsg
{
    use Text;
    use Image;
    use Voice;
    use Video;
    use Music;
    use ImageText;
    
    protected $message;
    protected $replyFormat = 'xml';
    
    public function __construct($message)
    {
        // $this->handleReplyFormat();
        $this->message = $message;
    }
    
    /**
     * 处理回复格式
     */
    public function handleReplyFormat()
    {
        if ($this->replyFormat == 'xml') {
            $this->headerXml();
        } else if ($this->replyFormat == 'json') {
            $this->headerJson();
        }
    }
    
    public function headerXml()
    {
        header('Content-type: application/xml');
    }
    
    public function headerJson()
    {
        header('Content-type: application/json');
    }
}
