<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 12:58
 */

namespace OrderSystem\Identity\Domain\User\Repositories;

use OrderSystem\Identity\Domain\User;

interface UserRepositoryInterface
{
    public function saveUser(User $user);

    public function getUserByEmailAddress(string $email): User;
}
