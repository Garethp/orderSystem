<?php

namespace OrderSystem\Identity\Service\User\Repository;

use OrderSystem\Identity\Domain\User;
use OrderSystem\Identity\Domain\User\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserMapperInterface
     */
    private $userMapper;

    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    public function saveUser(User $user): void
    {
        $this->userMapper->saveUser($user->getId(), $user);
    }

    public function getUserByEmailAddress(string $email): User
    {
        return $this->userMapper->getUserByEmailAddress($email);
    }
}
