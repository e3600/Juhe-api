<?php

namespace JuheApi\OfficialAccount;

use JuheApi\BasicService\ServiceContainer;

/**
 * Class Application.
 */
class Application extends ServiceContainer
{
    // 服务标题
    protected $serverMark = 'WxMp';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($config, $this->serverMark);
    }
    
    /**
     * @var array
     */
    protected $providers = [
        'Login' => Login\ServiceProvider::class,
        'Menu'  => Menu\ServiceProvider::class,
        'Media' => Media\ServiceProvider::class,
    ];
}
