<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;
use Throwable;

class ErrorHandlerMiddleware
{
	private mixed $debug;

	public function __construct( $debug = false )
	{
		$this->debug = $debug;
	}

	public function __invoke( ServerRequestInterface $request, callable $next ) : Response|JsonResponse|HtmlResponse
	{
		try {
			return $next( $request );
		}
		catch ( Throwable $e ) {
			if ( $this->debug ) {
				return new JsonResponse( [
					                         'error'   => 'Server error',
					                         'code'    => $e->getCode(),
					                         'message' => $e->getMessage(),
					                         'trace'   => $e->getTrace(),
				                         ], 500
				);
			}
			return new HtmlResponse( 'Server error', 500 );
		}
	}
}