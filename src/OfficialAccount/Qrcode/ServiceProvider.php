<?php

namespace JuheApi\OfficialAccount\Qrcode;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function temp($value, $expire = 300)
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'createQrCode',
                'code'   => $value,
                'type'   => gettype($value) == 'string' ? 'QR_STR_SCENE' : 'QR_SCENE',
                'expire' => $expire,
            ]
        );
    }
    
    public function forever($value)
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'createQrCode',
                'code'   => $value,
                'type'   => gettype($value) == 'string' ? 'QR_LIMIT_STR_SCENE' : 'QR_LIMIT_SCENE',
            ]
        );
    }
}
