<?php

namespace Framework\Logger;

use Monolog\Handler\StreamHandler;

require $_SERVER[ "DOCUMENT_ROOT" ] . '/vendor/autoload.php';

class Logger
{
	protected static     $instance;
	public static string $logName;
	public static string $filePath;

	public function __construct( string $logName, string $filePath = '/logs/info.log' )
	{
		self::$logName = $logName;
		self::$filePath = $_SERVER[ 'DOCUMENT_ROOT' ] . $filePath;
	}

	public static function getLogger() : mixed
	{
		if ( !self::$instance ) {
			self::configureInstance();
		}
		return self::$instance;
	}

	private static function configureInstance() : void
	{
		date_default_timezone_set( 'Europe/Minsk' );
		$logger = new \Monolog\Logger( self::$logName );
		$logger->pushHandler( new StreamHandler( self::$filePath ) );
		self::$instance = $logger;
	}

	public function warning( $message, array $context = array() ) : void
	{
		self::getLogger()->warning( $message, $context );
	}

	public function debug( $message, array $context = array() ) : void
	{
		self::getLogger()->debug( $message, $context );
	}

	public function info( $message, array $context = array() ) : void
	{
		self::getLogger()->info( $message, $context );
	}

	public function notice( $message, array $context = array() ) : void
	{
		self::getLogger()->notice( $message, $context );
	}

	public function error( $message, array $context = array() ) : void
	{
		self::getLogger()->error( $message, $context );
	}

	public function critical( $message, array $context = array() ) : void
	{
		self::getLogger()->critical( $message, $context );
	}

	public function alert( $message, array $context = array() ) : void
	{
		self::getLogger()->alert( $message, $context );
	}
}