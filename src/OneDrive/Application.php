<?php

namespace JuheApi\OneDrive;

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
  private $serverMark = 'oneDrive';
  
  public function __construct(array $config = [], array $prepends = [], string $id = null)
  {
    parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
  }
  
  // 取登录授权链接
  public function getAuthLink()
  {
    return $this->common('getAuthLink', []);
  }
  
  /**
   * 刷新Toklen
   * 当前接口需要定时55分钟调用1次
   *
   * @return mixed
   */
  public function refreshToken()
  {
    return $this->common('refreshToken', []);
  }
  
  // 获取Toklen
  public function getToken()
  {
    return $this->common('getToken', []);
  }
  
  // 上传文件
  public function upload($params = [])
  {
    if (!isset($params['file']) || !file_exists($params['file'])) {
      $this->fail('文件路径有误，请检查。');
    }
    if (!isset($params['filename'])) {
      $params['filename'] = basename($params['file']);
    }
    return $this->httpUploadV1(
      [
        'file' => $params['file'],
      ],
      array_merge([
        'action' => 'uploadFile',
      ], $params)
    );
  }
  
  /**
   * 创建下载链接
   * 通过文件ID 或 文件路径，获取他的下载链接
   *
   * @param array $params
   * @return mixed
   */
  public function createDownUrl($params = [])
  {
    return $this->common('createDownUrl', $params);
  }
  
  /**
   * 删除文件
   * 通过文件ID，删除文件
   *
   * @param string $fileId
   * @return mixed
   */
  public function deleteFile($fileId)
  {
    return $this->common('deleteFile', [
      'fileId' => $fileId,
    ]);
  }
  
  /**
   * 通过文件路径，取文件信息
   *
   * @param string $fileId
   * @return mixed
   */
  public function getFileInfo($filepath)
  {
    return $this->common('getFileInfo', [
      'filepath' => $filepath,
    ]);
  }
  
  /**
   * 通过文件路径，判断文件是否存在
   *
   * @param string $fileId
   * @return mixed
   */
  public function has($filepath)
  {
    return $this->common('has', [
      'filepath' => $filepath,
    ]);
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
