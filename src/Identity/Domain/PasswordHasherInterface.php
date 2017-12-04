<?php

namespace OrderSystem\Identity\Domain;

interface PasswordHasherInterface
{
    public function hashPassword(string $password): string;

    public function verifyPassword(string $password, string $hashedPassword): bool;
}
