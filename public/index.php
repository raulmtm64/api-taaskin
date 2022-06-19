<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
// $app->get('/', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name"); 
//     Lo del nombre en la URL 

//     return $response;
//     echo "Hello World";
// });

// Rutas de los archivos

// Ruta de login
require '../src/routes/login.php';

// Ruta de register
require '../src/routes/register.php';



$app->run();