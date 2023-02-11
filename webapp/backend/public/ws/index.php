<?php
require '../../vendor/autoload.php';

use DogtorPET\Backend\Rest\MascotaController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();


// TODO: Implementar Middleware para autenticar por JWT y evitar el prolema de CORS

$app->get('/ws/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/ws/mascota/{id}', MascotaController::class . ':obtener');
$app->get('/ws/mascota/catalogo/{propietario}', MascotaController::class . ':lista');
$app->post('/ws/mascota', MascotaController::class . ':insertar');
$app->put('/ws/mascota/{id}', MascotaController::class . ':actualizar');
$app->delete('/ws/mascota/{id}', MascotaController::class . ':eliminar');

$app->run();
?>
