<?php

namespace Tests\App\Http\Action;

use App\Http\Action\HelloAction;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequest;

class HelloActionTest extends TestCase
{
	public function testGuest() : void
	{
		$action = new HelloAction();

		$request = new ServerRequest();
		$response = $action( $request );

		self::assertEquals( 200, $response->getStatusCode() );
		self::assertEquals( 'Hello, Guest!', $response->getBody()->getContents() );
	}

	public function testName() : void
	{
		$action = new HelloAction();

		$request = ( new ServerRequest() )
			->withQueryParams( [ 'name' => 'Ilya' ] );

		$response = $action( $request );

		self::assertEquals( 'Hello, Ilya!', $response->getBody()->getContents() );
	}
}