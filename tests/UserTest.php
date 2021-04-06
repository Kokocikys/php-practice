<?php

use App\User\User;
use \PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    /**
     * @var \App\User\User
     */
    protected User $user;

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
     * @dataProvider dataProvider
     * @param $age
     */
    public function testAge($age): void
    {
        self::assertSame($age, $this->user->getAge());
    }

    public function dataProvider(): array
    {
        return [
            [33],
        ];
    }
}