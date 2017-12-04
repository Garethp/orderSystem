<?php

namespace OrderSystem\Framework\Identity\Mappers;

use OrderSystem\Framework\Persistence\Adapters\AdapterInterface;
use OrderSystem\Framework\Persistence\RecordNotFoundException;
use OrderSystem\Identity\Domain\User;
use OrderSystem\Identity\Service\User\Repository\UserMapperInterface;

class UserMapper implements UserMapperInterface
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function saveUser(string $id, User $user): void
    {
        $this->adapter->set($id, $user);
    }

    public function getUserByEmailAddress(string $email): User
    {
        /** @var User[] $users */
        $users = $this->adapter->getAll();

        foreach ($users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        throw new RecordNotFoundException();
    }
}
