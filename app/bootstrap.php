<?php

use DI\ContainerBuilder;
use FastRoute\Dispatcher;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../app/config/services.php');
$container =  $containerBuilder->build();

$dispatcher = require __DIR__ . '/config/router.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$route = $dispatcher->dispatch($httpMethod, $uri);

switch ($route[0]) {
    case Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo json_encode(['status' => 404, 'data' => 'Not Found']);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo json_encode(['status' => 405, 'data' => ' Method Not Allowed']);
        break;
    case Dispatcher::FOUND:
        $handler = $route[1];
        $parameters = $route[2];

        $container->call($handler, $parameters);
        break;
}