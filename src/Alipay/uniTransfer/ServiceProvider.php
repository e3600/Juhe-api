<?php

namespace JuheApi\Alipay\uniTransfer;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
  public function __construct($config = null)
  {
    parent::__construct($config);
  }
  
  public function start($params = [])
  {
    return $this->httpPostJsonV2(
      array_merge([
        'action' => 'uniTransfer',
      ], $params)
    );
  }
}
