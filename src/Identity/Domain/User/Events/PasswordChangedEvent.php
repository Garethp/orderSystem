<?php

namespace OrderSystem\Identity\Domain\User\Events;

class PasswordChangedEvent
{
    private $userId;
    private $hashedPassword;

    /**
     * PasswordChangedEvent constructor.
     * @param $userId
     * @param $hashedPassword
     */
    public function __construct(string $userId, string $hashedPassword)
    {
        $this->userId = $userId;
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }
}
