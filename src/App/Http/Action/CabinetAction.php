<?php

namespace App\Http\Action;

use App\Http\Middleware\BasicAuthMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class CabinetAction
{
	public function __invoke( ServerRequestInterface $request ) : HtmlResponse
	{
		$username = $request->getAttribute( BasicAuthMiddleware::ATTRIBUTE );

		return new HtmlResponse( 'Welcome, ' . $username . '!' );
	}
}