<?php

namespace JuheApi\BasicService;

use Pimple\Container;
use JuheApi\Kernel\Response;

class ServiceContainer extends Container
{
    use Response;
    use CheckConfig;
    protected $config = [];
    /**
     * Constructor.
     *
     * @param array       $config
     * @param array       $prepends
     * @param string|null $id
     */
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        $this->checkConfig($config);
        $this->config = $config;
        $this->registerProviders($this->getProviders());
    }
    
    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }
    
    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
    
    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
        // return array_merge([
        //     ConfigServiceProvider::class,
        //     LogServiceProvider::class,
        //     RequestServiceProvider::class,
        //     HttpClientServiceProvider::class,
        //     ExtensionServiceProvider::class,
        //     EventDispatcherServiceProvider::class,
        // ], $this->providers);
    }
    
    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $key => $provider) {
            $this[$key] = new $provider($this->config);
        }
    }
}
