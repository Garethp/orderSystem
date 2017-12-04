<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 04/12/17
 * Time: 13:21
 */

namespace OrderSystem\Test\Identity;

use OrderSystem\Framework\MessageBus\CommandBus;

use OrderSystem\Framework\SlimFactory;
use OrderSystem\Identity\Domain\PasswordHasherInterface;
use OrderSystem\Identity\Domain\User\Repositories\UserRepositoryInterface;
use OrderSystem\Identity\Service\User\Command\RegisterUser;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $slimApp;

    /** @var  \Pimple\Psr11\Container */
    private $container;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function setUp()
    {
        $slimFactory = new SlimFactory();

        $this->slimApp = $slimFactory();
        $this->container = $this->slimApp->getContainer();
        $this->userRepository = $this->container->get(UserRepositoryInterface::class);

        parent::setUp();
    }

    public function testRegisterUser()
    {
        $this->container->get(CommandBus::class)->handle(new RegisterUser(
            'test@test.com',
            'test'
        ));

        $user = $this->userRepository->getUserByEmailAddress('test@test.com');

        self::assertNotNull($user);
        self::assertEquals('test@test.com', $user->getEmail());
        self::assertTrue($this->container->get(PasswordHasherInterface::class)->verifyPassword('test', $user->getHashedPassword()));
    }
}
