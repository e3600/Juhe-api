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
  use Response;
  use BaseConfig;
  
  public function __construct(array $config = [], array $prepends = [], string $id = null)
  {
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
      ],[],false
    );
  }
}
