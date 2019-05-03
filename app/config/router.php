<?php

// More info: https://github.com/nikic/FastRoute

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // http://localhost:8000 | http://localhost:8000/
    $r->addRoute('GET', '[/]', '\App\Application\FooClass');

    // http://localhost:8000/info | http://localhost:8000/info/
    $r->addRoute('GET', '/info[/]', ['\App\Application\FooClass', 'info']);

    // http://localhost:8000/hello | http://localhost:8000/hello/
    // http://localhost:8000/hello/foo | http://localhost:8000/hello/foo/
    $r->addRoute('GET', '/hello[/[{name}[/]]]', ['\App\Application\FooClass', 'hello']);
});
