<?php

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\Persistence\Adapters\AdapterInterface;
use OrderSystem\Framework\Persistence\Adapters\ArrayAdapter;
use Slim\Container;

class AdapterProvider implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[ArrayAdapter::class] = function () {
            return new ArrayAdapter();
        };

        $container[AdapterInterface::class] = function ($container) {
            return $container[ArrayAdapter::class];
        };

        return $container;
    }
}
