<?php

use App\Shit\ShityLogic;
use Koko\Fakes\FakeMailer;
use Koko\Http\Client;
use Koko\Mailer\Standard;
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

    protected function setUp(): void
    {
        $mailer = new FakeMailer();

        $httpClientStub = $this->createStub(Client::class);
        $httpClientStub->method('getData')->willReturn('Сообщение по умолчанию');

        $this->res = new App\Shit\ShityLogic($mailer, $httpClientStub);
    }

    protected function tearDown(): void
    {
    }

    /**
     * @dataProvider dataProvider
     * @param $str
     * @param $char
     */
    public function testLastChar($str, $char): void
    {
        $result = $this->res->lastChar($str);

        self::assertSame($char, $result);
    }

    public function testLastCharError(): void
    {
        $result = $this->res->lastChar("00010");

        self::assertNotEquals('$str last char is 1', $result);
    }

    public function testIsEmailSent(): void
    {
        $mailer = $this->createMock(Standard::class);
        $mailer->expects(self::once())->method('send');
        $client = new Client();
        $lastChar = new ShityLogic($mailer, $client);
        $lastChar->lastChar("00100");
    }

    /**
     * @return \int[][]
     */
    public function dataProvider(): array
    {
        return [
            "Last char is 1" => ['010101', '$str last char is 1'],
            "Last char is 0" => ['0100', '$str last char is 0'],
        ];
    }
}