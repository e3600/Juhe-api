<?php

namespace JuheApi;

use EasyWeChat\Kernel\ServiceContainer;

/**
 * Class Factory
 *
 * @method static \JuheApi\AuthMenu\Application               AuthMenu(array $config)
 * @method static \JuheApi\OfficialAccount\Application        OfficialAccount(array $config)
 * @method static \JuheApi\MiniProgram\Application            MiniProgram(array $config)
 * @method static \JuheApi\DeQrCode\Application               DeQrCode(array $config)
 * @method static \JuheApi\EnQrCode\Application               EnQrCode(array $config)
 * @method static \JuheApi\Ocr\Application                    Ocr(array $config)
 * @method static \JuheApi\ReplyMsg\Application               ReplyMsg(array $config)
 * @method static \JuheApi\Scws\Application                   Scws(array $config)
 * @method static \JuheApi\Sms\Application                    Sms(array $config)
 * @method static \JuheApi\Vcode\Application                  Vcode(array $config)
 * @method static \JuheApi\Video\Application                  Video(array $config)
 * @method static \JuheApi\Image\Application                  Image(array $config)
 * @method static \JuheApi\Common\Application                 Common(array $config)
 * @method static \JuheApi\Alipay\Application                 Alipay(array $config)
 * @method static \JuheApi\AliOss\Application                 AliOss($config = [])
 * @method static \JuheApi\OneDrive\Application               OneDrive($config = [])
 */
class Factory
{
  /**
   * @param string $name
   * @param array  $config
   *
   * @return ServiceContainer
   */
  public static function make($name, $config = [])
  {
    $namespace   = self::studly($name);
    $application = "\\JuheApi\\{$namespace}\\Application";
    return new $application($config);
  }
  
  /**
   * Dynamically pass methods to the application.
   *
   * @param string $name
   * @param array  $arguments
   *
   * @return ServiceContainer
   */
  public static function __callStatic($name, $arguments)
  {
    return self::make($name, ...$arguments);
  }
  
  public static function studly($value)
  {
    $value = ucwords(str_replace(['-', '_'], ' ', $value));
    return str_replace(' ', '', $value);
  }
  
  /**
   * 生成订单号
   *
   * @return string
   */
  public static function generateOrderId()
  {
    $first  = time() . mt_rand(100, 999);
    $second = substr(sha1(uniqid() . $first), -4);
    $third  = substr(sha1(uniqid() . $second), 0, 2);
    return strtoupper($first . $third . $second);
  }
}
