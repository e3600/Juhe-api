<?php

namespace JuheApi\Alipay;

use JuheApi\BasicService\ServiceContainer;

/**
 * Class Application.
 */
class Application extends ServiceContainer
{
    // 服务标识
    protected $serverMark = 'Alipay';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($config, $this->serverMark, true);
    }
    
    /**
     * @var array
     */
    protected $providers = [
        'uniTransfer' => uniTransfer\ServiceProvider::class,
        'Recharge'    => Recharge\ServiceProvider::class,
        'Realname'    => Realname\ServiceProvider::class,
    ];
}
