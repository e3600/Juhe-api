<?php

namespace JuheApi\AuthMenu;

// 权限判断
trait Can
{
  /**
   * 权限判断
   *
   * @param string       $authMark 权限标识(鉴权标识)，如：Service.paginate，控制名 + 方法名
   * @param string|array $roles    角色名，可以数组或字符串
   */
  public static function can(string $authMark, $roles)
  {
    self::init();
    $permission = self::roleGetAuth($roles);
    if ($permission['status'] == 0) {
      self::$error = $permission['message'] ?? '未知错误';
      return false;
    }
    if ($permission['permission_fun'] == '*') {
      return true;
    }
    if (!in_array($authMark, $permission['permission_fun'])) {
      self::$error = '暂无权限:' . $authMark;
      return false;
    }
    return true;
  }
}
