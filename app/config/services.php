<?php

// More info: http://php-di.org/

return [
    'App\Domain\Repository\*Repository' => DI\create('App\Infrastructure\Repository\InMemory*Repository')
];
