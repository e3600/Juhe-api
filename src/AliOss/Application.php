<?php

namespace JuheApi\AliOss;

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
  private $serverMark = 'oss';
  
  public function __construct(array $config = [], array $prepends = [], string $id = null)
  {
    parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
  }
  
  // 上传文件
  public function upload($params = [])
  {
    if (!isset($params['path']) || !file_exists($params['path'])) {
      $this->fail('图片路径有误，请检查。');
    }
    if (!isset($params['filename'])) {
      $params['filename'] = basename($params['path']);
    }
    return $this->httpUploadV1(
      [
        'file' => $params['path'],
      ],
      array_merge([
        'action' => 'upload',
      ], $params)
    );
  }
  
  /**
   * 创建下载链接
   *
   * @param array $params
   * @return mixed
   */
  public function createDownLink($params = [])
  {
    return $this->common('createDownLink', $params);
  }
  
  // 删除文件
  public function delele($files)
  {
    $params = [
      'files' => is_array($files) ? implode(',', $files) : $files,
    ];
    return $this->common('del', $params);
  }
  
  // 复制文件
  public function copy($params = [])
  {
    return $this->common('copy', $params);
  }
  
  // 移动文件
  public function move($params = [])
  {
    return $this->common('move', $params);
  }
  
  // 取文件信息
  public function getFileInfo($file)
  {
    return $this->common('get_file_info', [
      'file' => $file,
    ]);
  }
  
  // 取文件信息
  public function getImageInfo($file)
  {
    return $this->common('get_image_info', [
      'file' => $file,
    ]);
  }
  
  // 生成视频图片
  public function genVideoImage($file)
  {
    return $this->common('gen_video_image', [
      'file' => $file,
    ]);
  }
  
  // 文件是否存在
  public function fileExist($file)
  {
    return $this->common('file_exist', [
      'file' => $file,
    ]);
  }
  
  // 取上传Token
  public function getToken()
  {
    return $this->common('get_token', []);
  }
  
  // 取文件列表
  public function getFileList($params = [])
  {
    return $this->common('list', $params);
  }
  
  private function common($action, $params = [])
  {
    return $this->httpPostJsonV1(
      array_merge([
        'action' => $action,
      ], $params)
    );
  }
}
