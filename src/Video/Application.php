<?php

namespace JuheApi\Video;

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
    private $serverMark = 'ffmpeg';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    // 视频取封面
    public function frame($path, $params = [])
    {
        return $this->common('frame', $path, $params);
    }
    
    // 视频格式转MP4
    public function convert($path)
    {
        return $this->common('convert', $path);
    }
    
    private function common($action, $path, $params = [])
    {
        if (!file_exists($path)) {
            $this->fail('图片路径有误，请检查。');
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
