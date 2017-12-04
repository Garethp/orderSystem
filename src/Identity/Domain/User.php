<?php

namespace OrderSystem\Identity\Domain;

class User
{
    private $id;
    private $email;
    private $hashedPassword;
    private $passwordHasher;

    public function __construct(
        string $id,
        string $email,
        string $hashedPassword,
        PasswordHasherInterface $passwordHasher
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function changePassword(string $password): void
    {
        $this->hashedPassword = $this->passwordHasher->hashPassword($password);
    }
}
