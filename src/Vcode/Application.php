<?php

namespace JuheApi\Vcode;

use JuheApi\Kernel\Response;
use JuheApi\BasicService\BaseConfig;
use JuheApi\BasicService\RequestContainer;

/**
 * Class Application.
 */
class Application extends RequestContainer
{
  use Response;
  use BaseConfig;
  
  // 服务标识
  private $serverMark = 'Vcode';
  
  public function __construct(array $config = [], array $prepends = [], string $id = null)
  {
    parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
  }
  
  public function send($params = [])
  {
    if (strlen(trim($params['receive'])) == 11) {
      return $this->httpPostJsonV1(
        array_merge([
          'action' => 'send',
        ], $params)
      );
    } else {
      return $this->httpPostJsonV1(
        array_merge([
          'action'     => 'send',
          'config_key' => $this->config['config_key'],
        ], $params)
      );
    }
  }
  
  public function check($params = [])
  {
    if (strlen(trim($params['params'])) == 11) {
      return $this->httpPostJsonV1(
        array_merge([
          'action' => 'check',
        ], $params)
      );
    } else {
      return $this->httpPostJsonV1(
        array_merge([
          'action' => 'check',
          'config_key' => $this->config['config_key'],
        ], $params)
      );
    }
  }
}
