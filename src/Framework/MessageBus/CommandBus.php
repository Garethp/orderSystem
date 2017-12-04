<?php

namespace OrderSystem\Framework\MessageBus;

use OrderSystem\Identity\Service\User\Command\HandleRegisterUser;
use OrderSystem\Identity\Service\User\Command\RegisterUser;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use Slim\Container;

class CommandBus
{
    private $commandBus;
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->commandBus = $this->getCommandBus();
    }

    public function handle($command): void
    {
        $this->commandBus->handle($command);
    }

    public function getCommandHandlers(): array
    {
        return [
            RegisterUser::class => HandleRegisterUser::class,
        ];
    }

    private function getCommandBus(): MessageBusSupportingMiddleware
    {
        $commandBus = new MessageBusSupportingMiddleware();
        $commandBus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());

        $commandHandlers = $this->getCommandHandlers();

        $container = $this->container;

        $commandHandlerMap = new CallableMap($commandHandlers, new ServiceLocatorAwareCallableResolver(function ($serviceId) use ($container) {
            return $container[$serviceId];
        }));

        $commandNameResolver = new ClassBasedNameResolver();
        $commandHandlerResolver = new NameBasedMessageHandlerResolver($commandNameResolver, $commandHandlerMap);

        $commandBus->appendMiddleware(new DelegatesToMessageHandlerMiddleware($commandHandlerResolver));
        return $commandBus;
    }
}
