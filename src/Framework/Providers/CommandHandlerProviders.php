<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:35
 */

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\MessageBus\EventBus;
use OrderSystem\Identity\Domain\PasswordHasherInterface;
use OrderSystem\Identity\Domain\User\Repositories\UserRepositoryInterface;
use OrderSystem\Identity\Service\User\Command\HandleRegisterUser;
use Slim\Container;

class CommandHandlerProviders implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[HandleRegisterUser::class] = function () use ($container) {
                return new HandleRegisterUser(
                    $container->get(UserRepositoryInterface::class),
                    $container->get(PasswordHasherInterface::class),
                    $container->get(EventBus::class),
                    $container->get('uuidGenerator')
                );
        };

        return $container;
    }
}
