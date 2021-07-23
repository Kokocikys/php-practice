<?php

namespace Framework\Http\Pipeline;

use Framework\Http\Pipeline\Exception\UnknownMiddlewareTypeException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use ReflectionObject;

use function count;
use function is_array;
use function is_object;
use function is_string;

class MiddlewareResolver
{
	public function resolve( $handler ) : callable
	{
		if ( is_array( $handler ) ) {
			return $this->createPipe( $handler );
		}

		if ( is_string( $handler ) ) {
			return function( ServerRequestInterface $request, ResponseInterface $response, callable $next ) use ( $handler ) {
				$middleware = $this->resolve( new $handler() );
				return $middleware( $request, $response, $next );
			};
		}

		if ( $handler instanceof MiddlewareInterface ) {
			return static function( ServerRequestInterface $request, ResponseInterface $response, callable $next ) use ( $handler ) {
				return $handler->process( $request, new PSRHandlerWrapper( $next ) );
			};
		}

		if ( is_object( $handler ) ) {
			$reflection = new ReflectionObject( $handler );
			if ( $reflection->hasMethod( '__invoke' ) ) {
				$method = $reflection->getMethod( '__invoke' );
				$parameters = $method->getParameters();
				if ( count( $parameters ) === 2 && $parameters[ 1 ]->getType() && $parameters[ 1 ]->getType()
				                                                                                  ->getName() === 'callable' ) {
					return static function( ServerRequestInterface $request, ResponseInterface $response, callable $next ) use ( $handler ) {
						return $handler( $request, $next );
					};
				}
				return $handler;
			}
		}

		throw new UnknownMiddlewareTypeException( $handler );
	}

	private function createPipe( array $handlers ) : Pipeline
	{
		$pipeline = new Pipeline();
		foreach ( $handlers as $handler ) {
			$pipeline->pipe( $this->resolve( $handler ) );
		}
		return $pipeline;
	}
}