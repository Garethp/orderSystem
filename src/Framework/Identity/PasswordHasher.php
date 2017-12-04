<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:28
 */

namespace OrderSystem\Framework\Identity;

use OrderSystem\Identity\Domain\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}
