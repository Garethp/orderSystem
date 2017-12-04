<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 12:46
 */

namespace OrderSystem\Identity\Domain\User\Events;

use OrderSystem\Framework\MessageBus\EventInterface;

class UserRegisteredEvent implements EventInterface
{
    private $id;
    private $email;
    private $hashedPassword;

    /**
     * UserRegisteredEvent constructor.
     * @param $id
     * @param $email
     * @param $hashedPassword
     */
    public function __construct(string $id, string $email, string $hashedPassword)
    {
        $this->id = $id;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
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
}
