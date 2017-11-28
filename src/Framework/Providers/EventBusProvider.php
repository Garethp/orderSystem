<?php

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\EventBus;
use Slim\Container;

class EventBusProvider
{
    public function __invoke(Container $container): Container
    {
        $container[EventBus::class] = function() {
            return new EventBus();
        };

        return $container;
    }
}