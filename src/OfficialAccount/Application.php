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
        // Server\ServiceProvider::class,
        // User\ServiceProvider::class,
        // OAuth\ServiceProvider::class,
        // Menu\ServiceProvider::class,
        // TemplateMessage\ServiceProvider::class,
        // Material\ServiceProvider::class,
        // CustomerService\ServiceProvider::class,
        // Semantic\ServiceProvider::class,
        // DataCube\ServiceProvider::class,
        // POI\ServiceProvider::class,
        // AutoReply\ServiceProvider::class,
        // Broadcasting\ServiceProvider::class,
        // Card\ServiceProvider::class,
        // Device\ServiceProvider::class,
        // ShakeAround\ServiceProvider::class,
        // Store\ServiceProvider::class,
        // Comment\ServiceProvider::class,
        // Base\ServiceProvider::class,
        // OCR\ServiceProvider::class,
        // Goods\ServiceProvider::class,
        // WiFi\ServiceProvider::class,
        // // Base services
        // BasicService\QrCode\ServiceProvider::class,
        // BasicService\Media\ServiceProvider::class,
        // BasicService\Url\ServiceProvider::class,
        // BasicService\Jssdk\ServiceProvider::class,
        // // Append Guide Interface
        // Guide\ServiceProvider::class,
    ];
}
