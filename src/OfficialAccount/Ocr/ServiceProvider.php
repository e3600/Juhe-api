<?php

namespace JuheApi\OfficialAccount\Ocr;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
  public function __construct($config = null)
  {
    parent::__construct($config);
  }
  
  public function ocr($path, $idcard)
  {
    return $this->httpUploadV2(
      [
        'file' => $path,
      ],
      [
        'action'   => 'ocr',
        'type'     => $idcard,
        'kind'     => $kind,
        'filename' => pathinfo($path, PATHINFO_BASENAME),
      ]
    );
  }
}
