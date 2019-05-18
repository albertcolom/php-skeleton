<?php

// More info: http://php-di.org/

use App\Domain\Service\CommandBus;
use App\Infrastructure\Bus\TacticianCommandBus;
use League\Tactician\Container\ContainerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameInflector;
use Psr\Container\ContainerInterface;

return [
    'App\Domain\Repository\*Repository' => DI\create('App\Infrastructure\Repository\InMemory*Repository'),

    'command.handler.map' => [
        //'MyCommand' => 'MyCommandHandler',
    ],

    'command.handler.middleware' => DI\factory(function (ContainerInterface $container) {
        return new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new ContainerLocator($container, $container->get('command.handler.map')),
            new HandleClassNameInflector()
        );
    }),

    CommandBus::class => DI\factory(function (ContainerInterface $container) {
        return new TacticianCommandBus([$container->get('command.handler.middleware')]);
    }),
];
