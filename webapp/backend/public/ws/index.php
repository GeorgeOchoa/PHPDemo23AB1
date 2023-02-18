<?php
require '../../vendor/autoload.php';

use DogtorPET\Backend\Rest\LoginController;
use DogtorPET\Backend\Rest\MascotaController;
use DogtorPET\Backend\Rest\TipoController;
use DogtorPET\Backend\Util\Config;

use Slim\Factory\AppFactory;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;

$app = AppFactory::create();
$config = Config::obtenerInstancia();
$logger = $config->crearLog();

### ENSAMBLANDO LOS INTERMEDIARIOS (MIDDLEWARE) ########################################
$app->add( new CorsMiddleware([
    'origin' => ['*'], // En fase de desarrollo (no usar en producción)
    'methods' => ['GET', 'POST', 'DELETE', 'PUT', 'OPTIONS', 'PATCH'],
    'headers.allow' => ['Authorization', 'Content-Type', '*'],
    'logger' => $logger
]) );

$app->add( new JwtAuthentication([
    'path' => ['/ws'],
    'ignore' => ['/ws/login'],
    'secret' => $config->jwtSecret(),
    'logger' => $logger,
    'secure' => false, // Permite llamadas por HTTP (no usar en producción)
    'error' => function($response, $args) {
        $mensaje = [ 'codigo' => 'error', 'mensaje'=>$args['message'] ];
        $response->getBody()->write( json_encode($mensaje) );
        return  $response->withHeader('Content-Type', 'application/json');
    }
]));
########################################################################################

### DESPACHAR LAS LLAMADAS CON LOGINCONTROLLER
$app->post('/ws/login', LoginController::class . ':login');

### DESPACHAR LAS LLAMADAS CON MASCOTACONTROLER
$app->get('/ws/mascota/{id}', MascotaController::class . ':obtener');
$app->get('/ws/mascota/catalogo/{propietario}', MascotaController::class . ':lista');
$app->post('/ws/mascota', MascotaController::class . ':insertar');
$app->put('/ws/mascota/{id}', MascotaController::class . ':actualizar');
$app->delete('/ws/mascota/{id}', MascotaController::class . ':eliminar');

### DESPACHAR LAS LLAMADAS CON TIPOCONTROLLER
$app->get('/ws/tipo', TipoController::class . ':lista');

$app->run();
?>
