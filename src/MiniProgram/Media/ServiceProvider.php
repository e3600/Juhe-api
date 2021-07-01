<?php

namespace JuheApi\MiniProgram\Media;

use JuheApi\BasicService\RequestContainer;
use JuheApi\Kernel\Response;

class ServiceProvider extends RequestContainer
{
    use Response;
    
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function getMedia($media_id)
    {
        return $this->httpPostJsonV2(['action' => 'getTempMedia', 'media_id' => $media_id]);
    }
    
    /**
     * 上传图片素材
     *
     * @param string $path
     * @return mixed
     */
    public function uploadImage($path)
    {
        if (!file_exists($path)) {
            $this->fail('图片路径有误 ，请检查');
        }
        return $this->httpUploadV2(
            [
                'file' => $path,
            ],
            [
                'action'   => 'uploadMedia',
                'filename' => pathinfo($path, PATHINFO_BASENAME),
            ]
        );
    }
}
