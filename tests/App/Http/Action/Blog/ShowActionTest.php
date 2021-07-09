<?php

namespace Tests\App\Http\Action\Blog;

use App\Http\Action\Blog\ShowAction;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequest;

class ShowActionTest extends TestCase
{
	/**
	 * @throws \JsonException
	 */
	public function testSuccess() : void
	{
		$action = new ShowAction();

		$request = ( new ServerRequest() )
			->withAttribute( 'id', $id = 2 );

		$response = $action( $request );

		self::assertEquals( 200, $response->getStatusCode() );
		self::assertJsonStringEqualsJsonString(
			json_encode( [ 'id' => $id, 'title' => 'Post #' . $id ], JSON_THROW_ON_ERROR ),
			$response->getBody()->getContents()
		);
	}

	public function testNotFound() : void
	{
		$action = new ShowAction();

		$request = ( new ServerRequest() )
			->withAttribute( 'id', 100 );

		$response = $action( $request );

		self::assertEquals( 404, $response->getStatusCode() );
		self::assertEquals( 'Undefined page', $response->getBody()->getContents() );
	}
}