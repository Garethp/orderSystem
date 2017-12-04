<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 12:46
 */

namespace OrderSystem\Identity\Service\User\Command;

class RegisterUser
{
    private $email;
    private $password;

    /**
     * RegisterUser constructor.
     * @param $email
     * @param $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
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
    public function getPassword(): string
    {
        return $this->password;
    }
}
