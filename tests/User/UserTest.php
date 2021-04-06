<?php

use \PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    /**
     * @var \App\User\User
     */
    private $user;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->user = new App\User\User();
        $this->user->setAge(33);
        $this->user->setEmail('example@test.com');
        $this->user->setName('Ilya');
        $this->user->setPassword("228");
    }

    /**
     *
     */
    protected function tearDown(): void
    {
    }

    /**
     * @dataProvider userProvider
     */
    public function testAge($age): void
    {
        self::assertSame($age, $this->user->getAge());
    }

    public function userProvider(): array
    {
        return [
            [33],
            [54],
        ];
    }
}