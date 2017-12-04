<?php

namespace OrderSystem\Framework\MessageBus;

use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableCollection;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use SimpleBus\Message\Subscriber\NotifiesMessageSubscribersMiddleware;
use SimpleBus\Message\Subscriber\Resolver\NameBasedMessageSubscriberResolver;

class EventBus implements EventBusInterface
{
    private $eventBus;

    public function __construct()
    {
        $this->eventBus = $this->getEventBus();
    }

    public function fire(EventInterface $event): void
    {
        $this->eventBus->handle($event);
    }

    private function getEventHandlers(): array
    {
        return [
        ];
    }

    private function transformEventHandlers(array $eventHandlers): array
    {
        foreach ($eventHandlers as $key => $handlers) {
            if (!is_array($handlers)) {
                $handlers = [$handlers];
            }

            foreach ($handlers as $handlerKey => $handler) {
                if (is_string($handler)) {
                    $handlers[$handlerKey] = function ($event) use ($handler) {
                        return (new $handler)($event);
                    };
                }
            }

            $eventHandlers[$key] = $handlers;
        }

        return $eventHandlers;
    }

    private function getEventBus(): MessageBusSupportingMiddleware
    {
        $eventBus = new MessageBusSupportingMiddleware();
        $eventBus->appendMiddleware(new FinishesHandlingMessageBeforeHandlingNext());

        $eventHandlers = $this->getEventHandlers();
        $eventHandlers = $this->transformEventHandlers($eventHandlers);

        $eventSubscribers = new CallableCollection($eventHandlers, new ServiceLocatorAwareCallableResolver(function () {
        }));

        $eventNameResolver = new ClassBasedNameResolver();
        $eventSubscriberResolver = new NameBasedMessageSubscriberResolver($eventNameResolver, $eventSubscribers);
        $eventBus->appendMiddleware(new NotifiesMessageSubscribersMiddleware($eventSubscriberResolver));
        return $eventBus;
    }
}
