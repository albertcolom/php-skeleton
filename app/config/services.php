<?php

// More info: http://php-di.org/

return [
    'App\Domain\Repository\FooRepository' => DI\autowire('App\Infrastructure\Repository\InMemoryFooRepository')
];
