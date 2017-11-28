<?php

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\CommandBus;
use Slim\Container;

class CommandBusProvider
{
    public function __invoke(Container $container): Container
    {
        $container[CommandBus::class] = function () {
            return new CommandBus();
        };

        return $container;
    }
}