<?php

namespace OrderSystem\Framework\Providers;

use Slim\Container;

class Providers implements ProviderInterface
{
    private $providers = [
        EventBusProvider::class,
        CommandBusProvider::class,
        AdapterProvider::class
    ];

    public function __invoke(Container $container): Container
    {
        foreach ($this->providers as $provider) {
            $container = (new $provider)($container);
        }

        return $container;
    }
}