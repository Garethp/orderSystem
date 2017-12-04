<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:27
 */

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\Identity\PasswordHasher;
use OrderSystem\Identity\Domain\PasswordHasherInterface;
use Slim\Container;

class PasswordHasherProvider implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[PasswordHasherInterface::class] = function () {
            return new PasswordHasher();
        };

        return $container;
    }
}
