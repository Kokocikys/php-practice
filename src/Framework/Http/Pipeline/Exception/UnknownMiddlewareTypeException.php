<?php

namespace Framework\Http\Pipeline\Exception;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UnknownMiddlewareTypeException extends InvalidArgumentException
{
	private $type;

	#[Pure] public function __construct( $type )
	{
		$logger = new Logger( 'Exception' );
		$logger->pushHandler( new StreamHandler( $_SERVER[ 'DOCUMENT_ROOT' ] . '/logs/exception.log' ) )
		       ->error( 'Exception', array( 'Name' => 'UnknownMiddlewareTypeException', 'Type' => $type ) );
		parent::__construct( 'Unknown middleware type' );
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}
}