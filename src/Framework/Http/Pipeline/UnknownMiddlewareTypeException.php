<?php

namespace Framework\Http\Pipeline;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class UnknownMiddlewareTypeException extends InvalidArgumentException
{
	private $type;

	#[Pure] public function __construct( $type )
	{
		parent::__construct( 'Unknown middleware type' );
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}
}