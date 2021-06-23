<?php

namespace JuheApi\OfficialAccount\Media;

use JuheApi\Kernel\Http;
use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function get($media_id, $kind = 0)
    {
        return $this->httpPostJsonV2(['action' => 'media_get', 'media_id' => $media_id, 'kind' => $kind]);
    }
    
    /**
     * 获取 JSSDK 上传的高清语音
     */
    public function getJssdkMedia($media_id)
    {
        return $this->httpPostJsonV2(['action' => 'media_get_jssdk', 'media_id' => $media_id]);
    }
    
    /**
     * 上传图片
     *
     * @param string $path
     * @param int    $kind
     * @return mixed
     */
    public function uploadImage($path, $kind = 0)
    {
        return $this->httpUploadV2(
            [
                'file' => $path,
            ],
            [
                'action'   => 'media_upload',
                'type'     => 'image',
                'kind'     => $kind,
                'filename' => '1.png',
            ]
        );
    }
    
    /**
     * 上传语音
     *
     * @param string $path
     * @param int    $kind
     * @return mixed
     */
    public function uploadVoice($path, $kind = 0)
    {
        return $this->httpUploadV2(
            [
                'file' => $path,
            ],
            [
                'action'   => 'media_upload',
                'type'     => 'voice',
                'kind'     => $kind,
                'filename' => '1.mp3',
            ]
        );
    }
    
    /**
     * 上传视频
     *
     * @param string $path
     * @param int    $kind
     * @return mixed
     */
    public function uploadVideo($path, $kind = 0)
    {
        return $this->httpUploadV2(
            [
                'file' => $path,
            ],
            [
                'action'   => 'media_upload',
                'type'     => 'video',
                'kind'     => $kind,
                'filename' => '1.mp3',
            ]
        );
    }
    
    /**
     * 获取素材列表
     *
     * @param $type
     * @param $offset
     * @param $count
     * @return mixed
     */
    public function getList($type, $offset = 0, $count = 20)
    {
        return $this->httpPostJsonV2([
            'action' => 'media_get_list',
            'type'   => $type,
            'offset' => $offset,
            'count'  => $count,
        ]);
    }
}
