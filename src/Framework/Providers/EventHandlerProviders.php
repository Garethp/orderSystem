<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 14:14
 */

namespace OrderSystem\Framework\Providers;

use Slim\Container;

class EventHandlerProviders implements ProviderInterface
{

    public function __invoke(Container $container): Container
    {
        return $container;
    }
}
