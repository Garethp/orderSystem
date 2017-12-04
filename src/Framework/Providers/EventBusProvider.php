<?php

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\MessageBus\EventBus;
use Slim\Container;

class EventBusProvider implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[EventBus::class] = function () use ($container) {
            return new EventBus($container);
        };

        return $container;
    }
}
