<?php

namespace Tests\Framework\Http\Pipeline;

use Framework\Http\Pipeline\Pipeline;

use PHPUnit\Framework\TestCase;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;

class PipelineTest extends TestCase
{
	/**
	 * @throws \JsonException
	 */
	public function testPipe() : void
	{
		$pipeline = new Pipeline();

		$pipeline->pipe( new Middleware1() );
		$pipeline->pipe( new Middleware2() );

		$response = $pipeline( new ServerRequest(), new Response(), new Last() );

		$this->assertJsonStringEqualsJsonString(
			json_encode( [ 'middleware-1' => 1, 'middleware-2' => 2 ], JSON_THROW_ON_ERROR ),
			$response->getBody()->getContents()
		);
	}
}

class Middleware1
{
	public function __invoke( ServerRequestInterface $request, ResponseInterface $response, callable $next )
	{
		return $next( $request->withAttribute( 'middleware-1', 1 ) );
	}
}

class Middleware2
{
	public function __invoke( ServerRequestInterface $request, ResponseInterface $response, callable $next )
	{
		return $next( $request->withAttribute( 'middleware-2', 2 ) );
	}
}

class Last
{
	public function __invoke( ServerRequestInterface $request ) : JsonResponse
	{
		return new JsonResponse( $request->getAttributes() );
	}
}