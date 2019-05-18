<?php

// More info: https://github.com/nikic/FastRoute

use App\Api\FooController;
use App\Api\HomeController;

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '[/]', [HomeController::class, 'hello']);
    $r->addRoute('GET', '/foo[/]', [FooController::class, 'getAll']);
    $r->addRoute('POST', '/foo[/]', [FooController::class, 'post']);
});
