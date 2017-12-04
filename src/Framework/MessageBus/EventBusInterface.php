<?php

namespace OrderSystem\Framework\MessageBus;

interface EventBusInterface
{
    public function fire(EventInterface $event): void;
}
