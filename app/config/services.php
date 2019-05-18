<?php

// More info: http://php-di.org/

use App\Application\CreateFoo;
use App\Application\CreateFooCommand;
use App\Domain\Service\CommandBus;
use App\Infrastructure\Bus\TacticianCommandBus;
use League\Tactician\Container\ContainerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use Psr\Container\ContainerInterface;

return [
    'App\Domain\Repository\*Repository' => DI\create('App\Infrastructure\Repository\Json*Repository'),

    'command.handler.map' => [
        CreateFooCommand::class => CreateFoo::class,
    ],

    'command.handler.middleware' => DI\factory(function (ContainerInterface $container) {
        return new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new ContainerLocator($container, $container->get('command.handler.map')),
            new InvokeInflector()
        );
    }),

    CommandBus::class => DI\factory(function (ContainerInterface $container) {
        return new TacticianCommandBus([$container->get('command.handler.middleware')]);
    }),
];
