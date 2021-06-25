<?php

namespace JuheApi\DeQrCode;

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
    private $serverMark = 'deQrCode';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    public function deQrCode($path)
    {
        return $this->common('', $path);
    }
    
    private function common($action, $path, $params = [])
    {
        if (!file_exists($path)) {
            $this->fail('二维码图片路径有误，请检查。');
        }
        return $this->httpUploadV1(
            [
                'file' => $path,
            ],
            array_merge([
                'action' => $action,
            ], $params)
        );
    }
}
