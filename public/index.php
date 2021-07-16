<?php
declare( strict_types = 1 );

use App\Http\Action;

use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\AuraRouterAdapter;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require $_SERVER[ 'DOCUMENT_ROOT' ] . '/vendor/autoload.php';
date_default_timezone_set( 'Europe/Minsk' );

### Initialization

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get( 'home', '/', Action\HelloAction::class );
$routes->get( 'about', '/about', Action\AboutAction::class );
$routes->get( 'blog', '/blog', Action\Blog\IndexAction::class );
$routes->get( 'blog_show', '/blog/{id}', Action\Blog\ShowAction::class )->tokens( [ 'id' => '\d+' ] );

$router = new AuraRouterAdapter( $aura );
$resolver = new ActionResolver();

### Running

$request = ServerRequestFactory::fromGlobals();

try {
	$result = $router->match( $request );
	foreach ( $result->getAttributes() as $attribute => $value ) {
		$request = $request->withAttribute( $attribute, $value );
	}
	$action = $resolver->resolve( $result->getHandler() );
	$response = $action( $request );
}
catch ( RequestNotMatchedException $exception ) {
	$response = new HtmlResponse( 'Undefined page', 404 );
	$logger = new Logger( 'APP' );
	$logger->pushHandler( new StreamHandler( $_SERVER[ 'DOCUMENT_ROOT' ] . '/logs/info.log' ) )
	       ->info( 'Required non-existing page', array( 'page' => $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ] ) );
}

### Postprocessing

$response = $response->withHeader( 'X-Developer', 'Kokocikys' );

### Sending

$emitter = new SapiEmitter();
$emitter->emit( $response );