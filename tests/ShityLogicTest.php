<?php

use App\Shit\ShityLogic;
use \PHPUnit\Framework\TestCase;

/**
 * Class ShityLogicTest
 */
class ShityLogicTest extends TestCase
{
    /**
     * @var App\Shit\ShityLogic
     */
    protected ShityLogic $res;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->res = new App\Shit\ShityLogic();
    }

    /**
     *
     */
    protected function tearDown(): void
    {
    }

    /**
     * @dataProvider dataProvider
     * @param $num
     * @param $char
     */
    public function testLastChar($num, $char): void
    {
        $this->res->setRes($num);
        self::assertSame($char, $this->res->lastChar());
    }

    /**
     * @return \int[][]
     */
    public function dataProvider(): array
    {
        return [
            "Failed" => ['0100111', '$var last char is 1'],
            "Success" => ['010', '$var last char is 0'],
        ];
    }
}