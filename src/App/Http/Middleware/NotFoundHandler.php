<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class NotFoundHandler
{
    public function __invoke(ServerRequestInterface $request) : HtmlResponse
    {
        return new HtmlResponse('Undefined page', 404);
    }
}