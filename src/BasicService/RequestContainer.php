<?php

namespace JuheApi\BasicService;

use JuheApi\Kernel\Http;

class RequestContainer
{
  protected $config = [];
  private $serverMark = '';
  
  public function __construct($config = null, $serverMark = '')
  {
    $this->config     = $config;
    $this->serverMark = $serverMark;
  }
  
  /**
   * 聚合权限接口专用
   *
   * @param array $data
   * @param array $query
   * @param bool  $returnJson
   * @return mixed
   */
  protected function httpPostJsonAuth($data = [], $query = [], $returnJson = true)
  {
    return Http::httpPostJson(
      sprintf('%sam/%s', $this->config['requeseUrl'], $this->config['project_auth_key']),
      array_merge($data, ['debug' => $this->config['debug']]),
      $query,
      $returnJson
    );
  }
  
  /**
   * 聚合服务1.0，普通接口专用
   *
   * @param array $data
   * @param array $query
   * @param bool  $returnJson
   * @return mixed
   */
  protected function httpPostJsonV1($data = [], $query = [], $returnJson = true)
  {
    return Http::httpPostJson(
      sprintf('%sk/%s/%s', $this->config['requeseUrl'], $this->config['project_key'], $this->serverMark),
      array_merge($data, ['debug' => $this->config['debug']]),
      $query,
      $returnJson
    );
  }
  
  /**
   * 聚合服务1.0，上传接口专用
   *
   * @param array $files
   * @param array $form
   * @param array $query
   * @return mixed
   */
  protected function httpUploadV1($files = [], $form = [], $query = [])
  {
    return Http::httpUpload(
      sprintf('%sk/%s/%s', $this->config['requeseUrl'], $this->config['project_key'], $this->serverMark),
      $files,
      array_merge($form, ['debug' => $this->config['debug']]),
      $query
    );
  }
  
  /**
   * 聚合服务2.0，普通接口专用
   *
   * @param array $data
   * @param array $query
   * @param bool  $returnJson
   * @return mixed
   */
  protected function httpPostJsonV2($data = [], $query = [], $returnJson = true)
  {
    return Http::httpPostJson(
      sprintf('%sk/%s', $this->config['requeseUrl'], $this->config['config_key']),
      array_merge($data, ['debug' => $this->config['debug']]),
      $query,
      $returnJson
    );
  }
  
  /**
   * 聚合服务2.0，上传接口专用
   *
   * @param array $files
   * @param array $form
   * @param array $query
   * @return mixed
   */
  protected function httpUploadV2($files = [], $form = [], $query = [])
  {
    return Http::httpUpload(
      sprintf('%sk/%s', $this->config['requeseUrl'], $this->config['config_key']),
      $files,
      array_merge($form, ['debug' => $this->config['debug']]),
      $query
    );
  }
  
  /**
   * 简单安全过虑
   *
   * @param string $name
   * @param string $defaltu
   * @return mixed|string
   */
  protected function input($name, $defaltu = '')
  {
    if (isset($_GET[$name])) {
      return addslashes($_GET[$name]);
    } elseif (isset($_POST[$name])) {
      return addslashes($_POST[$name]);
    } else {
      return $defaltu;
    }
  }
}
