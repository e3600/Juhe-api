<?php

namespace JuheApi\EnQrCode;

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
    private $serverMark = 'enQrCode';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    public function enQrCode($text, $params = [])
    {
        if (isset($params['logo'])) {
            $logo = $params['logo'];
            unset($params['logo']);
        } else {
            $logo = '';
        }
        return $this->httpUploadV1(
            [
                'logo' => $logo,
            ],
            array_merge([
                'text' => $text,
            ], $params)
        );
    }
}
