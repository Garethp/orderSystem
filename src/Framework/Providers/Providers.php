<?php

namespace OrderSystem\Framework\Providers;

use Slim\Container;

class Providers
{
    private $providers = [
        EventBusProvider::class,
        CommandBusProvider::class
    ];

    public function __invoke(Container $container): Container
    {
        foreach ($this->providers as $provider) {
            $container = (new $provider)($container);
        }

        return $container;
    }
}