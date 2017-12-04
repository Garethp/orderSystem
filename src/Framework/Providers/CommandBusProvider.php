<?php

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\MessageBus\CommandBus;
use Slim\Container;

class CommandBusProvider implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[CommandBus::class] = function () use ($container) {
            return new CommandBus($container);
        };

        return $container;
    }
}
