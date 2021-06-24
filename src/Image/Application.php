<?php

namespace JuheApi\Image;

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
    private $serverMark = 'image';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    public function compress($path)
    {
        if (!file_exists($path)){
            $this->fail('图片路径有误，请检查。');
        }
        return $this->httpUploadV1(
            [
                'file' => $path,
            ],
            [
                'action'   => 'compress',
                'filename' => pathinfo($path, PATHINFO_BASENAME),
            ]
        );
    }
}
