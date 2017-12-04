<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 12:48
 */

namespace OrderSystem\Identity\Service\User\Command;

use OrderSystem\Framework\MessageBus\EventBusInterface;
use OrderSystem\Identity\Domain\PasswordHasherInterface;
use OrderSystem\Identity\Domain\User;
use OrderSystem\Identity\Domain\User\Repositories\UserRepositoryInterface;

class HandleRegisterUser
{
    private $passwordHasher;
    private $uuidGenerator;
    private $userRepository;
    private $eventBus;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordHasherInterface $passwordHasher,
        EventBusInterface $eventBus,
        callable $uuidGenerator
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->uuidGenerator = $uuidGenerator;
        $this->userRepository = $userRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(RegisterUser $registerUserCommand)
    {
        $user = new User(
            ($this->uuidGenerator)(),
            $registerUserCommand->getEmail(),
            $this->passwordHasher->hashPassword($registerUserCommand->getPassword()),
            $this->passwordHasher
        );

        $this->userRepository->saveUser($user);
        $this->eventBus->fire(new User\Events\UserRegisteredEvent(
            $user->getId(),
            $user->getEmail(),
            $user->getHashedPassword()
        ));
    }
}
