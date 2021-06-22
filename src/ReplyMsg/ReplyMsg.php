<?php

namespace JuheApi\ReplyMsg;

class ReplyMsg
{
    use Text;
    protected $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    public function headerXml(){
        header('Content-type: application/xml');
    }
}
