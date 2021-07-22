<?php

namespace Framework\Http\Pipeline;

use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SplQueue;

class Pipeline
{
	private SplQueue $queue;

	#[Pure] public function __construct()
	{
		$this->queue = new SplQueue();
	}

	public function __invoke( ServerRequestInterface $request, ResponseInterface $response, callable $next ) : ResponseInterface
	{
		$delegate = new Next( clone $this->queue, $next );
		return $delegate( $request, $response );
	}

	public function pipe( $middleware ) : void
	{
		$this->queue->enqueue( $middleware );
	}
}