<?php

use App\Http\Action;

use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Logger\Logger;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require $_SERVER[ 'DOCUMENT_ROOT' ] . '/vendor/autoload.php';

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