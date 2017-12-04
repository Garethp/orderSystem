<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:12
 */

namespace OrderSystem\Identity\Service\User\Repository;

use OrderSystem\Identity\Domain\User;

interface UserMapperInterface
{
    public function saveUser(string $id, User $user): void;

    public function getUserByEmailAddress(string $email);
}
