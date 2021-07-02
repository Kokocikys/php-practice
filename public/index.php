<?php

use App\Http\Action;

use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\SimpleRouter;
use Framework\Logger\Logger;

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__ . '/../vendor/autoload.php';

### Initialization

$routes = new RouteCollection();

$routes->get( 'home', '/', Action\HelloAction::class );
$routes->get( 'about', '/about', Action\AboutAction::class );
$routes->get( 'blog', '/blog', Action\Blog\IndexAction::class );
$routes->get( 'blog_show', '/blog/{id}', Action\Blog\ShowAction::class, [ 'id' => '\d+' ] );

$router = new SimpleRouter( $routes );
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
	$log = new Logger();
	$log->logLoadedPage( $_SERVER[ "REQUEST_URI" ] );
}
catch ( RequestNotMatchedException $e ) {
	$response = new HtmlResponse( 'Undefined page', 404 );
}

### Postprocessing

$response = $response->withHeader( 'X-Developer', 'Kokocikys' );

### Sending

$emitter = new SapiEmitter();
$emitter->emit( $response );