<?php

namespace JuheApi\Common;

use JuheApi\BasicService\ServiceContainer;

/**
 * Class Application.
 */
class Application extends ServiceContainer
{
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($config, '', false);
    }
    
    /**
     * @var array
     */
    protected $providers = [
        'Response' => Response\ServiceProvider::class,
    ];
    
     /**
     * 生成订单号
     *
     * @return string
     */
    public function generateOrderId()
    {
        $first  = time() . mt_rand(100, 999);
        $second = substr(sha1(uniqid() . $first), -4);
        $third  = substr(sha1(uniqid() . $second), 0, 2);
        return strtoupper($first . $third . $second);
    }
}
