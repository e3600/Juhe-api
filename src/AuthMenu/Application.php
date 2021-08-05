<?php

namespace JuheApi\AuthMenu;

use JuheApi\Kernel\Response;
use JuheApi\BasicService\BaseConfig;
use JuheApi\BasicService\RequestContainer;

/**
 * Class Application.
 */
class Application extends RequestContainer
{
  use Can;
  use Common;
  use Response;
  use BaseConfig;
  
  private $frame = '未知框架，无法使用';  // 框架
  
  public function __construct(array $config = [], array $prepends = [], string $id = null)
  {
    // 框架类型
    if (!isset($config['frame'])) {
      if (defined('IN_DISCUZ')) {
        $this->frame = 'discuz';
      } else if (function_exists('auth') && function_exists('route')) {
        $this->frame = 'lumen';
      } else {
        exit($this->frame);
      }
    } else {
      if (in_array($config['frame'], ['discuz', 'lumen'])) {
        $this->frame = $config['frame'];
      } else {
        exit($this->frame);
      }
    }
    
    parent::__construct($this->initConfig($config, ''), '');
  }
  
  /**
   * 取权限列表
   *
   * @param array $params
   * @return mixed
   */
  public function get_list_permission($params = [])
  {
    return $this->httpPostJsonAuth(
      array_merge([
        'action' => 'get_permission_list',
      ], $params)
    );
  }
  
  /**
   * 取菜单列表
   *
   * @param array $params
   * @return mixed
   */
  public function get_list_meun($params = [])
  {
    return $this->httpPostJsonAuth(
      array_merge([
        'action' => 'get_meun_list',
      ], $params)
    );
  }
  
  /**
   * 取角色列表
   *
   * @param array $params
   * @return mixed
   */
  public function get_list_role($params = [])
  {
    return $this->httpPostJsonAuth(
      array_merge([
        'action' => 'get_role_list',
      ], $params)
    );
  }
  
  /**
   * 角色标识取指定角色的授权(菜单/权限)
   *
   * @param array|string $role_mark 角色标识
   * @return mixed
   */
  public function get_auth($role_mark)
  {
    if (is_array($role_mark)) {
      $role_mark = implode(',', $role_mark);
    }
    return $this->httpPostJsonAuth(
      [
        'action'    => 'role_mark_get_auth',
        'role_mark' => $role_mark,
      ], [], false
    );
  }
}
