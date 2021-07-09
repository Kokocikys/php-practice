<?php

namespace Tests\App\Http\Action\Blog;

use App\Http\Action\Blog\IndexAction;
use PHPUnit\Framework\TestCase;

class IndexActionTest extends TestCase
{
	/**
	 * @throws \JsonException
	 */
	public function testSuccess() : void
	{
		$action = new IndexAction();
		$response = $action();

		self::assertEquals( 200, $response->getStatusCode() );
		self::assertJsonStringEqualsJsonString(
			json_encode( [
				             [ 'id' => 1, 'title' => 'The First Post' ],
				             [ 'id' => 2, 'title' => 'The Second Post' ],
			             ], JSON_THROW_ON_ERROR
			),
			$response->getBody()->getContents()
		);
	}
}