<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:00
 */

namespace OrderSystem\Framework\Providers;

use Ramsey\Uuid\Uuid;
use Slim\Container;

class UuidProvider implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container['uuidGenerator'] = function () {
            return function () {
                return (string) Uuid::uuid4();
            };
        };

        return $container;
    }
}
