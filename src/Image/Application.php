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
    
    // 图片压缩
    public function compress($path, $params = [])
    {
        return $this->common('compress', $path, $params);
    }
    
    // 裁剪图像
    public function crop($path, $params = [])
    {
        return $this->common('crop', $path, $params = []);
    }
    
    // 生成缩略图
    public function thumb($path, $params = [])
    {
        return $this->common('thumb', $path, $params = []);
    }
    
    // 图像翻转
    public function flip($path, $params = [])
    {
        return $this->common('flip', $path, $params = []);
    }
    
    // 图像旋转
    public function rotate($path, $params = [])
    {
        return $this->common('rotate', $path, $params = []);
    }
    
    // 添加图片水印
    public function water($path, $params = [])
    {
        if (!file_exists($path)) {
            $this->fail('图片路径有误，请检查。');
        }
        return $this->httpUploadV1(
            [
                'file'  => $path,
                'water' => $params['water'],
            ],
            array_merge([
                'action' => 'water',
            ], $params)
        );
    }
    
    // 添加文字水印
    public function text($path, $params = [])
    {
        return $this->common('text', $path, $params);
    }
    
    // 缩放并压缩，支持jpg、png、jpeg
    public function zoomAndCompress($path, $params = [])
    {
        return $this->common('zoomAndCompress', $path, $params);
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
                'action'   => $action,
            ], $params)
        );
    }
}
