<?php

// More info: http://php-di.org/

use App\Application\Command\CreateFooCommand;
use App\Application\Command\CreateFooHandler;
use App\Application\Query\GetAllFooHandler;
use App\Application\Query\GetAllFooQuery;
use App\Domain\Service\CommandBus;
use App\Domain\Service\QueryBus;
use App\Infrastructure\Bus\TacticianCommandBus;
use App\Infrastructure\Bus\TacticianQueryBus;
use League\Tactician\Container\ContainerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use Psr\Container\ContainerInterface;

return [
    'App\Domain\Repository\*Repository' => DI\create('App\Infrastructure\Repository\Json*Repository'),

    'command.handler.map' => [
        CreateFooCommand::class => CreateFooHandler::class,
    ],

    'query.handler.map' => [
        GetAllFooQuery::class => GetAllFooHandler::class,
    ],

    'command.handler.middleware' => DI\factory(function (ContainerInterface $container) {
        return new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new ContainerLocator($container, $container->get('command.handler.map')),
            new InvokeInflector()
        );
    }),

    'query.handler.middleware' => DI\factory(function (ContainerInterface $container) {
        return new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new ContainerLocator($container, $container->get('query.handler.map')),
            new InvokeInflector()
        );
    }),

    CommandBus::class => DI\factory(function (ContainerInterface $container) {
        return new TacticianCommandBus([$container->get('command.handler.middleware')]);
    }),

    QueryBus::class => DI\factory(function (ContainerInterface $container) {
        return new TacticianQueryBus([$container->get('query.handler.middleware')]);
    }),
];
