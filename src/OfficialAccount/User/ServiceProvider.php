<?php

namespace JuheApi\OfficialAccount\User;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
  public function __construct($config = null)
  {
    parent::__construct($config);
  }
  
  public function get($openid)
  {
    return $this->httpPostJsonV2(
      [
        'action' => 'getUserInfo',
        'openid' => $openid,
      ]
    );
  }
  
  public function send($openid, $content)
  {
    return $this->httpPostJsonV2(
      [
        'action'  => 'sendMsg48',
        'openid'  => $openid,
        'content' => $content,
      ], []
    );
  }
}
