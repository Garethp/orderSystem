<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:18
 */

namespace OrderSystem\Framework\Providers;

use OrderSystem\Framework\Identity\Mappers\UserMapper;
use OrderSystem\Framework\Persistence\Adapters\AdapterInterface;
use OrderSystem\Identity\Domain\User\Repositories\UserRepositoryInterface;
use OrderSystem\Identity\Service\User\Repository\UserMapperInterface;
use OrderSystem\Identity\Service\User\Repository\UserRepository;
use Slim\Container;

class RepositoryProviders implements ProviderInterface
{
    public function __invoke(Container $container): Container
    {
        $container[UserRepositoryInterface::class] = function () use ($container) {
            return new UserRepository($container->get(UserMapperInterface::class));
        };

        $container[UserMapperInterface::class] = function () use ($container) {
            return new UserMapper($container->get(AdapterInterface::class));
        };

        return $container;
    }
}
