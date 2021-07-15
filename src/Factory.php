<?php

namespace JuheApi;

class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \EasyWeChat\Kernel\ServiceContainer
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
     * @return mixed
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
