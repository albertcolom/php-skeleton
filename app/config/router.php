<?php

// More info: https://github.com/nikic/FastRoute

use App\Application\FooClass;

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // http://localhost:8000 | http://localhost:8000/
    $r->addRoute('GET', '[/]', FooClass::class);

    // http://localhost:8000/info | http://localhost:8000/info/
    $r->addRoute('GET', '/info[/]', [FooClass::class, 'info']);

    // http://localhost:8000/hello | http://localhost:8000/hello/
    // http://localhost:8000/hello/foo | http://localhost:8000/hello/foo/
    $r->addRoute('GET', '/hello[/[{name}[/]]]', [FooClass::class, 'hello']);
});
