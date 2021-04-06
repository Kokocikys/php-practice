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

    protected function setUp(): void
    {
        $this->user = new App\User\User();
        $this->user->setAge(33);
    }

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

    /**
     * @return \int[][]
     */
    public function dataProvider(): array
    {
        return [
            "Success" => [33],
//            "Failed" => [54],
        ];
    }
}