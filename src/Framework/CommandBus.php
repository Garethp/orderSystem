<?php

namespace OrderSystem\Framework;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;

class CommandBus
{
    private $commandBus;

    public function __construct()
    {
        $this->commandBus = $this->getCommandBus();
    }

    public function handle($command): void
    {
        $this->commandBus->handle($command);
    }

    public function getCommandHandlers(): array
    {
        return [
        ];
    }

    private function getCommandBus(): MessageBusSupportingMiddleware
    {
        $commandBus = new MessageBusSupportingMiddleware();
        $commandBus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());

        $commandHandlers = $this->getCommandHandlers();
        $commandHandlers = $this->transformCommandHandlers($commandHandlers);

        $commandHandlerMap = new CallableMap($commandHandlers, new ServiceLocatorAwareCallableResolver(function () {

        }));

        $commandNameResolver = new ClassBasedNameResolver();
        $commandHandlerResolver = new NameBasedMessageHandlerResolver($commandNameResolver, $commandHandlerMap);

        $commandBus->appendMiddleware(new DelegatesToMessageHandlerMiddleware($commandHandlerResolver));
        return $commandBus;
    }

    private function transformCommandHandlers(array $handlers): array
    {
        foreach ($handlers as $key => $handler) {
            if (is_string($handler)) {
                $handlers[$key] = function ($command) use ($handler) {
                    (new $handler)($command);
                };
            }
        }

        return $handlers;
    }
}