<?php

namespace JuheApi\Call;

use JuheApi\BasicService\ServiceContainer;

/**
 * Class Application.
 */
class Application extends ServiceContainer
{
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($config);
    }

    /**
     * @var array
     */
    protected $providers = [
        'OfficialAccount' => OfficialAccount\ServiceProvider::class,
        // 'MiniProgram'  => MiniProgram\ServiceProvider::class,
    ];
}
